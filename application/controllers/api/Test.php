<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Test extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		
		//$config['rest_default_format'
		

		$id = $this->Crudmodel->add(['phone'=>$_POST['q']],'test');
		                $this->set_response(['action' => true], REST_Controller::HTTP_OK);


	}


}
