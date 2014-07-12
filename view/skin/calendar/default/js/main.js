$(document).ready(function() {
	$(".calendar-skin-default > #top-pannel > #prev").click(function() {
		var year = parseInt($(".calendar-skin-default #date-container").attr('year'));
		var month = parseInt($(".calendar-skin-default #date-container").attr('month'));
		
		
		if ( month == 1 ) {
			var prev_year = year - 1;
			var prev_month = 12;
		}
		else {
			var prev_month = month - 1;
			var prev_year = year;
		}
		
		load_calendar(prev_year, prev_month);
		$(".calendar-skin-default #date-container").attr('year', prev_year);
		$(".calendar-skin-default #date-container").attr('month', prev_month);
		
	});
	
	$(".calendar-skin-default > #top-pannel > #next").click(function() {
		var year = parseInt($(".calendar-skin-default #date-container").attr('year'));
		var month = parseInt($(".calendar-skin-default #date-container").attr('month'));
		
		if ( month == 12 ) {
			var next_month = 1;
			var next_year = year + 1;
		}
		else {
			var next_month = month + 1;
			var next_year = year;
		}
		
		
		load_calendar(next_year, next_month);
		$(".calendar-skin-default #date-container").attr('year', next_year);
		$(".calendar-skin-default #date-container").attr('month', next_month);
	});
	
	$("body").on("click", ".calendar-skin-default .cel_view_schedule", function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 500, 600, 1);
	});	
	
});

function load_calendar(year, month) {
	$.ajax({
			type : "GET",
			url : "?skin=calendar&dir=default&file=content&layout=1&header=1",
			data : { skin_year : year, skin_month : month },
			success : function(data) {
				if ( month < 10 ) month = "0"+month;
				$(".calendar-skin-default > #title").text(year + "년 " + month + "월");
				$(".calendar-skin-default > #date-container").html(data);
			},
			error : function(res) {
			
			}
	});
}