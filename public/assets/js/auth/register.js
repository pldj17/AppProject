// form.js 
window.onload = function() { 
	document.my_form.onsubmit = function()  { return checkForm(); }
	document.my_form.lastNameInput.onblur = lastNameValidate; 
	document.getElementById("emailInput").onblur = emailValidate; 
	document.getElementById("informationInput").onblur = function() { informationValidate(); }; 
} 

function firstNameValidate() { 

	var firstNameInput = document.getElementById("firstNameInput"); 

	if(firstNameInput.value == "") {  
		document.getElementById("firstNameInputStatus").style.display = "block";
		firstNameInput.parentNode.className = "form-group has-error has-feedback"; 
		document.getElementById("firstNameIcon").className = "fas fa-times form-control-feedback"; 
		return false; 
	} else { 
		document.getElementById("firstNameInputStatus").style.display = "none"; 
		firstNameInput.parentNode.className = "form-group has-success has-feedback"; 
		document.getElementById("firstNameIcon").className = "glyphicon glyphicon-ok form-control-feedback"; 
		return true; 
	}
}

function lastNameValidate() { 

	var lastNameInput = document.getElementById("lastNameInput");

	if(lastNameInput.value == "") { 
		document.getElementById("lastNameInputStatus").style.display = "block"; 
		lastNameInput.parentNode.className = "form-group has-error has-feedback"; 
		document.getElementById("lastNameIcon").className = "fas fa-times form-control-feedback";
		return false; 
	} else { 
		document.getElementById("lastNameInputStatus").style.display = "none"; 
		lastNameInput.parentNode.className = "form-group has-success has-feedback";
		document.getElementById("lastNameIcon").className = "glyphicon glyphicon-ok form-control-feedback";
		return true; 
	}
}

function emailValidate() { 

	if(emailInput.value == "") { 
		document.getElementById("emailInputStatus").innerHTML = "Email address is required!"; 
		document.getElementById("emailInputStatus").style.display = "block"; 
		emailInput.parentNode.className = "form-group has-error has-feedback"; 
		document.getElementById("emailIcon").className = "fas fa-times form-control-feedback";
		return false; 
	} else if(!validEmailAddress(emailInput.value)) { 
		document.getElementById("emailInputStatus").innerHTML = "Incorrect email address format!"; 
		document.getElementById("emailInputStatus").style.display = "block"; 
		emailInput.parentNode.className = "form-group has-warning has-feedback";
		document.getElementById("emailIcon").className = "glyphicon glyphicon-warning-sign form-control-feedback";
		return false; 
	} else { 
		document.getElementById("emailInputStatus").style.display = "none"; 
		emailInput.parentNode.className = "form-group has-success has-feedback";
		document.getElementById("emailIcon").className = "glyphicon glyphicon-ok form-control-feedback";
		return true; 
	}
}

function informationValidate() { 

	if(informationInput.value == "") { 
		document.getElementById("informationInputStatus").style.display = "block"; 
		informationInput.parentNode.className = "form-group has-error has-feedback"; 
		document.getElementById("informationIcon").className = "fas fa-times form-control-feedback";
		return false; 
	} else { 
		document.getElementById("informationInputStatus").style.display = "none"; 
		informationInput.parentNode.className = "form-group has-success has-feedback"; 
		document.getElementById("informationIcon").className = "glyphicon glyphicon-ok form-control-feedback";
		return true; 
	}
}

function paymentValidate() { 

	if(paymantAmountInput.value == "") { 
		document.getElementById("paymentAmountInputStatus").innerHTML = "Payment amount is required!"; 
		document.getElementById("paymentAmountInputStatus").style.display = "block"; 
		paymantAmountInput.parentNode.className = "form-group has-error has-feedback"; 
		document.getElementById("paymentAmountIcon").className = "fas fa-times form-control-feedback";
		return false; 
	} else if(!validPaymantAmount(paymantAmountInput.value)) { 
		document.getElementById("paymentAmountInputStatus").innerHTML = "Payment amount should be greater than zero!"; 
		document.getElementById("paymentAmountInputStatus").style.display = "block";
		paymantAmountInput.parentNode.className = "form-group has-warning has-feedback"; 
		document.getElementById("paymentAmountIcon").className = "glyphicon glyphicon-warning-sign form-control-feedback";
		return false; 
	} else { 
		document.getElementById("paymentAmountInputStatus").style.display = "none"; 
		paymantAmountInput.parentNode.parentNode.className = "form-group has-success has-feedback";
		document.getElementById("paymentAmountIcon").className = "glyphicon glyphicon-ok form-control-feedback"; 
		return true; 
	}
}

function checkForm() { 

	var valid = true; 
 
	var emailInput = document.getElementById("emailInput"); 
	var informationInput = document.getElementById("informationInput"); 
	var paymantAmountInput = document.getElementById("paymantAmountInput"); 

	if(!firstNameValidate()) valid = false;  
	if(!lastNameValidate()) valid = false; 
	if(!emailValidate()) valid = false; 
	if(!informationValidate()) valid = false; 
	if(!paymentValidate()) valid = false; 

	//alert(valid); 
	return valid; 
}

function validEmailAddress(email) { 
	
	// this regular expression could be better 
	var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/; 
	return pattern.test(email); 
}

function validPaymantAmount(amount) { 

	if(amount < 0) { 
		return false; 
	}

	return true; 
}