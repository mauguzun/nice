<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Tours_orders extends CI_Controller
{

	protected $controller = 'tours_orders';
	public function __construct()
	{
		parent::__construct();


		if(!$this->ion_auth->is_admin())
		redirect(base_url('auth'));


		$this->load->language('front');
		$this->load->library('InputArray');
	}

	public function index()
	{
		$this->load->view('admin/header');


		$this->load->view('admin/table',
			[
				'headers'=>[ 'id', 'id', 'tour','date','name','email','phone','payed','status','driver','edit'],
				'header'=>'Orders city tours',
				'url' => base_url().'admin/'.$this->controller.'/ajax',
			]);

		$this->load->view('admin/footer');

	}



	public function add()
	{
		$this->load->view('admin/header');
		$this->_set_form_validation();
		$this->_set_data();

		$this->form_validation->set_rules('password',lang('password'), 'trim|required|min_length[6]');
		$this->form_validation->set_rules('email',lang('email'), 'trim|required|valid_email|is_unique[users.email]');

		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/add';

		if($this->form_validation->run() === TRUE){
			$this->load->model("Ion_auth_model");
			$_POST['password'] = $this->Ion_auth_model->hash_password($_POST['password']);
			$_POST['active'] = 1;

			$user_id = $this->Crudmodel->add($_POST,'users');
			$this->Crudmodel->add([
					'user_id'=>$user_id,
					'group_id'=>2
				],'users_groups');
			redirect(base_url().'admin/'.$this->controller);
		}
		else
		{

			$this->data['message'] = $this->_displayError($this->form_validation->error_array());
		}

		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/footer');

	}


	public function ajax()
	{


		$query = $this->Crudmodel->get_joins('tours_orders',

			[
				'users'=>"users.id = tours_orders.driver_id",
				'tours_statuses'=>"tours_statuses.id = tours_orders.status_id",
				'translate'=>"translate.parent_id = tours_orders.tour_id and translate.lang_code = 'en' and translate.table = 'tours' "],


			"tours_orders.*,
			translate.title as tour,
			translate.title as tour_id,
			users.email  as driver,tours_statuses.status as status",null,null

		);




		$data['data'] = [];
		foreach($query as $table_row){
			$row = [];
			array_push(
				$row,


				$table_row['id'],
				$table_row['id'],
				$table_row['tour'],
				$table_row['order_date'],
				$table_row['name'],
				$table_row['email'],
				$table_row['phone'],
				$table_row['payed'],
				$table_row['status'],

				$table_row['driver'] ?
				anchor(base_url().'admin/drivers/edit/'.$table_row['driver_id'],$table_row['driver']):
				NULL,


				anchor(base_url().'admin/'.$this->controller.'/edit/'.$table_row['id'],"Edit")


			);
			array_push($data['data'],$row);
		}


		echo json_encode($data);
	}


	public function edit($id)
	{
		$this->load->view('admin/header');
		$this->_set_form_validation();
		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/edit/'.$id;


		if($this->form_validation->run() === TRUE)
		{

			$this->Crudmodel->update(['id'=>$id],$_POST,$this->controller);
			redirect($this->data['form_url']);
		}
		else
		{
			$this->data['message'] = $this->_displayError($this->form_validation->error_array()) ;
		}

		$row = $this->Crudmodel->get_row(['id'=>$id],$this->controller);

		$this->_set_data($row);
		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/footer');

	}


	private function _set_form_validation()
	{

		$this->form_validation->set_rules('name','name', 'trim|required');
		$this->form_validation->set_rules('phone','phone', 'trim|required');
		$this->form_validation->set_rules('email','email', 'trim|valid_email|required');
		$this->form_validation->set_rules('order_date','date', 'trim|required');
		$this->form_validation->set_rules('order_date','date', 'trim|required');



	}
	private function _set_data($row = null )
	{




		$drivers_query = $this->Crudmodel->get_joins('users',['users_groups'=>"users.id = users_groups.user_id"],"users.*",null,null,"users_groups.group_id=2");
		$drivers = [""=>""];
		foreach($drivers_query as $value)
		{
			$drivers[$value['id']] = $value['email'];
		}


		$statuses       = [];
		$statuses_query = $this->Crudmodel->get_all('tours_statuses',null,'id');
		foreach($statuses_query as $value)
		{
			$statuses[$value['id']] = $value['status'];
		}




		// date status driver pickup payed message

		foreach(['name','phone','email','order_date','payed'] as $value)
		{
			$def = isset($row[$value])? $row[$value] : $this->form_validation->set_value($value);



			$this->data['controls'][$value] = form_input($this->inputarray->getArray($value, 'search',$value, $def,TRUE));
		}
		foreach(['driver_id'=>$drivers,'status_id'=>$statuses] as  $key=>$value){
			//	$this->data['controls'][$key."_"] = form_label($key);
			$default = isset($row[$key]) ? $row[$key]  : 0;
			$this->data['controls'][$key] = form_dropdown($key,$value ,$default,['class'=>'form-control']);
		}


		foreach(['pick_up','message'] as $value){

			$def = isset($row[$value])? $row[$value] : $this->form_validation->set_value($value);
			$this->data['controls'][$value] = form_textarea($this->inputarray->getArray($value, 'search',$value, $def,TRUE));
		}


		$this->data['controls']['link'] = anchor(base_url().'admin/'.$this->controller,'Back to list');

	}

	private function _displayError($error)
	{
		$res = "";
		foreach($error as $key=>$value){
			$res .= $key . " - " .$value . "<br> ";
		}
		return $res;
	}

}
