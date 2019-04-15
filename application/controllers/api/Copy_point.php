<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Copy_point extends REST_Controller
{
	protected $controller = 'points';
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get($id = 1441)
	{
		$query = $this->Crudmodel->get_row(['id'=>$id],$this->controller);
		
		
		$query['translate'] = [];
		foreach($this->lang_array() as $code=>$value){
			$temp =  $this->Crudmodel->get_row(
				['parent_id'=>$id,'lang_code'=>$code,'table'=>'points'],'translate'
			
			);
			
			if ($temp){
				$query['translate'][$code] = [
					'title'=>$temp['title'],
					'text'=>$temp['text']
				];
			}
			
		}
		
		
		

		echo json_encode($query);

	}



}
