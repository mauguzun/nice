<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Orderbyid extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		if($this->userValid($_POST))
		{
			

			$responce = [];
			$query  = $this->Crudmodel->get_row(['id'=>$_POST['id'],'phone'=>$_POST['phone']],'orders');
			$this->set_response(['action' => true, 'data' => $query], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			return;
		}
		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);

	}

}
