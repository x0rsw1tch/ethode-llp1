var username;

function loginUser () {
	var userLogged = false;
	if (checkUser()) {
		if (!userLogged && hasLocalStorage()) {
			localStorage.setItem('username', String($("input.username").val()));
			username = String($("input.username").val()).toLowerCase();
			userLogged = true;
		}
		if (!userLogged && hasSessionStorage()) {
			sessionStorage.setItem('username', String($("input.username").val()));
			username = String($("input.username").val()).toLowerCase();
			userLogged = true;
		}
		if (!userLogged && !hasLocalStorage() && !hasLocalStorage()) {
			username = String($("input.username").val()).toLowerCase();
			userLogged = true;
		}
	}
	if (userLogged && username) {
		window.location.pathname = '/';
	}
}

function checkUser () {
	if ($("input.username") && $("input.username").val() && $("input.username").val().length < 2 || isUsernameInvalid()) {
		$("#username-input-message").removeClass('hide');
		$("#username-input-message").addClass('text-alert');
		$("#username-input-message").html('A proper username is required to proceed<br>(&gt;1char, letters/hyphens only)');
		$('.login-btn').prop('disabled', true);
		return false;
	} else {
		$("#username-input-message").addClass('hide');
		$("#username-input-message").removeClass('text-alert');
		$("#username-input-message").html('');
		$('.login-btn').prop('disabled', false);
		return true;
	}
}

function hasLocalStorage () {
	if (window.localStorage) { 
		if (typeof localStorage.getItem === "function" && typeof localStorage.setItem === "function") {
			return true;
		}
	}
	return false;
}

function hasSessionStorage () {
	if (window.sessionStorage) { 
		if (typeof sessionStorage.getItem === "function" && typeof sessionStorage.setItem === "function") {
			return true;
		}
	}
	return false;
}

function isUsernameInvalid () {
	if (/[^a-zA-Z]+/ig.test(String($("input.username").val())) === true || /[aeiouy]+/ig.test(String($("input.username").val())) === false) {
		return true;
	} else {
		return false;
	}
}

$(document).ready(function() { 
    $("input.username").on("keyup", function (e) {
		if(e.keyCode == 13) {
			$("button.login-btn").click();
    	} else {
			checkUser();
		}
	});

	$('input.username').focus();
});
