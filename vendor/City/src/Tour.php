<?php
/**
 * Created by PhpStorm.
 * User: maugu
 * Date: 12/2/2018
 * Time: 7:28 PM
 */

namespace City;

require 'Point.php';
require 'TextData.php';


class Tour
{
    public function __construct()
    {
        $this->id = time();
    }

    public $id;
    public $price;
    public $per_min = 0.5;
    public $period;

    public $distance;
    public $img;


    public $path;
    public $pointArray = [];


    public $translate;

    /**
     * @return object
     */
    public function getPath()
    {
        return $this->path;
    }

    public  function getPointsJson(){

        $result  = [];
        foreach ($this->pointArray as $point) {
            $row = self::cast($point ,'City\Point');
          //  $row->translate = self::cast($row->translate ,'City\TextData');
            array_push($result,$row);

        }
        return json_encode($result);
    }


    public  static  function cast($instance, $className)
    {
        return @unserialize(sprintf(
            'O:%d:"%s"%s',
            \strlen($className),
            $className,
            strstr(strstr(serialize($instance), '"'), ':')
        ));
    }


}