<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Tours extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
			
		$this->response->format = 'xml';	
		$query = $this->Crudmodel->get_tours('en',false);
		
		foreach($query as &$value){
			$value->img= base_url()."img/get/".$value->id;
		}
		$this->set_response($query, REST_Controller::HTTP_OK);
                    return ;
	}

}
