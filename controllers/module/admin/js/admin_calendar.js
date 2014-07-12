$(document).ready(function() {
	$("#admin-calendar > #top-pannel > #prev").click(function() {
		var year = parseInt($("#admin-calendar #date-container").attr('year'));
		var month = parseInt($("#admin-calendar #date-container").attr('month'));
		
		
		if ( month == 1 ) {
			var prev_year = year - 1;
			var prev_month = 12;
		}
		else {
			var prev_month = month - 1;
			var prev_year = year;
		}
		
		load_calendar(prev_year, prev_month);
		$("#admin-calendar #date-container").attr('year', prev_year);
		$("#admin-calendar #date-container").attr('month', prev_month);
		
	});
	
	$("#admin-calendar > #top-pannel > #next").click(function() {
		var year = parseInt($("#admin-calendar #date-container").attr('year'));
		var month = parseInt($("#admin-calendar #date-container").attr('month'));
		
		if ( month == 12 ) {
			var next_month = 1;
			var next_year = year + 1;
		}
		else {
			var next_month = month + 1;
			var next_year = year;
		}
		
		
		load_calendar(next_year, next_month);
		$("#admin-calendar #date-container").attr('year', next_year);
		$("#admin-calendar #date-container").attr('month', next_month);
	});
	
	$("body").on("click", "#admin-calendar .cel_view_schedule", function() {
		var popup_url = $(this).attr('popup_url');
		layer_popup($(this), popup_url, 600, 600, 1);
	});	
	
});

function load_calendar(year, month) {
	$.ajax({
			type : "GET",
			url : "?module=admin&action=admin_calendar_content&layout=1&header=1",
			data : { skin_year : year, skin_month : month },
			success : function(data) {
				if ( month < 10 ) month = "0"+month;
				$("#admin-calendar > #title").text(year + "년 " + month + "월");
				$("#admin-calendar > #date-container").html(data);
			},
			error : function(res) {
			
			}
	});
}