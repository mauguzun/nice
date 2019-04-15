<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Price extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{

		if($this->userValid($_POST) && $_POST['distance']){
			//todo disctance  ,  and proce  and drivewe await


			$responce = [];


			$this->load->library("Calculate");
			$this->calculate->setDistance($_POST['distance']);
			$this->calculate->setDrivers($this->Crudmodel->get_all('user_locations'));
			$this->calculate->setStart($_POST['address']);



			$responce['price'] = $this->calculate->calculatePrice();

			// todo not correct but what to do ???
			$q = $this->calculate->sortDriver();



			if(is_array($q) && count($q) > 0 && $q[0]['duration'] < 720){
				$responce['driver_await'] = ($q[0]['duration'] + AWAIT ) / 60 ;


			}
			else
			{
				$responce['driver_await'] = lang('await');

			}


			$this->set_response(['action' => true, 'data' => $responce], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			return;
		}
		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


	}

}
