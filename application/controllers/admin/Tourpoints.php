<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Tourpoints extends CI_Controller
{

	protected $controller = 'points';
	public function __construct()
	{
		parent::__construct();

		$this->load->language('front');
		$this->load->library('InputArray');

		if(!$this->ion_auth->is_admin())
		redirect(base_url('auth'));
	}

	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/table',[
				'headers'=>['id','id','title','meetting','tours','lat','lng','edit','delete'],
				'header'=>'All Points From city Tour',
				'url' => base_url().'admin/Tourpoints/ajax',]);


		$this->load->view('admin/footer');
	}

	public function edit($id)
	{


		$tour = $this->Crudmodel->get_tour($id,array_keys($this->lang_array()));


		$this->_set_form_validation();



		if($this->form_validation->run() === TRUE){


			//$tempPost = $_POST;
			//unset($_POST['img']);


			$_POST['meeting'] = isset($_POST['meeting'])?: null;
			$this->Crudmodel->update(['id'=>$id],['meeting'=>$_POST['meeting'],   'lat'=>$_POST['lat'],'lng'=>$_POST['lng']],'points');
			$this->Crudmodel->delete(['point_id'=>$id],'tours_points');
			
			
			
			if(isset($_POST['tours_id']))
			{

				foreach($_POST['tours_id'] as $tour)
				{
					$this->Crudmodel->add(['point_id'=>$id ,'tour_id'=>$tour ],'tours_points');
				}
			}
	
	

			$this->Crudmodel->delete(['point_id'=>$id],'img');
			if(isset($_POST['img'])){
				foreach($_POST['img'] as $img)
				{
					echo $this->Crudmodel->update_or_insert([
							'img'=>$img,
							'point_id'=>$id

						],'img');
				}  

			}
			$this->_addTranslate($id);
		//	redirect(base_url().'admin/tourpoints');
		}
		else
		{
			$this->data['message'] = $this->_displayError($this->form_validation->error_array());

		}

		$query = $this->Crudmodel->get_row(['id'=>$id],$this->controller);


		$this->_set_data($query);
		$this->load->view('admin/header');





		$this->data['form_url'] = base_url().'admin/tourpoints/edit/'.$id;


		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/point_map',compact('query'));
		$this->load->view('admin/footer');


	}
	private function _addTranslate($id)
	{

		$this->Crudmodel->delete(['table'=>'points','parent_id'=>$id],'translate');
		$translate = [];
		foreach($this->lang_array() as $key=>$value)
		{
			$translate[$key] = ['table'=>'points','parent_id'=>$id,'lang_code'=>$key];
		}

		foreach($_POST as $key=>$value)
		{
			if(strpos($key, '|') !== false){
				$lang = explode("|",$key);
				$translate[$lang[0]][$lang[1]] = $value;
			}
		}
		foreach($translate as $key=>$value)
		{
			$this->Crudmodel->add($value,'translate');
		}
	}


	public function add()
	{





		$this->load->view('admin/header');


		$this->_set_form_validation();
		$this->_set_data();


		if($this->form_validation->run() === TRUE)
		{

			$id = $this->Crudmodel->add([
					'lat'=>$_POST['lat'],
					'lng'=>$_POST['lng'],
					'meeting'=>$_POST['meeting'],

				],'points');

			$this->_addTranslate($id);



			//redirect(base_url().'admin / '.$this->controller);
		}
		else
		{
			$this->data['message'] = $this->_displayError($this->form_validation->error_array());
		}



		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/add/';
		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/point_map');
		$this->load->view('admin/footer');
	}


	public function ajax()
	{



		$query = $this->Crudmodel->get_joins($this->controller,[
				'translate'=>"$this->controller.id = translate.parent_id  and lang_code = 'fr' and translate.table = '$this->controller'",

			],"$this->controller.*,translate.title as title ",
			null,null);



		$tours_query = $this->Crudmodel->get_joins('tours',[
				'translate'=>"tours.id = translate.parent_id  and lang_code = 'fr' and translate.table = 'tours'",

			],"tours.id as id ,translate.title as title ",null,null);





		$tours = [];
		foreach($tours_query as $value){
			$tours[$value['id']] = $value['title'];
		}




		$data['data'] = [];

		foreach($query as $table_row){
			$row      = [];

			$in_tours = "";
			foreach($this->Crudmodel->get_all('tours_points',['point_id'=>$table_row['id']]) as $value){
				if(array_key_exists($value['tour_id'],$tours))
				{
					$in_tours .= $tours[$value['tour_id']]."<br>";
				}

			}


			array_push(
				$row,
				$table_row['id'],

				$table_row['id'],
				$table_row['title'],
				$table_row['meeting'],
				$table_row['lat'],
				$table_row['lng'],
				$in_tours,
				anchor(base_url().'admin/tourpoints/edit/'.$table_row['id'],"Edit"),
				anchor(base_url().'admin/tourpoints/delete/'.$table_row['id'],"Delete")


			);
			array_push($data['data'],$row);
		}



		echo json_encode($data);
	}



	private function _set_data($row = null  )
	{

		foreach($this->lang_array() as $key=>$value){

			$text = NULL;
			$title = NULL ;
			if(isset($row))
			{
				$query = $this->Crudmodel->get_row(['parent_id'=>$row['id'],'lang_code'=>$key],'translate');

				$text  = $query['text'];
				$title = $query['title'];
			}

			$this->data['controls'][$key] = form_label($value .  '  title');
			$this->data['controls'][$key."|title"] = form_input($this->inputarray->getArray($key."|title", 'search',$value,
					$title,false
				));
			$this->data['controls'][$key.'s'] = form_label($value .  '  text');
			$this->data['controls'][$key."|text"] = form_textarea($this->inputarray->getArray($key."|text", 'search',
					$value, $text,FALSE,['style'=>'height:100px']));

		}


		$file = NULL;
		if($row)
		{
			$file = array_column($this->Crudmodel->get_all('img',['point_id'=>$row['id']]),'img');

		}



		$this->data['controls']['img'] = $this->load->view('admin/img_upload',[


				'file'=>$file,
				'url'=>base_url().'/admin/Tourpoints/ajax_upload'
			],true);

		foreach(['lat','lng'] as $value){
			$def = isset($row[$value])? $row[$value] : $this->form_validation->set_value($value);
			$this->data['controls'][$value] = form_input($this->inputarray->getArray($value, 'number',$value, $def,TRUE,['step'=>'any']));

		}

		foreach(['meeting'] as $value)
		{
			$this->data['controls'][$value] = "<label>". form_checkbox(
				$value,$value,isset($row[$value])?: 0  )."Meeting point</label>";

		}

		// get all tours
		$tours_query = $this->Crudmodel->get_joins(
			'tours',
			['translate'=>'tours.id = translate.parent_id and lang_code = "fr" and table = "tours" '],
			"tours.id as id , translate.title as title" , NULL
		);
		$tours = [] ;
		foreach($tours_query as $value){
			$tours[$value['id']] = $value['title'];
		}


		$selected = null;
		if($row){
			$selected_query = $this->Crudmodel->get_all('tours_points',['point_id'=>$row['id']]);
			$selected       = [] ;
			foreach($selected_query as $tour){

				array_push($selected,$tour['tour_id']);
			}
		}

		$this->data['controls']['tours_id[]'] = form_multiselect('tours_id[]',$tours,$selected,[
				'style'=>'width:100%;height:200px']);

	}


	public function delete($id)
	{

		$this->Crudmodel->delete(['id'=>$id],'points');
		$this->Crudmodel->delete(['table'=>'points','parent_id'=>$id],'translate');
		$this->Crudmodel->delete(['point_id'=>$id],'tours_points');

		redirect(base_url().'admin/tourpoints');
	}
	private function _set_form_validation()
	{

		$this->form_validation->set_rules('lat','lat', 'trim|required');
		$this->form_validation->set_rules('lng','lng', 'trim|required');

	}

	private function _displayError($error)
	{
		$res = "";
		foreach($error as $key=>$value)
		{
			$res .= $key . " - " .$value . "<br> ";
		}
		return $res;
	}


	public function ajax_upload()
	{

		$config['upload_path'] = './upload/';
		$config['encrypt_name'] = TRUE;
		$config['allowed_types'] = '*';
		$this->load->library('upload',$config);



		if( ! $this->upload->do_upload('file'))
		{
			$this->session->set_flashdata('message', $this->upload->display_errors());
			echo json_encode(['error'=>true,'message'=>$this->upload->display_errors()]);
			return ;
		}
		else
		{
			$upload_data = [ 'upload_data'=> $this->upload->data()];
			echo json_encode([
					'error'=>false,
					'url'=>base_url().'upload/'.$upload_data['upload_data']['file_name'],
					'file'=>$upload_data['upload_data']['file_name'],
					'ext'=>$upload_data['upload_data']['file_ext'],

				]);
			return;
		}
	}

}
