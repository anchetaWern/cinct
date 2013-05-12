<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="libs/bootstrap/plugins/datepicker/css/datepicker.css">
	<link rel="stylesheet" href="css/main.css">
  <script>
  document.addEventListener("DOMContentLoaded", function (){
    var result_summary = document.getElementById('result_summary');
    var precinct_finder_form = document.getElementById('form_precintfinder');
    var no_results = document.getElementById('no_results');
    if(!result_summary && !precinct_finder_form){
      no_results.setAttribute('style', 'display:block');
    }
  }, false);
  </script> 
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="./index.html">Cinct</a>
        </div>
      </div>
      <div class="container">
        <div id="no_results" class="alert alert-error">
        Sorry either the comelec website is not accessible at the moment. Or there was a problem accessing the data. <br/>You can try to visit the comelec webiste at <a href="http://comelec.gov.ph">comelec.gov.ph</a> and use the official precinct finder.
        </div>
      </div>
    </div>
