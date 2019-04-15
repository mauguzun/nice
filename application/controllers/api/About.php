<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class About extends REST_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_post()
    {
    	
    	
    	$code = '<div>
<h2>What is Lorem Ipsum?</h2>
<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. 
Lorem Ipsum has been the industrys standard
 dummy text ever since the 1500s, when an unk
 nown printer took a galley of type and scrambled it 
 to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>';

            $this->set_response(['action' => true, 'data' => $code], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

       /* if ($this->userValid($_POST) ) {
            $query = $this->Crudmodel->get_row(['lang'=> $this->config->item('language')],'about');
            $this->set_response(['action' => true, 'data' => $query], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            return;
        }
        $this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);
*/

    }

}
