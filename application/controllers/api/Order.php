<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Order extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		if(isset($_POST['code']) && isset($_POST['phone']) ){



			if(empty($_POST['id'])){

				$data = [

					'start_location_lat' => $_POST['points']['start']['lat'],
					'start_location_lng' => $_POST['points']['start']['lng'],
					'start_address' => $_POST['start'],
					'distance'=>$_POST['distance'],
					'duration'=>$_POST['duration'],

					'stop_location_lat' => $_POST['points']['stop']['lat'],
					'stop_location_lng' => $_POST['points']['stop']['lat'],
					'stop_address' => $_POST['stop'],
					'active' => 1,
					'created'=>date("Y-m-d H:i:s"),
					'phone' => $_POST['phone'],
					'price' => $_POST['price'],
					'status_id' => 1,			//
					'polyline' => $_POST['polyline'],



				];
				$_POST['id'] = $this->Crudmodel->add($data,'orders');
			}
			/*else if ($_POST['status_id']){

			}*/
			$data = $this->Crudmodel->get_row(['id'=>$_POST['id']],'orders');

			if(!$data){
				$this->set_response(['action'=>true,'data'=>
						[
							'status_id'=>false,
							'active'=>false,
							'id'=>false
						]], REST_Controller::HTTP_OK);

			}

			$this->set_response(['action'=>true,'data'=>
					[
						'status_id'=>$data['status_id'],
						'active'=>$data['active'] ,
						'id'=>$data['id'],
						'created'=>$data['created']
					]], REST_Controller::HTTP_OK);

			return;
		}
		$this->set_response(['action'=>false,'message'=>'User code not valid'], REST_Controller::HTTP_OK);

	}

}
