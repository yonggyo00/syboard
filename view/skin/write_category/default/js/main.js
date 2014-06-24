$(document).ready(function(){
	$("#write-category select[name='category']").change(function(){
		var sub_category = $('option:selected', this).attr('category');
		
		$("#write-category .sub_category").removeAttr('name').hide();
		$("#write-category select[sub_category='"+sub_category+"']").prop('name', 'sub_category').show();
	});
});