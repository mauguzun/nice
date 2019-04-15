<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Login extends REST_Controller
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
			//todo update user data

			$where = ['phone' => $_POST['phone'], 'code' => $_POST['code']];
			$query = $this->Crudmodel->get_row($where, 'customers');
			if($query['attemps'] > 5)
			{
				$this->set_response(['action' => false, 'message' => lang('to_much_attemps')], REST_Controller::HTTP_OK);
				return;
			}

			$query['attemps'] = 0;
			$query['confirmed'] = 1;
			$query['code_confirm'] = $_POST['code'];
			$query['name']= $_POST['name'];
			$query['email']= $_POST['email'];
			
			
			
			

			$_POST['valid'] = $query['valid'] = date('Y-m-d H:i:s', strtotime('+5 days'));
			$this->Crudmodel->update($where, $query, 'customers');
			
			// orders ? yea please
			$order = $this->Crudmodel->get_row_order( "orders" ,
			['phone'=>$_POST['phone'],'status_id < '=> 7 ] ,'id','desc');
			
			
			$_POST['order'] = $order ? $order['id'] : NULL;
			
			$this->set_response(['action' => true, 'user' => $_POST], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			return;

			$this->set_response(['action' => true, 'driver' => 1], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			return;

		}
		else
		{
			$query = $this->Crudmodel->get_row(['phone'=>$_POST['phone']], 'customers');
			if($query)
			{
				$query['attemps'] = ++$query['attemps'];
				$this->Crudmodel->update(['phone'=>$query['phone']],$query,'customers');

			}
			if($query['attemps'] > 5)
			{
				$this->set_response(['action' => false, 'message' => lang('to_much_attemps')], REST_Controller::HTTP_OK);
				return;
			}

		}
		$this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


	}

}
