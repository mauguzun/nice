<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Pushbots\PushbotsClient;

class Points extends CI_Controller
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
				'headers'=>['id','id','lat','lng','title','edit','delete'],
				'header'=>'Meeting points',
				'url' => base_url().'admin/'.$this->controller.'/ajax',]);


		$this->load->view('admin/footer');
	}

	public function edit($id)
	{


		$tour = $this->Crudmodel->get_tour($id,array_keys($this->lang_array()));


		$this->_set_form_validation();



		if($this->form_validation->run() === TRUE){
			$this->Crudmodel->update(['id'=>$id],['lat'=>$_POST['lat'],'tour_id'=>$_POST['tour_id'],'lng'=>$_POST['lng'],'img'=>$_POST['img']],'points');

			$this->_addTranslate($id);
		}
		else
		{
			$this->data['message'] = $this->_displayError($this->form_validation->error_array());

		}

		$query = $this->Crudmodel->get_row(['id'=>$id],$this->controller);


		$this->_set_data($query);
		$this->load->view('admin/header');


		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/edit/'.$id;


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

			$_POST['meeting'] = isset($_POST['meeting'])?: null;


			$id = $this->Crudmodel->add([
					'lat'=>$_POST['lat'],
					'lng'=>$_POST['lng'],
					'meeting'=>$_POST['meeting'],

				],'points');


			$this->Crudmodel->delete(['point_id'=>$id],'tours_points');

			if(isset($_POST['tours_id']))
			{

				foreach($_POST['tours_id'] as $tour)
				{
					$this->Crudmodel->add(['point_id'=>$id ,'tour_id'=>$tour ],'tours_points');
				}
			}


			$this->_addTranslate($id);

			$this->Crudmodel->delete(['point_id'=>$id],'img');

			if(isset($_POST['img'])){
				foreach($_POST['img'] as $img)
				{
					$this->Crudmodel->update_or_insert([
							'img'=>$img,
							'point_id'=>$id

						],'img');
				}

			}




			redirect(base_url().'admin/tourpoints' );
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
				'translate'=>"$this->controller.id = translate.parent_id
				and lang_code = 'fr'

				and translate.table = '$this->controller'"],"$this->controller.*,translate.title as title",
			null,null,['points.tour_id'=>0 ]);




		$data['data'] = [];

		foreach($query as $table_row){
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['id'],
				$table_row['lat'],
				$table_row['lng'],
				$table_row['title'],
				anchor(base_url().'admin/'.$this->controller.'/edit/'.$table_row['id'],"Edit"),
				anchor(base_url().'admin/'.$this->controller.'/delete/'.$table_row['id'],"Delete")


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
					$title,TRUE));
			$this->data['controls'][$key.'s'] = form_label($value .  '  text');
			$this->data['controls'][$key."|text"] = form_textarea($this->inputarray->getArray($key."|text", 'search',
					$value, $text,FALSE,['style'=>'height:100px']));

		}
		$this->data['controls']['img'] = $this->load->view('admin/img_upload',['img'=>$row['img']],true);

		foreach(['lat','lng','tour_id'] as $value){
			$def = isset($row[$value])? $row[$value] : $this->form_validation->set_value($value);
			$this->data['controls'][$value] = form_input($this->inputarray->getArray($value, 'number',$value, $def,TRUE,['step'=>'any']));

		}


	}


	public function delete($id)
	{

		$this->Crudmodel->delete(['id'=>$id],$this->controller);
		$this->Crudmodel->delete(['table'=>'points','parent_id'=>$id],'translate');


		redirect(base_url().'admin/'.$this->controller);
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
}
