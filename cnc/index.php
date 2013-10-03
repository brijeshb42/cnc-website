<?php

$f3 = require('../lib/base.php');

$f3->config('../app/config.ini');

$f3->config('../app/routes.ini');

$f3->set('db','mysql:host=localhost;port=3306;dbname=cnc');

$f3->route('GET /captcha',function(){
	$img = new Image();
	$img->captcha('fonts/Novecentowide-Bold-webfont.ttf',16,5,'SESSION.captcha_code');
	$img->render();
});

$f3->route('GET /meAdmin/@type',function($f3,$params){
	if(!in_array($params['type'],array('boys','girls')))
		die('Wrong URL');
	$ip = array('127.0.0.1','192.168.102.69','192.168.101.48','192.168.102.93');
	if(!in_array($_SERVER['REMOTE_ADDR'], $ip))
		die('Invalid request');
	$db = $f3->set('DB',new DB\SQL($f3->get('db'),'cnc','cncadmin'));
	$query1 = 'SELECT game_type,year,your_name,team_name,your_email,your_phone,your_phone2 FROM boys ORDER BY game_type';
	$query2 = 'SELECT game_type,year,your_name,team_name FROM girls ORDER BY game_type';
	if($params['type']=='boys')
		$data = $db->exec($query1);
	else
		$data = $db->exec($query2);
	if($db->count()){
		echo '<table border="1">';
		if($params['type']=='boys'){
			echo '<tr><th>#</th><th>Game</th><th>Year</th><th>Name</th><th>Team</th><th>Email</th><th>Phone</th><th>Phone2</th></tr>';
		}else{
			echo '<tr><th>#</th><th>Game</th><th>Year</th><th>Name</th><th>Team</th></tr>';
		}
		$count = 1;
		foreach ($data as $player) {
			if($params['type']=='boys'){
				echo '<tr><td>'.$count.'</td><td>'.$player['game_type'].'</td><td>'.$player['year'].'</td><td>'.$player['your_name'].'</td><td>'.$player['team_name'].'</td><td>'.$player['your_email'].'</td><td>'.$player['your_phone'].'</td><td>'.$player['your_phone2'].'</td></tr>';
			}else{
				echo '<tr><td>'.$count.'</td><td>'.$player['game_type'].'</td><td>'.$player['year'].'</td><td>'.$player['your_name'].'</td><td>'.$player['team_name'].'</td></tr>';
			}
			$count++;
		}
		echo '</table>';
	}else{
		echo 'No registrations yet.';
	}
});

$f3->run();
