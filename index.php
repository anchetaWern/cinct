<?php
error_reporting(0);
require 'flight/Flight.php';

Flight::before('start', function(&$params, &$output){

	Flight::render('header.php'); 
});

Flight::route('/', function(){
	Flight::render('form.php');
});

Flight::route('/results', function(){
	require_once('libs/ganon.php');
	
	$fname 	= $_POST['fname'];
	$mname 	= $_POST['mname'];
	$lname 	= $_POST['lname'];
	$bday 	= explode('/', $_POST['bday']);
	$month	= $bday[0];
	$day 		= $bday[1];
	$year 	= $bday[2];
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => 'http://www.comelec.gov.ph/index.php?r=precinctresult',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => array(
	        'fname' => $fname,
	        'mname' => $mname,
	        'lname' => $lname,
	        'month' => $month,
	        'day' 	=> $day,
	        'year' 	=> $year
	    )
	));

	$resp = curl_exec($curl);

	curl_close($curl);
	$html = str_get_dom($resp);

	$table = $html('.table-yellow', 0)->html();

	if(!empty($table)){
		Flight::render('results.php', array('table' => $table));
	}else{
		Flight::render('results.php', array('error' => 'An error occured. Its either the information you entered does not belong to a registered voter or the information cannot be accessed from the comelec website at this moment.'));
	}


});

Flight::start();
?>