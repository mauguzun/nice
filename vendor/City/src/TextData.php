<?php
/**
 * Created by PhpStorm.
 * User: maugu
 * Date: 12/2/2018
 * Time: 7:30 PM
 */

namespace City;


class TextData
{
    public function  __construct($title,$desc)
    {
        $this->title = $title;
        $this->desc= $desc;
    }

    public $title;
    public $desc;
}