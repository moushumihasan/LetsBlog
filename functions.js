function validateFormLogIn(){
	  var email=document.getElementById("email").value;
	  var password=document.getElementById("password").value;
	  
	  var validate = true;
	  
	  if(email=="" ) {
		  document.getElementById('errEmail').style.display="block";
		  validate = false;
	  } else if(!isValidEmail(email)) {
		  document.getElementById('errEmail').style.display="block";
		  validate = false;		  
	  } else {
		  document.getElementById('errEmail').style.display="none";
	  } 
	      
	  if(password=="" ){        
		  document.getElementById('errPassword').style.display="block";
		  validate = false;
	  } else {
	      document.getElementById('errPassword').style.display="none";
	  }
	      
	  return validate;
  
}
function hideErrorsLogIn(){
      document.getElementById('errEmail').style.display="none";
      document.getElementById('errPassword').style.display="none";
}


function validateFormReg(){
    
    var firstName=document.getElementById("firstName").value;
    var surname=document.getElementById("surname").value;
    var emailAddress=document.getElementById("emailAddress").value;
    var passwordReg=document.getElementById("passwordReg").value;
    
    var validate = true;
    
    if(firstName=="" ) {
        document.getElementById('errFirstName').style.display="block";
        validate = false;
    } else {
        document.getElementById('errFirstName').style.display="none";
    }

    if(surname=="" ) {
        document.getElementById('errSurname').style.display="block";
        validate = false;
    } else {
        document.getElementById('errSurname').style.display="none";
    }
    
    if(emailAddress=="" ) {
        document.getElementById('errEmailAddress').style.display="block";
        validate = false;
	} else if(!isValidEmail(emailAddress)) {
		  document.getElementById('errEmail').style.display="block";
		  validate = false;		  
	 }else {
        document.getElementById('errEmailAddress').style.display="none";  
	}
    
    if(passwordReg=="" ) {
        document.getElementById('errPasswordReg').style.display="block";
        validate = false;
	} else {
        document.getElementById('errPasswordReg').style.display="none";  
	}
    
    return validate;
}


function hideErrorsReg(){
    document.getElementById('errFirstName').style.display="none";
    document.getElementById('errSurname').style.display="none";
    document.getElementById('errEmailAddress').style.display="none";
    document.getElementById('errPasswordReg').style.display="none";
}  

function isValidEmail(email){
	var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;  
	return emailPattern.test(email);  
}

function validateStatusPost() {
	var status = document.getElementById("add_blog").value;
    
	var validate = true;
    
    if(status=="" ) {
        document.getElementById('errAddBlog').style.display="block";
        validate = false;
    } else {
        document.getElementById('errAddBlog').style.display="none";
    }
	
    return validate;
}

function hideErrorsAddBlog(){
    document.getElementById('errAddBlog').style.display="none";
} 

function charLimit(maxLength, strVal, char_left_id){	
	var maxLength = maxLength;
	document.getElementById(char_left_id).innerHTML = maxLength-strVal.length;
}


