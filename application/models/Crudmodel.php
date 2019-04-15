<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crudmodel extends CI_Model
{



	function get_all($table,$where = null ,$order = NULL,$order_value = 'DESC',$select = NULL ,$limit = NULL,$start = 0 )
	{
		if($where){
			$this->db->where($where);
		}
		if($order){
			$this->db->order_by($order,$order_value);
		}
		if($select){
			$this->db->select($select);
		}

		$query = ($limit) ? $this->db->get($table,$limit,$start):
		$this->db->get($table);

		return $query->result_array();
	}
	/**
	*
	* @param array $where
	* @param string $table
	*
	* @return
	*/
	function get_row($where,$table)
	{

		$this->db->where($where);
		$query = $this->db->get($table);
		return $query->row_array();
	}/**
	*
	* @param array $where
	* @param string $table
	*
	* @return
	*/
	function get_row_order($table,$where,$order,$order_by)
	{

		$this->db->where($where);
		$this->db->order_by($order,$order_by);
		$query = $this->db->get($table);
		return $query->row_array();
	}

	/**
	* insert new row ,pass array
	* @param array $value
	* @param string  $table
	*
	* @return int insert id ;
	*/
	function add( $value, $table)
	{
		$this->db->insert($table,$value);
		return $this->db->insert_id();
	}
	/**
	*
	* @param multiarra $value
	* @param string $table
	*
	* @return
	*/
	function add_many($value , $table)
	{

		foreach($value as $one){
			$this->add($one,$table);
		}
		// $this->db->insert_batch($table,$value);
	}

	/**
	*
	* @param string $where_column
	* @param array $where_in_array
	* @param string $table
	* @param array $where
	* @param array $order
	* @param string $select
	* @param int $limit
	* @param int $start
	*
	* @return array
	*/
	function get_where_in($where_column ,$where_in_array,$table ,$where = NULL ,$order = NULL ,$select = NUll ,$limit = NULL ,$start = NULL )
	{


		$this->db->where_in($where_column, $where_in_array);

		if($where){
			$this->db->where($where);
		}
		if($order){
			$this->db->order_by(key($order),$order[key($order)]);
		}
		if($select){
			$this->db->select($select);
		}

		$query = ($limit) ? $this->db->get($table,$limit,$start):
		$this->db->get($table);

		return $query->result_array();
	}

	/**
	*
	* update row in db
	* @param array $where
	* @param array $data
	* @param string $table
	*
	* @return
	*/
	function update( $where, $data, $table)
	{
		$this->db->where($where);
		return $this->db->update($table,$data);
	}
	/**
	*
	* @param array $data
	* @param string $table
	*
	* @return
	*/
	function update_or_insert($data,$table)
	{
		$this->db->replace($table, $data);
	}


	/**
	*
	* @param string $id
	* @param string $column
	* @param string $table
	*
	* @return array
	*/
	function get_array( $id,$column,$table)
	{
		$array = [];
		foreach($this->get_all($table) as $row){
			$array[$row[$id]] = $row[$column];
		}
		return $array;
	}

	/**
	*
	* @param array $where
	* @param string $table
	*
	* @return
	*/
	function delete( $where,  $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	/**
	*
	* @param array $array
	* @param array|null $req
	*
	* @return
	*/
	function clearArray($array,$req = NULL)
	{
		if($array == null )
		return FALSE;

		foreach($array as $key=>&$value){
			$value = trim($value);
			if(is_array($req) && in_array($key,$req)){
				if($value == ""){
					return FALSE;
				}

			}
		}
		return $array;
	}

	/**
	*
	* @param array $like ,'column,value'
	* @param string $table
	*
	* @return
	*/
	function get_like( $like, $table ,$where = NULL )
	{
		if($where)
		$this->db->where($where);


		$this->db->like($like);
		$query = $this->db->get($table);


		return $query->result_array();
	}


	/**
	*
	* @param string $table
	* @param arrray $tablesAndJoin
	* @param string $selectAs
	* @param array $order
	* @param string $group_by
	* @param undefined $where
	* @param undefined $limit
	* @param undefined $start
	*
	* @return
	*/
	function get_joins( $table,  $tablesAndJoin ,$selectAs = "*",$order = NULL ,$group_by = NULL,$where = NULL,$limit = NULL,$start = 0)
	{



		$this->db->select($selectAs);


		foreach($tablesAndJoin as $key=>$value){
			$this->db->join($key, $value ,"LEFT");
		}


		if($order)
		$this->db->order_by(key($order),$order[key($order)]);

		if($group_by)
		$this->db->group_by($group_by);

		if($where)
		$this->db->where($where);


		$query = ($limit) ? $this->db->get($table,$limit):
		$this->db->get($table);


		return $query->result_array();
	}



	/**
	*
	* @param string $table
	* @param arrray $tablesAndJoin
	* @param string $selectAs
	* @param array $order
	* @param array $group_by
	* @param string $where_column
	* @param array $where_array
	* @param undefined $limit
	* @param undefined $start
	*
	* @return
	*/
	function get_joins_where_in( $table,  $tablesAndJoin ,$selectAs = "*",$order = NULL ,
		$group_by = NULL,$where_column = NULL ,$where_array = NULL,$limit = NULL,$start = 0 )
	{



		$this->db->select($selectAs);


		foreach($tablesAndJoin as $key=>$value){
			$this->db->join($key, $value ,"LEFT");
		}


		if($order)
		$this->db->order_by(key($order),$order[key($order)]);

		if($group_by)
		$this->db->group_by($group_by);

		if($where_column && $where_column)
		$this->db->where_in($where_column , $where_array);


		$query = ($limit) ? $this->db->get($table):
		$this->db->get($table);


		return $query->result_array();
	}


	public function get_tour($id,$langs)
	{
		require 'vendor/City/src/Tour.php';

		$tour = new \City\Tour();
		$query= $this->get_row(['id'=>$id],'tours');

		$tour->id = $id;
		$tour->path = $query['path'];

		//$tour->img = $query['img'];

		$tour->distance = $query['distance'];
		$tour->period = $query['period'];
		$tour->per_min = $query['per_min'];
		$tour->price = $query['price'];
		foreach($this->get_all('translate',[
					'parent_id'=>$id,
					'table'=>'tours'
				]) as $row){
			$transText = new  \City\TextData($row['title'],$row['text']);
			$tour->translate[$row['lang_code']] = $transText;
		}

		$points_query = $this->get_joins('tours_points',[
				'points'=>'points.id = tours_points.point_id'],'points.*',null,null,['tours_points.tour_id'=>$query['id']]);


		foreach($points_query as $row){
			$point = new  \City\Point();


			$point->img = base_url().'img/get/'.$row['id'].'/points';

			$point->lat = $row['lat'];
			$point->lng = $row['lng'];


			//$lang

			foreach($this->get_all('translate',['parent_id'=>$row['id'] , 'table'=>'points']) as $trans_row){
				$transText = new  \City\TextData($trans_row['title'],$trans_row['text']);
				$point->translate[$trans_row['lang_code']] = $transText;
			}
			if(!is_array($point->translate)){

				foreach($langs as $lang){
					$point->translate[$lang] = new  \City\TextData(null,null);
				}

			}

			//	$point->translate[$lang] = new  \City\TextData($title,$text);

			array_push($tour->pointArray,$point);
		}
		/*





		foreach($this->get_all('translate',['parent_id'=>$row['id'] , 'table'=>'points']) as $trans_row){
		$transText = new  \City\TextData($trans_row['title'],$trans_row['text']);
		$point->translate[$trans_row['lang_code']] = $transText;
		}
		if(!is_array($point->translate)){

		foreach($langs as $lang){
		$point->translate[$lang] = new  \City\TextData(null,null);
		}

		}














		*/

		return $tour;
	}

	public function get_tours($lang,$points = true)
	{
		require 'vendor/City/src/Tour.php';
		$tours = [];

		foreach($this->get_all('tours') as $query)
		{


			$imgs = array_column(	$this->Crudmodel->get_all('img_tours',['tour_id'=>$query['id']]) ,'img');
			$tour = new \City\Tour();


			$tour->id = $query['id'];
			$tour->path = $query['path'];
			$tour->img =! empty($imgs)? base_url().'upload/'. $imgs[0] : NULL;
			$tour->distance = $query['distance'];
			$tour->period = $query['period'];
			$tour->per_min = $query['per_min'];
			$tour->price = $query['price'];


			// only one lang !!!
			$translate = $this->get_row( ['parent_id'=>$query['id'],'table'=>'tours' ,'lang_code'=>$lang  ], 'translate');
			if($lang != 'en')
			{
				$en    = $this->get_row( ['parent_id'=>$query['id'],'table'=>'tours' ,'lang_code'=>'en'  ], 'translate');
				$title = ($translate && $translate['title'] ) ? $translate['title'] : $en['title'];
				$text  = ($translate && $translate['text'] ) ? $translate['text'] : $en['text'];
			}
			else
			{
				$title = $translate['title'];
				$text  = $translate['text'] ;
			}




			$tour->translate[$lang] = new  \City\TextData($title,$text);

			if($points){




				$points_query = $this->get_joins('tours_points',[
						'points'=>'points.id = tours_points.point_id'],'points.*',null,null,['tours_points.tour_id'=>$query['id']]);


				foreach($points_query as $row){
					$point = new  \City\Point();



					$point->img = base_url().'img/get/'.$row['id'].'/points';

					$point->lat = $row['lat'];
					$point->lng = $row['lng'];


					//$lang

					$translate = $this->get_row( ['parent_id'=>$row['id'],'table'=>'points' ,'lang_code'=>$lang  ], 'translate');
					if($lang != 'en')
					{
						$en    = $this->get_row( ['parent_id'=>$row['id'],'table'=>'points' ,'lang_code'=>'en'  ], 'translate');
						$title = ($translate && $translate['title'] ) ? $translate['title'] : $en['title'];
						$text  = ($translate && $translate['text'] ) ? $translate['text'] : $en['text'];
					}
					else
					{
						$title = $translate['title'] ;
						$text  = $translate['text'] ;
					}

					$point->translate[$lang] = new  \City\TextData($title,$text);

					array_push($tour->pointArray,$point);
				}

			}

			array_push($tours,$tour);
		}


		return $tours;
	}


	public function get_tours_upd($lang)
	{

		$query = $this->get_joins('points',
			[

				"tours_points"=>"tours_points.point_id = points.id ",
				"tours"=>"tours.id = tours_points.tour_id ",


				"translate as tour_trans"=>"tours.id = tour_trans.parent_id  and tour_trans.lang_code = '".$lang."' ",
				"translate as tour"=>"tours.id = tour.parent_id  and tour.lang_code = 'en' ",

				"translate"=>"points.id = translate.parent_id  and translate.lang_code = '".$lang."' ",
				"translate as translate_en"=>"points.id = translate_en.parent_id and translate_en.lang_code = 'en' ",

				"img_tours as img_t"=>"img_t.tour_id = tours.id"
			],

			"points.lat as lat , points.lng as lng , points.meeting as meeting , points.id as pid,
			translate.title as title , translate.text as text ,

			tours_points.tour_id as tid,


			img_t.img as tour_img,

			tour_trans.text as tour_trans_text,
			tour_trans.title as tour_trans_title,

			tour.text as  tour_text,
			tour.title as tour_title,
			tours.*,

			translate_en.text as en_text,
			translate_en.title as en_title " ,NULL,NULL
		);

		$data = [
			'meetings'=>[],
			'tours'=>[],
		];
		
		
		
		array_walk_recursive($query, function(&$v) { $v = trim($v); });
		

	/*	echo "<pre>";
		foreach($query as $value)
		{
			print_r($value);
		}
		*/
		

		foreach($query as $value)
		{
			
			
			if($value['meeting'] == '1')
			{
				
			$img = array_column($this->Crudmodel->get_all('img',['point_id'=>$value['pid']]),'img');
			   $prefixed_array = preg_filter('/^/', base_url().'upload/', $img);
			

				array_push($data['meetings'],[
						'lat'=>$value['lat'],
						'lng'=>$value['lng'],
						'id'=>$value['pid'],
						'title'=> empty($value['title']) ? $value['en_title'] : $value['title'] ,
						'text'=>empty($value['text']) ? $value['en_text'] :$value['title'] ,
						'img'=>$prefixed_array
					]);
			}
			else
			{
			

				if(!array_key_exists($value['tid'],$data['tours'])  )
				{
					$data['tours'][$value['tid']] = [
						'title'=> empty($value['tour_trans_title']) ? $value['tour_title'] : $value['tour_trans_title'] ,
						'text'=>empty($value['tour_trans_text']) ? $value['tour_text'] :$value['tour_trans_text'] ,
						'price'=>$value['price'],
						'per_min'=>$value['per_min'],
						'period'=>$value['period'],
						'path'=>[],
						'distance'=>$value['distance'],
						'id'=>$value['tid'],

						'points'=>[],
						'tour_img'=>[]
					];

				}
				
				$img = array_column($this->Crudmodel->get_all('img',['point_id'=>$value['pid']]),'img');
			    $prefixed_array = preg_filter('/^/', base_url().'upload/', $img);
				array_push($data['tours'][$value['tid']]['points'],[
						'lat'=>$value['lat'],
						'lng'=>$value['lng'],
						'id'=>$value['pid'],
						'title'=> empty($value['title']) ? $value['en_title'] : $value['title'] ,
						'text'=>empty($value['text']) ? $value['en_text'] :$value['title'] ,
						'img'=>$prefixed_array

					]);
					
					
					
		
				if(!in_array($value['tour_img'],$data['tours'][$value['tid']]['tour_img']))
				array_push($data['tours'][$value['tid']]['tour_img'],base_url().'upload/'.$value['tour_img']);
			}


		}

		
		foreach($data['tours'] as $k=>$v){
		if($k == '')
			unset($data['tours'][$k]);
		}
	  /* 	echo "<pre>";

		print_r($data);

		die();  
		*/

		return $data;
	}


	public function get_points($lang)
	{
		$query = $this->get_joins('points',[
				"translate"=>"points.id = translate.parent_id and translate.lang_code = '".$lang."' ",
				"translate as translate_en"=>"points.id = translate_en.parent_id and translate_en.lang_code = 'en' ",],

			"points.* , translate.title as title , translate.text as text ,
			translate_en.text as en_text,
			translate_en.title as en_title " ,NULL,NULL,
			[ "points.tour_id" => 0 ]);

		//"translate"=>"points.id = translate.parent_id and translate.lang_code = '".$lang."' ",],



		foreach($query as & $value)
		{

			$value['img'] = base_url().'img/get/'.$value['id'].'/points';
			$value['text'] = ($value['text'] == null ) ?$value['en_text']  : $value['text'];
			$value['title'] = ($value['title'] == null ) ?$value['en_title']  : $value['title'];


		}

		return $query;
	}
}