<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
		
		$mail_cofig = $this->config->item('email');
		$this->load->library('email',$mail_cofig);

		print_r($mail_cofig);
		$this->email->from(EMAIL,lang('Discover Nice'));


		$this->email->to("mauguzun@gmail.com");

	

		$this->email->subject('asd');
		$this->email->message('/asd');

		$this->email->send();
		echo $this->email->print_debugger();
		/*$this->load->view('admin/header');
		$this->load->view('test');*/
	}



}
