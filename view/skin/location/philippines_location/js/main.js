$(document).ready(function() {
	$("#philippines-location select[name='province']").change(function() {
		$("#philippines-location .cities").removeAttr('name').hide();
		var cities = $("option:selected", this).attr('cities');
		$("#philippines-location #cities_"+cities).prop("name", "city").show();
	});
});