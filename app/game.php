<?php

class Game extends Controller{
	
	function index($f3){
		$f3->set('boy',true);
		$dir = dirname(dirname(__FILE__)).'\cnc\img\gallery\\';
		$img = array();
		if($handle = opendir($dir)){
			while(false !== ($entry = readdir($handle))){
				array_push($img, $entry);
			}
		}
		$f3->set('title','CnC | Home');
		$f3->set('img',$img);
	}

	function error($f3){
		$f3->set('title','CnC | Error');
	}

	function process($f3){
		$type = array('cstrike','dota','fifa','cod','nfs','flatout','ruzzle','angry');
		$year = array('2010','2011','2012','2013');
		$vars = array();
		$vars['type'] = 'error';
		$regex_email = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		$regex_name = '/^[a-zA-Z ]+$/';
		$regex_phone = '/^[0-9]{10}$/';
		if($f3->get('AJAX')){
			if($f3->get('POST.captcha')!=$f3->get('SESSION.captcha_code')){
				$vars['data'] = 'Security code does not match.';
			}else if(!$f3->exists('POST.game_type') || !$f3->exists('POST.year') || !$f3->exists('POST.your_name') || !$f3->exists('POST.team_name') || !$f3->exists('POST.your_email') || !$f3->exists('POST.your_phone')){
				$vars['data'] = 'One or more fields are missing.';
			}elseif(strlen($f3->get('POST.your_name'))==0 || strlen($f3->get('POST.your_email'))==0 || strlen($f3->get('POST.team_name'))==0 || strlen($f3->get('POST.your_phone'))==0){
				$vars['data'] = 'Please fill in all the details.';
			}else if(in_array($f3->get('POST.game_type'), array('cstrike','dota','cod')) && (strlen($f3->get('POST.your_phone2'))==0 || !preg_match($regex_phone, $f3->get('POST.your_phone2')))){
				$vars['data'] = 'Provide alternate contact number in case of clan games.';
			}else if(!preg_match($regex_name, $f3->get('POST.your_name'))){
				$vars['data'] = 'Please enter a valid name.';
			}else if(!preg_match($regex_email, $f3->get('POST.your_email'))){
				$vars['data'] = 'Please enter a valid email.';
			}else if(!preg_match($regex_phone, $f3->get('POST.your_phone'))){
				$vars['data'] = 'Please enter a 10 digit phone number.';
			}else if(!in_array($f3->get('POST.game_type'),$type)){
				$vars['data'] = 'Invalid game type.';
			}else if(!in_array($f3->get('POST.year'), $year)){
				$vars['data'] = 'Invalid year.';
			}else{
				$db = $this->db;
				$reg = new DB\SQL\Mapper($db,'boys');
				$reg->game_type = $f3->get('POST.game_type');
				$reg->year = $f3->get('POST.year');
				$reg->your_name = $f3->get('POST.your_name');
				$reg->team_name = $f3->get('POST.team_name');
				$reg->your_email = $f3->get('POST.your_email');
				$reg->your_phone = $f3->get('POST.your_phone');
				$reg->your_phone2 = $f3->get('POST.your_phone2');
				$reg->ip = $_SERVER['REMOTE_ADDR'];
				if($reg->save()){
					$vars['type'] = 'success';
					$vars['data'] = 'Your team '.$f3->get('POST.team_name').' was registered for '.$f3->get('POST.game_type');
				}else{
					$vars['data'] = 'Error while saving your details.';
				}
			}
		}else{
			$vars['data'] = 'Invalid request.';
		}
		$f3->set('vars',$vars);
	}

	function girls($f3){
		$f3->set('boy',false);
		$f3->set('title','CnC | Girls');
	}

	function saveGirls($f3){
		$type = array('cstrike','dota','fifa','cod','nfs','flatout','ruzzle','angry');
		$year = array('2010','2011','2012','2013');
		$vars = array();
		$vars['type'] = 'error';
		$regex_name = '/^[a-zA-Z ]+$/';
		if($f3->get('AJAX')){
			if($f3->get('POST.captcha')!=$f3->get('SESSION.captcha_code')){
				$vars['data'] = 'Security code does not match.';
			}else if(!$f3->exists('POST.game_type') || !$f3->exists('POST.year') || !$f3->exists('POST.your_name') || !$f3->exists('POST.team_name')){
				$vars['data'] = 'One or more fields are missing.';
			}elseif(strlen($f3->get('POST.your_name'))==0 || strlen($f3->get('POST.team_name'))==0){
				$vars['data'] = 'Please fill in all the details.';
			}else if(!preg_match($regex_name, $f3->get('POST.your_name'))){
				$vars['data'] = 'Please enter a valid name.';
			}else if(!in_array($f3->get('POST.game_type'), $type)){
				$vars['data'] = 'Invalid game type.';
			}else if(!in_array($f3->get('POST.year'), $year)){
				$vars['data'] = 'Invalid year.';
			}else{
				$db = $this->db;
				$reg = new DB\SQL\Mapper($db,'girls');
				$reg->game_type = $f3->get('POST.game_type');
				$reg->year = $f3->get('POST.year');
				$reg->your_name = $f3->get('POST.your_name');
				$reg->team_name = $f3->get('POST.team_name');
				$reg->ip = $_SERVER['REMOTE_ADDR'];
				if($reg->save()){
					$vars['type'] = 'success';
					$vars['data'] = 'Your team '.$f3->get('POST.team_name').' was registered for '.$f3->get('POST.game_type');
				}else{
					$vars['data'] = 'Error while saving your details.';
				}
			}
		}else{
			$vars['data'] = 'Invalid request.';
		}
		$f3->set('vars',$vars);
	}
}