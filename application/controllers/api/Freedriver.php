<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Freedriver extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_post()
    {
        if ($this->userValid($_POST)) {
            // todo get free driver from databae 1 have , 0 all busy
            $this->set_response(['action' => true, 'driver' => 1], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            return;

        }
        $this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


        /*locaiton[start][location][lat]: 56.951596599999995
        locaiton[start][location][lng]: 24.206968099999997
        locaiton[start][location][lang]: en
        locaiton[start][location][phone]: 27597292
        locaiton[start][location][code]: 12345
        locaiton[start][address]: Zvaigznāja gatve 14, Vidzemes priekšpilsēta, Rīga, LV-1082, Латвия
        locaiton[stop][address]: Bauskas iela Zemgales priekšpilsēta Rīga Bauskas iela
        locaiton[stop][location][lat]: 56.91384499999999
        locaiton[stop][location][lng]: 24.12017639999999
        lang: en
        phone: 27597292
        code: 12345*/


    }

}
