<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Drivermanager extends CI_Controller
{
	protected $controller = 'drivermanager';
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$this->load->view('admin/header');
		$this->load->view('/admin/table',
			[
				'headers'=>['Id','Email','Status','Location','Lat','Lng',"Save"],
				'url' => base_url().$this->controller.'/ajax',
				'header'=>'Driver`s live location'
			]);
		$this->load->view('admin/gmap');
		$this->load->view('admin/footer');

	}
	
	public function update(){
		if(isset($_POST['user_id'],$_POST['lat'],$_POST['lng'])){
			
			$this->Crudmodel->update(['user_id'=>$_POST['user_id']],$_POST,'user_locations');
			echo TRUE;
			return;
		}
		echo FALSE;
	}

	public function ajax()
	{
		$query = $this->Crudmodel->get_joins(
			'user_locations',[
				"users"=>"users.id=user_locations.user_id"
			],"*");

		$data['data'] = [];

		$this->load->library("Calculate");

		foreach($query as $table_row){
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['email'],
				form_dropdown('status', [0,1],$table_row['status'],["data-id"=>$table_row['id'] ,'class' => 'status' ]),
				form_input(['class' => 'gmap', "data-id"=>$table_row['id']  ,'value'=>$this->calculate->getAddress($table_row['lat'],$table_row['lng'])]),
				form_input(['class' => 'lat' , "data-id"=>$table_row['id'] ,'value'=>$table_row['lat']]),
				form_input(['class' => 'lng' , "data-id"=>$table_row['id'] ,'value'=>$table_row['lng']])
				,"<button  id=".$table_row['id']." class='save'>Save</button>"

			);
			array_push($data['data'],$row);
		}


		echo json_encode($data);
	}
}
