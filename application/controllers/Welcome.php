<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function __construct()
	{

		parent::__construct();
		$this->load->language('front');

	}

	public function index()
	{

	
  
		$this->load->helper('directory');
		$images = directory_map('./static/front/bg/');
		
		
		
		$tours = 	$this->Crudmodel->get_tours_upd($this->config->item('language'));
		
		
	  

		

		$form   = $this->load->view('front/form',[
				'langs'=>$this->lang_array(),
				'current_lang'=>$this->config->item('language')
			],TRUE);
		
		
		
		
		$book_form = $this->load->view('front/form',[
				'booking'=>true,
				'tours'=>$tours['tours'],
				'points'=>$tours['meetings'],
				'images'=>$images,
				'langs'=>$this->lang_array(),
				'current_lang'=>$this->config->item('language')
			],TRUE);
			
	
		$this->load->view('front/index',compact("book_form","form",'tours'));
	}
}