<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{

	protected $controller = 'page';
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
				'headers'=>['Id','Page','View','Edit','Translate'],
				'header'=>'Application pages',
				'url' => base_url().'admin/'.$this->controller.'/ajax',
			]);

		$this->load->view('admin/footer');

	}

	public function view($id,$lang = NULL)
	{

	

		if($lang && in_array($lang,$this->lang_array()))
		{
			$row = $this->Crudmodel->get_row(['page_id'=>$id,'lang_code'=>$lang],'pages_translate');

		}
		else
		{
			$row = $this->Crudmodel->get_row(['id'=>$id],'pages');
		}

		$this->load->view('admin/mobile',['text'=>$row['text']]);

	}
	public function edit($id,$lang = NULL)
	{

		$this->load->view('admin/header');

		if($lang && in_array($lang,$this->lang_array()))
		{
			$row = $this->Crudmodel->get_row(['page_id'=>$id,'lang_code'=>$lang],'pages_translate');

		}
		else
		{
			$row = $this->Crudmodel->get_row(['id'=>$id],'pages');
		}

		$this->_set_data($row);  
		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/update/'.$id.'/'.$lang;
		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/footer');

	}
	public function update($id,$lang = NULL)
	{
		$this->_set_form_validation();

		if($this->form_validation->run() === TRUE)
		{
			if($lang){
				$_POST['page_id'] = $id;
				$_POST['lang_code'] = $lang;
				$this->Crudmodel->update_or_insert($_POST,'pages_translate');
			}
			else
			{
				$this->Crudmodel->update(['id'=>$id],$_POST,'pages');
			}
			redirect(base_url().'admin/'.$this->controller);
		} 
		else   
		{
			echo validation_errors();
		}

	}
	public function add()
	{
		$this->load->view('admin/header');



		$this->_set_data();
		$this->data['controls']['page_name'] = form_input("page_name" , null,[
				'required'=>'required','placeholder'=>'page name']);

		$this->data['form_url'] = base_url().'admin/'.$this->controller.'/insert/';
		$this->load->view('admin/form_extended',$this->data);
		$this->load->view('admin/footer');
	}
	public function insert()
	{


		$this->Crudmodel->add($_POST,'pages');
		redirect(base_url().'admin/'.$this->controller);


	}
	public function ajax()
	{
		$query = $this->Crudmodel->get_all('pages');

		$data['data'] = [];

		$this->load->library("Calculate");

		foreach($query as $table_row){
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['page_name'],
				anchor(base_url().'admin/'.$this->controller.'/view/'.$table_row['id'],"View"),
				anchor(base_url().'admin/'.$this->controller.'/edit/'.$table_row['id'],"Edit"),
				$this->getTransUrl($table_row['id'])


			);
			array_push($data['data'],$row);
		}


		echo json_encode($data);
	}

	protected function getTransUrl ($id)
	{

		$url = null;
		foreach($this->lang_array() as $key=>$value)
		{
			$url .= anchor(base_url().'admin/'.$this->controller.'/edit/'.$id.'/'.$key,$value)." |  ".
			anchor(base_url().'admin/'.$this->controller.'/view/'.$id.'/'.$key,"view ". $value).
			"<br>";

		}
		return $url;
	}

	private function _set_data($row = null  )
	{

		foreach(['text'] as $value)
		$this->data['controls'][$value] =
		form_textarea("text" , isset($row[$value])? $row[$value] : NULL );



	}
	private function _set_form_validation()
	{


		$this->form_validation->set_rules('text', 'html code', 'required');


	}
}
