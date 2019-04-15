<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Onplace extends CI_Controller
{


	protected $controller = 'onplace';
	public function __construct()
	{
		parent::__construct();

		if(!$this->ion_auth->is_admin())
		redirect(base_url('auth'));
	}
	public function index()
	{
		
		
		

		$this->load->view('admin/header');
		$this->load->view('admin/table',
			[
				'headers'=>['id','id','phone','start','stop','price','status','update'],
				'url' => base_url().'admin/'.$this->controller.'/ajax',
				'header'=>'Orders from application'
			]);

		$this->load->view('admin/function_update');
		$this->load->view('admin/footer');
		/*		$orders = $this->Crudmodel->get_all('orders');
		$this->load->view('table.php',compact('orders'));
		*/


	}

	public function view($id)
	{

	}

	public function ajax()
	{
		$query    = $this->Crudmodel->get_all('orders');

		$statuses = [];
		foreach($this->Crudmodel->get_all('order_statuses')  as $value){
			$statuses[$value['id']] = $value['status'];
		}



		$data['data'] = [];

		foreach($query as $table_row){
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['id'],
				$table_row['phone'],
				$table_row['start_address'],
				$table_row['stop_address'],
				$table_row['price'],



				form_open(base_url().'admin/onplace/update/'.$table_row['id']).
				form_dropdown('status_id',$statuses,$table_row['status_id'],['class'=>'form-control']).
				form_submit("update","update", ['class'=>'btn btn-block btn-warning']).
				form_close(),

				anchor(base_url().'admin/'.$this->controller.'/view/'.$table_row['id'],"View")



			);
			array_push($data['data'],$row);
		}


		echo json_encode($data);
	}

	public  function  update($id)
	{

		$this->load->library('State');
		$this->state->set($id,$_POST['status_id']);

	}

	public function postCURL($_url, $_param)
	{

		$postData = '';
		//create name value pairs seperated by &
		foreach($_param as $k => $v){
			$postData .= $k . '='.$v.'&';
		}
		rtrim($postData, '&');


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POST, count($postData));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		$output = curl_exec($ch);

		curl_close($ch);

		return $output;
	}
}
