<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Pushbots\PushbotsClient;

class History extends CI_Controller
{

	protected $controller = 'history';
	public function __construct()
	{
		parent::__construct();

		$this->load->language('front');

		if(!$this->ion_auth->is_admin())
		redirect(base_url('auth'));
	}



	public function view($id)
	{
		
		$user = $this->Crudmodel->get_row(["id"=>$id],'users');
		if(!$user){
			redirect(base_url().'admin');
		}
		
		$this->load->view('admin/header');
		$this->load->view('admin/table',[
				'headers'=>['id','id','title','date','status','user','order','city tour'],
				'header'=>$user['username'] . ' city tours history ',
				'url' => base_url().'admin/'.$this->controller.'/ajax/'.$id]);


		$this->load->view('admin/footer');
	}


	public function ajax($id)
	{


		$query = $this->Crudmodel->get_joins('tours_orders',[
		 		'tours'=>'tours_orders.tour_id = tours.id',
		 		'users'=>'tours_orders.driver_id = users.id',
				'translate'=>"tours.id = translate.parent_id and lang_code = 'fr'and translate.table = 'tours'",
				'tours_statuses'=>"tours_statuses.id = tours_orders.status_id"],
				"tours.id as tid , tours_orders.*,translate.title as title,tours_statuses.status as status ,users.id as uid, users.email as email",
			null,null,['tours_orders.driver_id'=>$id ]);




		$data['data'] = [];
		


		foreach($query as $table_row)
		{
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['id'],
				$table_row['title'],
				$table_row['order_date'],
				$table_row['status'],

				anchor(base_url().'admin/drivers/edit/'.$table_row['uid'],$table_row['email']."  view more"),
				anchor(base_url().'admin/tours_orders/edit/'.$table_row['id'],$table_row['status']." view order details"),
				anchor(base_url().'admin/tours/view/'.$table_row['tid'],$table_row['title']. " tour data")


			);
			array_push($data['data'],$row);
		}
		

		echo json_encode($data);
	}




}
