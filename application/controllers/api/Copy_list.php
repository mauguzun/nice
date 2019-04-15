<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';


class Copy_list extends REST_Controller
{
	protected $controller = 'points';
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$query = $this->Crudmodel->get_all($this->controller );





		$data['data'] = [];

		foreach($query as $table_row)
		{
			$row = [];

			$table_row['translate'] = [];
			foreach($this->lang_array() as $code=>$value)
			{
				$temp = $this->Crudmodel->get_row(
					['parent_id'=>$table_row['id'],'lang_code'=>$code,'table'=>'points'],'translate'

				);

				if($temp)
				{
					$table_row['translate'][$code] = [
						'title'=>$temp['title'],
						'text'=>$temp['text']
					];
				}

			}

			array_push(
				$row,
				$table_row['id'],

				$table_row['lat'],

				$table_row['lng'],

				$table_row['img'],
				$table_row['translate']


			);
			array_push($data['data'],$row);
		}



		echo json_encode($data);

	}



}
