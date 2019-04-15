<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Orderstatus extends REST_Controller
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

			if($_POST['id'] )
			{
				$query = $this->Crudmodel->get_row(['id'=>$_POST['id']],'orders');
				if($query)
				{

					$this->load->library('State');

					if( $query['status_id'] == 1  && $this->state->time_diff($query['created']) > 25 ){
						$this->state->set($_POST['id'],4);
						$query['status_id'] = 4;
					}

					$this->set_response(['action' => true, 'message' =>$query['status_id']], REST_Controller::HTTP_OK);
					return;
				}
				$this->set_response(['action' => true, 'message' =>0], REST_Controller::HTTP_OK);
				return;
			}
		}


		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


	}

}
