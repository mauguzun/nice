<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'/vendor/autoload.php';

class Manage extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->language('front');

	}
	public function index($id = null )
	{
		if(isset($id)){

			$query = $this->Crudmodel->get_joins('tours_orders',

				[
					'users'=>"users.id = tours_orders.driver_id",
					'tours_statuses'=>"tours_statuses.id = tours_orders.status_id",
					'tours'=>"tours.id = tours_orders.tour_id",
					'translate'=>"translate.parent_id = tours_orders.tour_id and translate.lang_code = '".$this->config->item('language')."' and translate.table = 'tours' "],


				"tours_orders.*,
				translate.title as tour,
				tours.price as price,			
				translate.title as tour_id,
				users.email  as driver,tours_statuses.status as status",null,null,
				["tours_orders.id"=>$id]

			);
		
			
			if(is_array($query) && isset($query[0]))
			{
				$query = $query[0];
				
				
			
				
				
				
				if (isset($_GET['code'])) {
					// tipe proverirli
					
				 if($_GET['code'] == $query['discount']){
					$query['price'] = $query['price'] * ((100-DISCOUNT_AMMOUNT) / 100);			
				 }else{
				 	$query['discount'] = null;
				 }
					
						

				}
				
				
				
				

				$this->load->helper('directory');
				$images= directory_map('./static/front/bg/');

			/*	$this->load->view('front/pay',
					[
						'id'=>$id,
						'langs'=>$this->lang_array(),
						'current_lang'=>$this->config->item('language'),
						'query'=>$query
					]);	*/
					$this->load->view('front/paypal',
					[
						'id'=>$id,
						'langs'=>$this->lang_array(),
						'current_lang'=>$this->config->item('language'),
						'query'=>$query,
						'lang_url'=>base_url().'manage/'.$id
					]);
			}
			else  
			{
				redirect(base_url());
			}

		}


	}


	public function pay($id)
	{


		if(isset($_POST['token'])){
			$query = $this->Crudmodel->get_joins('tours_orders',['tours'=>"tours.id = tours_orders.tour_id"],"tours.*,tours_orders.payed",NULL,NULL,["tours_orders.id"=>$id]);

			if(is_array($query))
			{
				$query = $query[0];

				if($query['price'] == $query['payed'])
				{
					echo json_encode(['result' => false,'message' => lang('alredy payed')]);
					return;
				}
				try
				{
					\Stripe\Stripe::setApiKey(STRIPE);



					$customer = \Stripe\Customer::create(array(
							"source"     => $_POST['token'],
							"description"=> $query['id'])
					);

					// Charge the Customer instead of the card
					$charge = \Stripe\Charge::create(array(
							"amount"  => $query['price'] * 100,
							"currency"=> "eur",
							"customer"=> $customer->id));

					if( $charge->status == 'succeeded')
					{
						$this->Crudmodel->update(['id'=>$id],
							[
								'payed'=>$query['price'],
								'status_id'=>4,
							],'tours_orders');

					}

					echo json_encode(['result' => ($charge->status == 'succeeded') ?  true : false , 'message'=>$charge->status]);
					return ;

				}
				catch(Exception $e)
				{

					echo json_encode(['result' => false,'message' => $e->getMessage()]);

					return;
				}
			}

		}

		echo json_encode(['result' => false,'message' => 'token required']);


	}
}
