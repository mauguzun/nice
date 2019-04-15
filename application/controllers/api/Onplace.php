<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

require APPPATH . 'libraries/REST_Controller.php';

use Pushbots\PushbotsClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Psr7;
use Clickatell\Rest;
use Clickatell\ClickatellException;

class Onplace extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }


    public function index_post()
    {
        if (isset($_POST['id'])) {

            // some test if driver is driver
            $client = new PushbotsClient(PUSH_ID, PUSH_SECRET);
            $clickatell = new \Clickatell\Rest(CLICKATELL);


            $where = ['id' => $_POST['id']];
            $order = $this->Crudmodel->get_row($where, 'orders');

            if ($order) { 

                $message = lang("driver_arrived") . PHP_EOL . $order['stop_address'] . PHP_EOL;
                try {
                    $push_notification = $client->campaign->alias($order['phone'], $message);
                    $sms = $clickatell->sendMessage(['to' => ['37127597292'], 'content' => $message . URLAPP]);
                    $this->Crudmodel->update($where, ['status_id' => 3], 'orders');
                    $this->set_response(['action' => true, 'data' => $order], REST_Controller::HTTP_OK);
                    return;
                } catch (Exception $e) {
                    log_message('error', $e->getMessage());
                    $this->set_response(['action' => false, 'message' => lang('tech_error')],
                        REST_Controller::HTTP_OK);
                    return;
                }

            }


        }
        $this->set_response(['action' => false, 'message' => lang('not_exist')], REST_Controller::HTTP_OK);

    }

}
