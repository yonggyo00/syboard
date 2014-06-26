$(document).ready(function(){
	$("#member-policy-form").submit(function(e){
		e.preventDefault();
		var terms_conds_agree = $("input[name='terms_conds_agree']").prop("checked");
		var policy_agree = $("input[name='policy_agree']").prop("checked");
		
		if ( terms_conds_agree && policy_agree ) {
			$(this).remove();
			$("#member-register").show();
		}
		else {
			alert(sm_register_terms_and_condition_agree);
		}
	});
});