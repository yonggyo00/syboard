/* Code based on Google Map APIv3 Tutorials */


var gmapdata;
var gmapmarker;
var infoWindow;

function gmap_init()
{
	var curpoint = new google.maps.LatLng(def_latval,def_longval);

	gmapdata = new google.maps.Map(document.getElementById("map"), {
		center: curpoint,
		zoom: def_zoomval,
		mapTypeId: 'roadmap',
		disableDoubleClickZoom: ddcz,
		draggable: def_draggable,
		scrollwheel: def_scrollwheel,
		panControl: def_panControl
		});

	gmapmarker = new google.maps.Marker({
					map: gmapdata,
					position: curpoint
				});

	infoWindow = new google.maps.InfoWindow;
	google.maps.event.addListener(gmapdata, 'click', function(event) {
		document.getElementById("longval").value = event.latLng.lng().toFixed(6);
		document.getElementById("latval").value = event.latLng.lat().toFixed(6);
		gmapmarker.setPosition(event.latLng);
		gmap_updateInfoWindow();
	});

	google.maps.event.addListener(gmapmarker, 'click', function() {
		gmap_updateInfoWindow();
		infoWindow.open(gmapdata, gmapmarker);
	});

	document.getElementById("longval").value = def_longval;
	document.getElementById("latval").value = def_latval;

	return false;
} // end of gmap_init


function gmap_loadpicker()
{
	var longval = document.getElementById("longval").value;
	var latval = document.getElementById("latval").value;

	if (longval.length > 0) {
		if (isNaN(parseFloat(longval)) == true) {
			longval = def_longval;
		} // end of if
	} else {
		longval = def_longval;
	} // end of if

	if (latval.length > 0) {
		if (isNaN(parseFloat(latval)) == true) {
			latval = def_latval;
		} // end of if
	} else {
		latval = def_latval;
	} // end of if

	var curpoint = new google.maps.LatLng(latval,longval);

	gmapmarker.setPosition(curpoint);
	gmapdata.setCenter(curpoint);
	//gmapdata.setZoom(zoomval);

	gmap_updateInfoWindow();
	return false;
} // end of gmap_loadpicker



function gmap_updateInfoWindow()
{
	infoWindow.setContent("Longitude: "+ gmapmarker.getPosition().lng().toFixed(6)+"<br>"+"Latitude: "+ gmapmarker.getPosition().lat().toFixed(6));
} // end of gmap_bindInfoWindow
