<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class History extends REST_Controller
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

			// from ,pertime ,user id
			$data = $this->Crudmodel->get_all(
				'orders',
				['phone'=>$_POST['phone'],'status_id' => 7],

				'id','desc', "id,created,start_address,stop_address,price"
				,$_POST['perTime'],$_POST['startFrom']
			);
			$this->set_response(['action' => true, 'data' => $data], REST_Controller::HTTP_OK);

			return;

		}
		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


	}

}
