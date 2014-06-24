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
			alert("회원가입약관 및 개인보호정책에 동의 해 주세요.");
		}
		
	});
});