<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Drivers extends CI_Controller
{

	protected $controller = 'drivers';
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->ion_auth->is_admin())
        redirect(base_url('auth'));
        
		$this->load->language('front');
		$this->load->library('InputArray');
	}

	public function index()
	{
		$this->load->view('admin/header');


		$this->load->view('admin/table',
			[
				'headers'=>['id','id','email','name','history','edit','delete'],
				'url' => base_url().'admin/'.$this->controller.'/ajax',
				'header'=>'Drivers Table '
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


		$query = $this->Crudmodel->get_joins('users',
			['users_groups'=>"users.id = users_groups.user_id"],"users.*",null,null,
			"users_groups.group_id=2"
		);

		$data['data'] = [];
		foreach($query as $table_row){
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['id'],

				$table_row['email'],
				$table_row['first_name'].
				$table_row['last_name'],

				anchor(base_url().'admin/history/view/'.$table_row['id'],"History"),
				anchor(base_url().'admin/'.$this->controller.'/edit/'.$table_row['id'],"Edit"),
				anchor(base_url().'admin/'.$this->controller.'/delete/'.$table_row['id'],"Delete")


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

		$this->form_validation->set_rules('email',lang('email'), 'trim|required|valid_email');

		if($this->form_validation->run() === TRUE)
		{

			$this->Crudmodel->update(['id'=>$id],$_POST,'users');
			redirect($this->data['form_url']);
		}
		else
		{
			$this->data['message'] = $this->_displayError($this->form_validation->error_array()) ;
		}





		$row = $this->Crudmodel->get_row(['id'=>$id],'users');

		$this->_set_data($row);

		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/footer');

	}


	public function delete($id)
	{
		if($id != 1)
		{
			$this->Crudmodel->delete(['id'=>$id],'users');
			$this->Crudmodel->delete(['user_id'=>$id],'users_groups');
		}
		redirect(base_url().'admin/'.$this->controller);
	}
	private function _set_form_validation()
	{

		$this->form_validation->set_rules('first_name',lang('first_name'), 'trim|required');
		$this->form_validation->set_rules('last_name',lang('last_name'), 'trim|required');
		$this->form_validation->set_rules('phone',lang('phone'), 'trim');



	}
	private function _set_data($row = null )
	{


		foreach(['username','first_name','last_name','email','phone','password'] as $value)
		{
			$def = isset($row[$value])? $row[$value] : $this->form_validation->set_value($value);
			if($row && $value == 'password')
			continue;
			
			
				$this->data['controls'][$value] =
				form_input($this->inputarray->getArray(
						$value, 'search',$value, $def,TRUE
					));
			


		}
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
