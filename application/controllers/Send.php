<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send extends CI_Controller{
	
	private $discount =  false;

	public function __construct(){
		parent::__construct();

		$this->load->language('front');
		$mail_cofig = $this->config->item('email');
		$this->load->library('email',$mail_cofig);
		
		
		
		$this->discount = $this->_make_discount();

	}

	public function index(){


		if(isset($_POST)){


			$secret          = "6Leh_oUUAAAAABlfBZNE62bJTjgqZd0PnP0hCavT";
			$response        = $_POST["g-recaptcha-response"];



			$verify          = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
			$captcha_success = json_decode($verify);

			if($captcha_success->success == false){
				echo false;
				exit();
			}

			$message = $_POST['message'];
			// 1 this is booking ?
			$_POST['message'] = "";
			if(isset($_POST['tours'])){

				$order_date = DateTime::createFromFormat('d/m/Y T H:i', $_POST['date'] . ' T ' . $_POST['hour']);


				// add to database send email to Us6\
				if(isset($_POST['meeting_point'])){
					$_POST['message'] .= "<p>".lang('I self go till meeting point')."</p>";
				}
				else
				if(isset($_POST['pick_up'])){
					$_POST['message'] .= "<p>".lang('Pick up location') . $_POST['pick_up'];
				}

				$tours            = $this->Crudmodel->get_tour($_POST['tours'],$this->lang_array());
				
				
				$title = isset($tours->translate[$this->config->item('language')]) ? $tours->translate[$this->config->item('language')]->title :$tours->translate['en']->title ;

				$add_to_callendar =
				$this->squarecandy_add_to_gcal($title ,
					$order_date->format("Ymd\THis"),
					$order_date->format("Ymd\THis"),
					$_POST["tours"] . "<br>" . $_POST['email'] . "<br>" . $_POST['phone'] . "<br>" . $_POST['name']. "<br>" . $_POST['message'],
					isset($_POST['pick_up']) ? $_POST['pick_up'] : NULL	,false, lang('Tour date').": " . $_POST['date'] . lang('Time') . $_POST["hour"] ) ;


				$_POST['message'] .= $add_to_callendar ;
				
				
				$_POST['message'] .= "<p>".lang('Discount Code') ."<strong>". $this->discount . "</strong></p>";

				$_POST['message'] .= "<p>".lang('Tour') . $title . "</p>";
				$_POST['message'] .= "<p>".lang('Message') . $message."</small></br></br></hr></br></br>";


				// add to database
				$order_id = $this->_addbooking($_POST,$order_date,$message);

				// send ticket to user

				$header   = $title  ;
				$text     = $_POST['message'];
				if($this->discount){
					$buttons  = [base_url().'manage/'.$order_id ."?code=".$this->discount  =>lang('manage')];
				}else{
					$buttons  = [base_url().'manage/'.$order_id=>lang('manage')];
				}
				
				// send email to us

				$html     = $this->load->view('email/ticket',compact('header','text','buttons'),TRUE);

				$this->_sendMessage($_POST['email'],EMAIL,
					$title,$html
				);
				/////////////
				$_POST['message'] .= '</p><p>Name  : ' . $_POST['name'];
				$_POST['message'] .= "</p><p>Phone : <a href='tel:" . $_POST['phone'] . "'>" . $_POST['phone'] . "<a> </p>";
				$_POST['message'] .= "</p><p>Email : <a href='mailto:" . $_POST['email'] . "'>" . $_POST['email'] . "<a> </p>";


				$header = $title ;
				$text   = $_POST['message'];
				$buttons= [base_url().'admin/tours_orders/edit/'.$order_id=>lang('manage')];


				$html   = $this->load->view('email/ticket',compact('header','text','buttons'),TRUE);


				$this->_sendMessage('kowook06@gmail.com',$_POST['email'],
					$title,$html
				);
			}
			else{
				$_POST['message'] .= '</p><p>Name  : ' . $_POST['name'];
				$_POST['message'] .= "</p><p>Phone : <a href='tel:" . $_POST['phone'] . "'>" . $_POST['phone'] . "<a> </p>";
				$_POST['message'] .= "</p><p>Email : <a href='mailto:" . $_POST['email'] . "'>" . $_POST['email'] . "<a> </p>";
				$_POST['message'] .= "<p>".lang('Message')."<small>.".$message."</small></br></br></hr></br></br>";


				$html = $this->load->view('email/ticket',['text'=>$_POST['message'] ],TRUE);


				$this->_sendMessage('kowook06@gmail.com',$_POST['email'],
					lang('Discover Nice'),$html
				);
			}



			echo true;
			return;

		}
		echo false;


	}
	
	private function _make_discount(){
		
		return "lucky_".rand(11111,99999);
	}

	private function  _sendMessage($to,$reply = EMAIL,$subject,$message){

		$this->email->from(EMAIL,lang('Discover Nice'));


		$this->email->to($to);
		$this->email->reply_to($reply);
		$this->email->bcc("jemeljanovs.igors@gmail.com,mauguzun@gmail.com,fabricedebiasio@gmail.com");

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
		$this->email->print_debugger();


	}
	private function  _addbooking($data,$order_date,$message){


		$query = $this->Crudmodel->add(
			[
				'tour_id'=>$data['tours'],
				'email'=>$data['email'],
				'phone'=>$data['phone'],
				'order_date'=>$order_date->format("Y-m-d H:i:s"),
				'name'=>$data['name'],
				'pick_up'=>isset($data['pick_up']) ? $data['pick_up'] : 'meeting point' ,
				'message'=>$message,		
				'discount'=>$this->discount,


			],'tours_orders');

		return $query;
	}

	private function squarecandy_add_to_gcal(
		$name,
		$startdate,
		$enddate = false,
		$description = false,
		$location = false,
		$allday = false,
		$linktext = 'Add Event to callendar'){
		// calculate the start and end dates, convert to ISO format
		if($allday){
			$startdate = date('Ymd', strtotime($startdate));
		}
		else{
			$startdate = date('Ymd\THis', strtotime($startdate));
		}


		if($enddate && !empty($enddate) && strlen($enddate) > 2){
			if($allday){
				$enddate = date('Ymd', strtotime($enddate . ' + 1 day'));
			}
			else{
				$enddate = date('Ymd\THis', strtotime($enddate));
			}
		}
		else{
			$enddate = date('Ymd\THis', strtotime($startdate . ' + 2 hours'));
		}
		// build the url
		$url = 'http://www.google.com/calendar/event?action=TEMPLATE';
		$url .= '&text=' . rawurlencode($name);
		$url .= '&dates=' . $startdate . '/' . $enddate;

		if($description){
			$url .= '&details=' . rawurlencode($description);
		}
		if($location){
			$url .= '&location=' . rawurlencode($location);
		}
		// build the link output
		$output = '<a title="add to google calendar" href="' . $url . '" >' . $linktext . '</a>';
		return $output;
	}


}