<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require FCPATH.'/vendor/autoload.php';

class Pay extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{

		if($this->userValid($_POST) && $_POST['amount'] && $_POST['id'])
		{
			try
			{
				\Stripe\Stripe::setApiKey("sk_test_GXsgEo6n6UXKwYsfU5ii8h5C");


				$query = $this->Crudmodel->get_row(['id'=>$_POST['id']],'orders');
				if($query )
				{


					if($query['price'] != $_POST['amount']){
						$this->set_response([
								'result' => false,
								'message' =>'not correct price ! '.$query['price'] ], REST_Controller::HTTP_OK);
						return;
					}
					else
					{
						$customer = \Stripe\Customer::create(array(
								"source"     => $_POST['token_id'],
								"description"=> $_POST['id'])
						);

						// Charge the Customer instead of the card
						$charge = \Stripe\Charge::create(array(
								"amount"  => $_POST['amount'] * 100,
								"currency"=> "eur",
								"customer"=> $customer->id));

						//
						$this->load->library('State');
						$this->state->set($_POST['id'],7);
						$this->Crudmodel->update(['id'=>$_POST['id']],['payed'=>$_POST['amount']],'orders');

						$this->set_response([
								'result' => true,
								'message' => $charge->status ], REST_Controller::HTTP_OK);
						return;
					}

				}

				$this->set_response([
						'result' => false,
						'message' =>'this order not exist' ], REST_Controller::HTTP_OK);
				return;


			}
			catch(Exception $e){

				$this->set_response([
						'result' => false,
						'message' => $e->getMessage()], REST_Controller::HTTP_OK);

				return;
			}

		}
		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);



	}

}


