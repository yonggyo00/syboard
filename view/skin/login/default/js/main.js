$(document).ready(function() {
	/*
	$('#login-form').submit(function(e){
		console.log(e);
		e.preventDefault();
		var username = $(this).children("input[name='username']").val();
		var password = $(this).children("input[name='password']").val();
		if ( username == "" || password == "") alert ("아이디, 비밀번호를 모두 입력해 주세요"); 
		else if ( username != "" && password != "" ) {
			$.ajax({
				type: "post",
				data: {"username" : username, "password" : password},
				url: "?module=member&action=login&layout=1&header=1",
				success: function(data) {
					alert(data);
				},
				error: function(res) {
					console.log(res);
				}
			});
		}
	}); */
});