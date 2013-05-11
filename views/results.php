<div class="container" id="result_container">
	<div id="result_summary" class="alert alert-info">
	Your precinct number is <span class="precinct_number">0023</span> San Fernando La Union
	</div>
	<?php
	echo $table;
	?>
</div>

<div id="map-canvas"></div>

<script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
<script src="libs/bootstrap/js/bootstrap.min.js"></script>	
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD9uiyFbXfbSOsY6umTUtl4_rvl_LkQKxE&sensor=false&libraries=places">
</script>	
	
<script>
	$('.table-yellow tr:eq(0)').hide();
	$('tr:eq(17), tr:eq(18), tr:eq(19), tr:eq(20), tr:eq(21)').remove();
	$('table td').removeAttr('style');
	
	$('tr:eq(0)').addClass('bold');
	$('tr:eq(7)').addClass('bold')

	$('table').addClass('table table-striped');

	$('#result_container').show();

	var province = $('tr:eq(9) td:eq(1)').text();
	var city = $('tr:eq(10) td:eq(1)').text();
	var barangay = $('tr:eq(11) td:eq(1)').text();
	var polling_center = $('tr:eq(11) td:eq(1)').text(); 
	var precinct = $('tr:eq(13) td:eq(1)').text();

	if($('.table-yellow tr:eq(0) td').text() == 'RECORD NOT FOUND'){

	}else{
		$('#result_summary').html("Your precinct number is <span class='precinct_number'>" + precinct + "</span> at " + polling_center + " " + barangay + " " + city + " " + province);	
	}


	var p_center_query = encodeURIComponent(polling_center);
	var brgy_query = encodeURIComponent(barangay + " " + city + " " + province);
	var city_query = encodeURIComponent(city + " " + province);
	var province_query = encodeURIComponent(province);


	$.ajax({
	  url: 'https://maps-api-ssl.google.com/maps/suggest?q=' + p_center_query,
	  type: 'GET',
	  dataType : 'jsonp',
		success: function(response){
			if(response.probability_sum[0] == 0){
				$.ajax({
				  url: 'https://maps-api-ssl.google.com/maps/suggest?q=' + brgy_query,
				  type: 'GET',
				  dataType : 'jsonp',
					success: function(response){
						if(response.probability_sum[0] == 0){
							$.ajax({
							  url: 'https://maps-api-ssl.google.com/maps/suggest?q=' + city_query,
							  type: 'GET',
							  dataType : 'jsonp',
								success: function(response){
									if(response.probability_sum[0] == 0){
										$.ajax({
										  url: 'https://maps-api-ssl.google.com/maps/suggest?q=' + province_query,
										  type: 'GET',
										  dataType : 'jsonp',
											success: function(response){
												if(response.probability_sum[0] != 0){
													var query = encodeURIComponent(response.suggestion[0].query);
												  get_geocode(query);	
												}else{
													$('#map-canvas').html("<h4>Sorry your polling center isn't geo-coded yet</h4>")
												}
											}
										});										
									}else{
										var query = encodeURIComponent(response.suggestion[0].query);
									  get_geocode(query);										
									}
								}
							});
						}else{
							var query = encodeURIComponent(response.suggestion[0].query);
						  get_geocode(query);
						}
					}
				});
			}else{
				var query = encodeURIComponent(response.suggestion[0].query);
			  get_geocode(query);
			}
		}
	});


	function get_geocode(query){

		$.ajax({
		  url: 'http://maps.googleapis.com/maps/api/geocode/json?address=' + query + '&sensor=false',
		  type: 'GET',
		  dataType : 'json',
		  success: function(response){
		  	var lat = response.results[0].geometry.location.lat;
		  	var lng = response.results[0].geometry.location.lng;
		    plot_location(lat, lng);
		  }
		});
	}


	function plot_location(lat, lng){

		var homeLatlng = new google.maps.LatLng(lat, lng);
		var homeMarker = new google.maps.Marker({
		    position: homeLatlng,
		    map: map,
		    draggable: true
		});

		var myOptions = {
		    center: new google.maps.LatLng(lat, lng),
		    zoom: 17,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);

		homeMarker.setMap(map);
		homeMarker.setPosition(map.getCenter());
		map.setCenter(homeMarker.getPosition());
		map.setZoom(17);
	}
</script>