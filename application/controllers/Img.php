<?php
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Img extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{




		foreach(	$this ->Crudmodel->get_all("points")  as $point)
		{

			$imgname = 'upload/'.$point['id'].'.jpg';


			try
			{
				$img   = base64_decode(explode(',',$point['img'])[1]);
				@$image = imagecreatefromstring($img);
				@imagejpeg($image, $imgname);

				$this->Crudmodel->update_or_insert([
						'img'=>$point['id'].'.jpg',
						'point_id'=>$point['id']

					],'img');
			}
			catch(Exception $e)
			{

			}



		}








		/*		$img = ;
		echo  file_put_contents('img.png',$img );*/





		//	echo ' < img src = "' . $query['img'] . '" />';

	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */