<?php
require_once('ganon.php');
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://www.comelec.gov.ph/index.php?r=precinctresult',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        'fname' => 'Wernher-Bel',
        'mname' => 'Prudencio',
        'lname' => 'Ancheta',
        'month' => '02',
        'day' => '25',
        'year' => '1992'
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
$html = str_get_dom($resp);
$table = $html('.table-yellow', 0)->html();
$province_tr = $html('.table-yellow tr', 10)->html();
$city_tr = $html('.table-yellow tr', 11)->html();
$barangay_tr = $html('.table-yellow tr', 12)->html();

echo $province . ' ' . $city . ' ' . $barangay;
?>