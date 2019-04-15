<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Driver extends REST_Controller
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
            if (isset($_POST['lat']) && isset($_POST['lng'])) {}
            // we user this only if realy a lot of cars exist !
                    // todo we get drivers location from database
                    $points = [];
                    for($i = 0; $i < 10; $i++){
                        array_push($points,$this->_getRandomPoint($_POST['lat'],$_POST['lng']) );
                    }

                    $this->set_response(['action' => true, 'points' => $points], REST_Controller::HTTP_OK);
                    return ;


        }
        $this->set_response(['action' => false, 'message' => lang('text_rest_unauthorized')], REST_Controller::HTTP_OK);

    }

    /**
     * This is test methods
     * @param $lat
     * @param $long
     * @return array
     */
    private function _getRandomPoint($lat,$long){

        $longitude = (float) $long;
        $latitude = (float) $lat;
        $radius = rand(1,2); // in miles

        $lng_min = $longitude - $radius / abs(cos(deg2rad($latitude)) * 69);
        $lng_max = $longitude + $radius / abs(cos(deg2rad($latitude)) * 69);
        $lat_min = $latitude - ($radius / 69);
        $lat_max = $latitude + ($radius / 69);


        return [
            'lat'=>$lat_max,
            'lng'=>$lng_min
        ];


    }

}
