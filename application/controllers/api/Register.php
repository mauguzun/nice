<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

require 'vendor/autoload.php';


use Pushbots\PushbotsClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7;
use Clickatell\Rest;
use Clickatell\ClickatellException;

class Register extends REST_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->library('State');
	}

	public function index_post()
	{
		if(isset($_POST['phone']) && isset($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['name']))
		{

			$this->load->library("Code");
			$_POST['code'] = $this->code->get_code();
			$query = $this->Crudmodel->get_row(['phone' => $_POST['phone']], 'customers');


			if($query)
			{
				//todo last lagin + 20 minut
				if($query['attemps'] > 5 )
				{
					if(  $this->state->time_diff($query['last_login']) < 20   )
					{
						$this->set_response(['action' => false, 'message' => lang('to_much_attemps')],
							REST_Controller::HTTP_OK);
						return;
					}else{
						$query['attemps'] = 0;
					}
				}



				// debug
				$this->Crudmodel->update(
					['phone' => $_POST['phone']],
					['code' => $_POST['code'],
						'attemps' => ++$query['attemps']], 'customers');

			}
			else
			{
				$this->Crudmodel->add($_POST, 'customers');
			}
			// we send code via sms to user
			$this->_sendSms($_POST['phone'],$_POST['code']);
			// we send code via sms to user
			$_POST['code'] = null;
			$this->set_response(['action' => true, 'user' => $_POST], REST_Controller::HTTP_OK); // OK (200) being the HTTP response cod
			return;
		}
		$this->set_response(['action' => false, 'message' => "phone and name"], REST_Controller::HTTP_OK);

	}

	private function _sendSms( $phone ,$code)
	{
		try
		{
			$clickatell = new \Clickatell\Rest(CLICKATELL);
			$clickatell->sendMessage(['to' =>[$phone], 'content' => lang('you_code_is').PHP_EOL."http://tricypolitain.com".PHP_EOL. $code]);


			return true;
		} catch(Exception $e)
		{
			log_message('error', 'on send sms' .$e->getMessage());

			return false;
		}
	}
}
