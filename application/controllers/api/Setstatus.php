<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Setstatus extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_post()
    {


        if ($this->userValid($_POST)) {

            if ($_POST['id'] && $_POST['status_id']) {
                $this->Crudmodel->update(['id' => $_POST['id']], ['status_id' => $_POST['status_id']], 'orders');
                $this->set_response(['action' => true], REST_Controller::HTTP_OK);
                return;
            }else{
                $this->set_response(['action' => false, 'message' => lang('not_exist')], REST_Controller::HTTP_OK);
                return ;
            }

        }
        $this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);


    }

}
