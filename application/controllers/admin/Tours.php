<?php
defined('BASEPATH') OR exit('No direct script access allowed');


use Pushbots\PushbotsClient;

class Tours extends CI_Controller
{

	protected $controller = 'tours';
	public function __construct()
	{
		parent::__construct();
		$this->load->language('front');

		if(!$this->ion_auth->is_admin())
		redirect(base_url('auth'));
	}

	public function index()
	{
		$this->load->view('admin/header');


		$this->load->view('admin/table',
			[
				'headers'=>['id','id','title','price','view','edit','delete'],
				'url' => base_url().'admin/'.$this->controller.'/ajax',
				'header'=> 'All city tours'
			]);

		//$this->load->view('admin / video');
		$this->load->view('admin/footer');

	}

	public function view($id)
	{

		$tour = $this->Crudmodel->get_tour($id,array_keys($this->lang_array()));



		$this->load->view('admin/header');
		$this->load->view('admin/tour_view',[
				'langs'=>array_keys($this->lang_array()),'edit'=>$tour

			]);
		$this->load->view('admin/footer');



	}
	public function edit($id)
	{

		if(isset($_POST['price'])){
			$this->Crudmodel->update(

				['id'=>$id],
				[
					'distance'=> trim($_POST['distance']),
					'period'=>trim($_POST['period']),
					'per_min'=>trim($_POST['per_min']),
					'price'=>trim($_POST['price'])
				],$this->controller
			)		;

			$this->Crudmodel->delete(['tour_id'=>$id],'img_tours');
			$this->Crudmodel->delete(['point_id'=>$id],'tours_points');

			if(isset($_POST['img'])){
				foreach($_POST['img'] as $img){
					$this->Crudmodel->update_or_insert([
							'img'=>$img,
							'tour_id'=>$id

						],'img_tours');
				}
			}
			
			$this->Crudmodel->delete(['tour_id'=>$id],'tours_points');
			if(isset($_POST['points']))
			{
				foreach($_POST['points'] as $point){
					$this->Crudmodel->update_or_insert([
							'point_id'=>$point,
							'tour_id'=>$id

						],'tours_points');
				}
			}



			foreach($this->lang_array()  as $code=>$value)
			{


				$this->Crudmodel->delete(
					['parent_id'=>$id,
						'lang_code'=>$code,
						'table'=>'tours'],'translate'
				);

				$translate_tour =
				[
					'parent_id'=>$id,
					'lang_code'=>$code,
					'table'=>'tours',
					'title'=>trim($_POST["title_".$code]),
					'text'=>trim($_POST["desc_".$code]),
				];

				//var_dump($translate_tour);
				$this->Crudmodel->update_or_insert($translate_tour,'translate');
			}


		}




		$tour   = $this->Crudmodel->get_tour($id,array_keys($this->lang_array()));
		$points = $this->Crudmodel->get_joins(
			'points',
			[
				'translate'=>'points.id = translate.parent_id and translate.lang_code="fr" and translate.table="points" '
			],
			'points.*,translate.title as title',['title'=>'asc'],null

		);

		//	var_dump($points);


		$selected = [];
		foreach($this->Crudmodel->get_all('tours_points',['tour_id'=>$id]) as  $value){
			array_push($selected,$value['point_id']);
		}

		$file       = array_column($this->Crudmodel->get_all('img_tours',['tour_id'=>$id]),'img');



		$img_upload = $this->load->view('admin/img_upload',[
				'file'=>$file,
				'url'=>base_url().'/admin/Tourpoints/ajax_upload'
			],true);


		$this->load->view('admin/header');
		$this->load->view('admin/tour',[
				'langs'=>array_keys($this->lang_array()),
				'edit'=>$tour,
				'img_upload'=>$img_upload,
				'points'=>$points,
				'url'=>base_url().'admin/tours/edit/'.$id,
				'selected'=>$selected
			]);


		$this->load->view('admin/footer');

	}

	public function add()
	{
		$id     = 14;


		$tour   = $this->Crudmodel->get_tour($id,array_keys($this->lang_array()));
		$points = $this->Crudmodel->get_joins(
			'points',
			[
				'translate'=>'points.id = translate.parent_id and translate.lang_code="fr" and translate.table="points" '
			],
			'points.*,translate.title as title',['title'=>'asc'],null

		);

		//	var_dump($points);


		$selected = [];
		foreach($this->Crudmodel->get_all('tours_points',['tour_id'=>$id]) as  $value){
			array_push($selected,$value['point_id']);
		}

		$file       = array_column($this->Crudmodel->get_all('img_tours',['tour_id'=>$id]),'img');



		$img_upload = $this->load->view('admin/img_upload',[
				'file'=>$file,
				'url'=>base_url().'/admin/Tourpoints/ajax_upload'
			],true);


		$this->load->view('admin/header');
		$this->load->view('admin/tour',[
				'langs'=>array_keys($this->lang_array()),
				'edit'=>$tour,
				'img_upload'=>$img_upload,
				'points'=>$points,
				'url'=>base_url().'admin/tours/insert',
				'selected'=>$selected
			]);


		$this->load->view('admin/footer');


	}
	public function ajax()
	{


		$query = $this->Crudmodel->get_joins($this->controller,[
				'translate'=>"$this->controller.id = translate.parent_id
				and lang_code = 'fr'
				and translate.table = '$this->controller'"],"tours.*,translate.title as title");





		$data['data'] = [];

		foreach($query as $table_row)
		{
			$row = [];

			array_push(
				$row,
				$table_row['id'],
				$table_row['id'],

				$table_row['title'],
				$table_row['price'],

				anchor(base_url().'admin/'.$this->controller.'/view/'.$table_row['id'],"View"),
				anchor(base_url().'admin/'.$this->controller.'/edit/'.$table_row['id'],"Edit"),
				anchor(base_url().'admin/'.$this->controller.'/delete/'.$table_row['id'],"Delete")


			);
			array_push($data['data'],$row);
		}


		echo json_encode($data);
	}



	public function insert()
	{


		if(isset($_POST['price'])){
			$id = $this->Crudmodel->add(


				[
					'distance'=> trim($_POST['distance']),
					'period'=>trim($_POST['period']),
					'per_min'=>trim($_POST['per_min']),
					'price'=>trim($_POST['price'])
				],$this->controller
			)		;

			$this->Crudmodel->delete(['tour_id'=>$id],'img_tours');
			$this->Crudmodel->delete(['point_id'=>$id],'tours_points');

			if(isset($_POST['img'])){
				foreach($_POST['img'] as $img){
					$this->Crudmodel->update_or_insert([
							'img'=>$img,
							'tour_id'=>$id

						],'img_tours');
				}
			}
			foreach($_POST['points'] as $point){
				$this->Crudmodel->update_or_insert([
						'point_id'=>$point,
						'tour_id'=>$id

					],'tours_points');
			}

			foreach($this->lang_array()  as $code=>$value)
			{


				$this->Crudmodel->delete(
					['parent_id'=>$id,
						'lang_code'=>$code,
						'table'=>'tours'],'translate'
				);

				$translate_tour =
				[
					'parent_id'=>$id,
					'lang_code'=>$code,
					'table'=>'tours',
					'title'=>trim($_POST["title_".$code]),
					'text'=>trim($_POST["desc_".$code]),
				];

				//var_dump($translate_tour);
				$this->Crudmodel->update_or_insert($translate_tour,'translate');
			}


		}
		redirect(base_url().'admin/tours');
	}



	public function delete($id)
	{
		if($id == 1){
			redirect(base_url().'admin/'.$this->controller);
		}

		$this->_clear_points_translate($id);
		$this->Crudmodel->delete(['id'=>$id],$this->controller);

		redirect(base_url().'admin/'.$this->controller);
	}

	private function  _clear_points_translate($tour_id)
	{

		/*$points = $this->Crudmodel->get_all('points',['tour_id'=>$tour_id]);
		foreach($points as $value)
		{
		$this->Crudmodel->delete(
		['table'=>'points','parent_id'=>$value['id']],'translate');
		}
		$this->Crudmodel->delete(['tour_id'=>$tour_id],'points');*/
		$this->Crudmodel->delete(['table'=>'tours','parent_id'=>$tour_id],'translate');

	}
}
