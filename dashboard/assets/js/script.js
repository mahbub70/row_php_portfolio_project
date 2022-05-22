
// SINGN UP FORM JAVASCRIPT START

// Get Sign Up Form
var validName = "";
var validUsername = "";
var validEmail = "";
var validPassword = "";
var validConfirmPassword = "";
var chackboxStatus = "";

var signUpForm = document.getElementById("singUpForm");
signUpForm.addEventListener("submit",function(e){
    e.preventDefault();

    if(validName && validUsername && validEmail && validPassword && validConfirmPassword && chackboxStatus == 1){
        var formxhr = new XMLHttpRequest();
        formxhr.open("POST","/register",true);
        formxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        formxhr.send("name=" + validName + "&username=" + validUsername + "&email=" + validEmail + "&password=" + validPassword);
        formxhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == "success"){
                    Swal.fire(
                        `Hi ${validName}, Registration Success`,
                        'Redirecting to Login Page...',
                        'success'
                    )
                    const redirect = setTimeout(function(){
                        location.href = "/login";
                    },3000)
                }else{
                    Swal.fire(
                        `Faild!`,
                        'Please Try Again',
                        'error'
                    )
                }
                // console.log(this.responseText);
            }else if(this.status == 404){
                location.href = "/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }else{
                location.href="/500-server-error";
            }
        }
    }
})


// Name Validation Start
var fullName = document.getElementById("fullName");
var nameErr = document.getElementById("name_err");

fullName.addEventListener('keyup',function(){
    return nameValidation(fullName,"Please Enter Your Name","Speacial Characters Not Allow.","Name Maximum Contains 30 Characters.",nameErr);
});
fullName.addEventListener('paste',function(){
    // console.log("paste");
    return nameValidation(fullName,"Please Enter Your Name","Speacial Characters Not Allow.","Name Maximum Contains 30 Characters.",nameErr);
});
// Name Validation End----------------------------------------------------------

// User Name validation Start
var userName = document.getElementById("userName");
var userNameErr = document.getElementById("user_name_err");
userName.addEventListener("keyup",function(){
    return usernameValidation(userName,"Please Enter Your User Name","User Name is Not Vlaid. Alow Only Characters & Number","User Name Cotains Maximum 20 Characters.","User Name Already Exist.",userNameErr)
});
userName.addEventListener("paste",function(){
    // console.log("paste");
    return usernameValidation(userName,"Please Enter Your User Name","User Name is Not Vlaid. Alow Only Characters & Number","User Name Cotains Maximum 20 Characters.","User Name Already Exist.",userNameErr)
});
// User Name validation End------------------------------------------------------------

// Email Validation Start
var userEmail = document.getElementById("email");
var emailErr = document.getElementById('email_err');
userEmail.addEventListener("keyup",function(){
    return emailValidation(userEmail,"Please Enter Your Email Address.","Your Email is Not Valid. Please Enter a Valid Email Address.","This Email is Already Exist.",emailErr);
});
userEmail.addEventListener("paste",function(){
    return emailValidation(userEmail,"Please Enter Your Email Address.","Your Email is Not Valid. Please Enter a Valid Email Address.","This Email is Already Exist.",emailErr);
});
// Email Validation End--------------------------------------------------------------------


// Password Validation Start
var password = document.getElementById("password");
var passwordErr = document.getElementById("password_err");
password.addEventListener("keyup",function(){
    return passwordValidation(password,"Please Enter Your Password.","Password is Not Valid. Password Must Have 1 Uppercase, 1 Lowercase, 1 Number, 1 Speacial Character & Minimum 8 Characters",passwordErr);
});
password.addEventListener("paste",function(){
    return passwordValidation(password,"Please Enter Your Password.","Password is Not Valid. Password Must Have 1 Uppercase, 1 Lowercase, 1 Number, 1 Speacial Character & Minimum 8 Characters",passwordErr);
});
// Password Validation End-----------------------------------------------------------------


// Confirm Password Validation Start
var confirmPass = document.getElementById("confirmPassword");
var confirmPassErr = document.getElementById("confirmPass_err");

confirmPass.addEventListener("keyup",function(){
    var confirmPassValue = confirmPass.value;

    if(validPassword.length > 0){
        
        if(confirmPassValue == ''){
            confirmPass.classList.add('is-invalid');
            confirmPassErr.innerHTML = "Please Enter Your Confirm Password.";
            validConfirmPassword = "";
        }else if(validPassword != confirmPassValue){
            confirmPass.classList.add('is-invalid');
            confirmPassErr.innerHTML = "Confirm Password did Not Match.";
            validConfirmPassword = "";
        }else if(confirmPassValue == validPassword){
            confirmPass.classList.remove('is-invalid');
            confirmPassErr.innerHTML = "";
            confirmPass.classList.add('is-valid');

            validConfirmPassword = confirmPassValue; //Receiving Valid Confirm Password
        }
        
    }else{
        password.classList.add("is-invalid");
        passwordErr.innerHTML = "Please Fill Password First.";
        validConfirmPassword = "";
    }
    // console.log(validPassword);
});
// Confirm Password Validation End---------------------------------------------------------------------



// Agree Checkbox Validation Start
var checkbox = document.getElementById('checkbox');
var checkboxErr = document.getElementById('checkbox_err');
checkbox.addEventListener("change",function(){
    if(checkbox.checked){
        chackboxStatus = 1;
    }else{
        chackboxStatus = 0;
    }
})

// SINGN UP FORM JAVASCRIPT END ---------------------------------------------------------------------------

// READY FUNCTION FOR USE BELLOW------------------------------------------------------------------------------------------------------------


// Name Validation Related Code Strat ################
/*// 
    nameValidation(
        Form Input Field, 
        Name Field Empty Error, 
        Name Speacial Characters Error, 
        Name Maximum Characters Error
    )
*/
function nameValidation(name,emptyErr,speacialCharErr,maxCharErr,errPrintElement){
    var nameValue = name.value;
    if(nameValue == ''){
        errPrintElement.innerHTML = emptyErr;
        name.classList.add('is-invalid');
        validName = "";
    }else if(checkSpeacialChar(nameValue) != null){
        errPrintElement.innerHTML = speacialCharErr;
        name.classList.add('is-invalid');
        validName = "";
    }else if(nameValue.length > 30){
        errPrintElement.innerHTML = maxCharErr;
        name.classList.add('is-invalid');
        validName = "";
    }else{
        errPrintElement.innerHTML = "";
        name.classList.remove('is-invalid');
        name.classList.add('is-valid');

        validName = nameValue; // Receive Valid Full Name

        
    }
}

// Name Validation Related Code End ################ -----------------------------------------------------------------




// User Name Validation Related Function Start #################
/*// 
    usernameValidation(
        Form Input Field User Name, 
        User Name Empty Message, 
        User Name Non Valid Error Message, 
        User Name Characters Limit Error, 
        Databse User Name Exiting Error, 
        Error Output HTML Element
    )
*/
function usernameValidation(username,emptyErr,validErr,maxUserNameErr,existErr,errPrintElement){
    var userNameValue = username.value;
    if(userNameValue == ''){
        username.classList.add('is-invalid');
        errPrintElement.innerHTML = emptyErr;
        validUsername = "";
    }else if(userNameValue.length > 0){
        var xhr = new XMLHttpRequest();
        xhr.open("POST","/username-check",true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("user_name=" + userNameValue);

        xhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == 1){
                    username.classList.add('is-invalid');
                    errPrintElement.innerHTML = existErr;
                    validUsername = "";
                }else{
                    if(checkNumChar(userNameValue) != null){
                        username.classList.add('is-invalid');
                        errPrintElement.innerHTML = validErr;
                        validUsername = "";
                    }else if(userNameValue.length > 20){
                        username.classList.add('is-invalid');
                        errPrintElement.innerHTML = maxUserNameErr;
                        validUsername = "";
                    }
                    else{
                        username.classList.remove('is-invalid');
                        errPrintElement.innerHTML = "";
                        username.classList.add('is-valid');
                        validUsername = userNameValue; // Receive Valid User Name

                        // console.log(validUsername);
                    } 
                }
            }else if(this.status == 404){
                location.href = "/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }
    }

}
// User Name Validation Related Function End ################# -----------------------------------------------------------


// Email Validation Related Function Start #################
/* 
    emailValidation(
        Form Input Field Email,
        Email Field Empty Error Message,
        Email Nov Valide Error Message,
        Database Email Exixting Error,
        Email Error Output HTML Element
    )
*/

function emailValidation(email,emptyErr,notValidErr,emailExistErr,errPrintElement){
    var emailValue = email.value;

    if(emailValue == ''){
        email.classList.add('is-invalid');
        errPrintElement.innerHTML = emptyErr;
        validEmail = "";
    }else if(emailValue.length > 0){
        var emailxhr = new XMLHttpRequest();
        emailxhr.open("POST","/email-check",true);
        emailxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        emailxhr.send("email=" + emailValue);

        emailxhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == 1){
                    email.classList.add('is-invalid');
                    errPrintElement.innerHTML = emailExistErr;
                    validEmail = "";
                }else{
                    if(!validateEmail(emailValue)){
                        email.classList.add('is-invalid');
                        errPrintElement.innerHTML = notValidErr;
                        validEmail = "";
                    }else{
                        email.classList.remove('is-invalid');
                        email.classList.add('is-valid');
                        errPrintElement.innerHTML = "";

                        validEmail = emailValue // Receiving Valid Email Address.
                    }   
                }
            }else if(this.status == 404){
                location.href="/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }
    }
    
}

// Email Validation Related Function End ################# --------------------------------------------------------



// Password Validation Related Function Start #################
/*
    passwordValidation(
        Form Input Field Password,
        Password Empty Message,
        Password Not Valid Message,
        Password Error Output HTML Element
    )
*/

function passwordValidation(password,emptyErr,notValidErr,errPrintElement){
    var passwordValue = password.value;

    if(passwordValue == ''){
        password.classList.add('is-invalid');
        errPrintElement.innerHTML = emptyErr;
        validPassword = "";
    }else if(!checkPassword(passwordValue)){
        password.classList.add('is-invalid');
        errPrintElement.innerHTML = notValidErr;
        validPassword = "";
    }else{
        password.classList.remove('is-invalid');
        errPrintElement.innerHTML = "";
        password.classList.add('is-valid');

        validPassword = passwordValue; // Receiving Valid Password
    }
}

// Password Validation Related Function End ################# -----------------------------


// Function For Making Username Characters Validation
function checkNumChar(username){
    let re = /[!@#$%^&*()_ +-]/;
    return username.match(re);
}

// Function For Matching Speacial Characters
function checkSpeacialChar(name){
    let re = /[!@#$%^&*()_+-=]/;
    return name.match(re); 
}

// Function For Checking Valid Email
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Function For Checking Valid Password
function checkPassword(pass){
    var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
    return re.test(pass);
}





