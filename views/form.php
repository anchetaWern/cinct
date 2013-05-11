<div class="container" id="cinct_form">
	<h3>Precinct Finder</h3>
	<div id="app_info" class="alert alert-info">
  	The data from this application comes directly from the comelec website.
  	<button type="button" class="close" data-dismiss="alert">&times;</button>
	</div>
	<form class="form-horizontal" id="form_precintfinder" action="results" method="POST">
	
		<div class="control-group">
			<label for="fname" class="control-label">First Name</label>
			<div class="controls">
		  	<input type="text" id="fname" name="fname">
			</div>
		</div>
	 
	 	<div class="control-group">
	  	<label for="mname" class="control-label">Middle Name</label>
	 		<div class="controls">
	  		<input type="text" id="mname" name="mname">
	 		</div>
	 	</div>
	 
	  <div class="control-group">
	  	<label for="lname" class="control-label">Last Name</label>
	 		<div class="controls">
	  		<input type="text" id="lname" name="lname">
	 		</div>
	 	</div>
	  
	  <div class="control-group">
	  	<label for="bday" class="control-label">Birthday</label>
	 		<div class="controls">
	  		<input type="text" id="bday" name="bday" placeholder="mm/dd/yyyy"> 
	 		</div>
	 	</div>	  
	  
	  
	 	<div class="control-group">
	 		<div class="controls">
	 			<button type="submit" id="submit_form" class="btn btn-success">Submit</button>
	 		</div>
	 	</div>
	</form>
</div>


<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>
<script src="libs/bootstrap/plugins/datepicker/js/bootstrap-datepicker.js"></script>
<script>

	var isDateValid = function(str_date){
	  var parts = str_date.split('/');
	  if(parts.length == 3){

	    var month = parseInt(parts[0], 10) - 1;
	    if(month.length == 1){
	    	month = '0' + month.toString();
	    }
	    var day = parseInt(parts[1], 10);
	    var year = parseInt(parts[2], 10);
	    var date = new Date(year, month, day);

	    if(month == date.getMonth() && day == date.getDate() && year == date.getFullYear()){
	      return true;
	    }
	    
	  }
	  return false;
	}

	$('#bday').datepicker();

	$('#form_precintfinder').submit(function(e){
		e.preventDefault();

		var has_inputs = $('input[type="text"], textarea').filter(function(){ return $(this).val(); });
		
		var birth_date = $('#bday').val();
		if(!isDateValid(birth_date) && birth_date != ''){
			alert('The date that you have entered is invalid');
		}

		if(has_inputs.length == 4){
			this.submit();
		}else{
			alert('Please input all the information being asked');
		}
	});
</script>