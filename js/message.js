// Name Section Start
var nameInput = document.getElementById("name");
var nameErrPrint = document.getElementById("name_err");
var validName = "";

nameInput.addEventListener("keyup",function(){
    return nameValidation(nameInput,"Please Enter Your Name.","Speacial Character & Number Not Allow.","Name Contains Maximum 30 Characters.",nameErrPrint);
})
nameInput.addEventListener("paste",function(){
    return nameValidation(nameInput,"Please Enter Your Name.","Speacial Character & Number Not Allow.","Name Contains Maximum 30 Characters.",nameErrPrint);
})
// -------------------------------------------------------------


// Email Section Start
var emailInput = document.getElementById("msg_email");
var emailErrPrint = document.getElementById("msg_email_err");
var validEmail = "";

emailInput.addEventListener("keyup",function(){
    return msgEmailValidation(emailInput,"Please Enter Your Email.","Your Email Address is not Valid.",emailErrPrint);
})
emailInput.addEventListener("paste",function(){
    return msgEmailValidation(emailInput,"Please Enter Your Email.","Your Email Address is not Valid.",emailErrPrint);
})
// -------------------------------------------------------------------------------------


// Subject Section Start
var subjectInput = document.getElementById("subject");
var subjectErrPrint = document.getElementById("subject_err");
var validSubject = 1;
var subjectValue = "";

subjectInput.addEventListener("keyup",function(){
    subjectValue = subjectInput.value;

    if(subjectValue == ""){
        subjectInput.classList.remove("is-invalid");
        subjectErrPrint.innerHTML = "";
        validSubject = 1;
    }else if(subjectValue.length > 0){
        if(checkNumChar(subjectValue) != null){
            subjectInput.classList.add("is-invalid");
            subjectErrPrint.innerHTML = "Please Enter Valid Subject.";
            validSubject = 0;
        }else if(subjectValue.length > 50){
            subjectInput.classList.add("is-invalid");
            subjectErrPrint.innerHTML = "Subject Contains Maximum 50 Characters.";
            validSubject = 0;
        }else{
            subjectInput.classList.remove("is-invalid");
            subjectErrPrint.innerHTML = "";
            subjectInput.classList.add("is-valid");

            validSubject = 1; // Recevice Valid Subject
        }
    }
})

subjectInput.addEventListener("paste",function(){
    subjectValue = subjectInput.value;

    if(subjectValue == ""){
        subjectInput.classList.remove("is-invalid");
        subjectErrPrint.innerHTML = "";
        validSubject = 1;
    }else if(subjectValue.length > 0){
        if(checkNumChar(subjectValue) != null){
            subjectInput.classList.add("is-invalid");
            subjectErrPrint.innerHTML = "Please Enter Valid Subject.";
            validSubject = 0;
        }else if(subjectValue.length > 50){
            subjectInput.classList.add("is-invalid");
            subjectErrPrint.innerHTML = "Subject Contains Maximum 50 Characters.";
            validSubject = 0;
        }else{
            subjectInput.classList.remove("is-invalid");
            subjectErrPrint.innerHTML = "";
            subjectInput.classList.add("is-valid");

            validSubject = 1; // Recevice Valid Subject
        }
    }
})
// ------------------------------------------------------------------------------------


// Message Section Start
var messageInput = document.getElementById("message");
var messageErrPrint = document.getElementById("message_err");
var validMessage = "";

messageInput.addEventListener("keyup",function(){
    messageValue = messageInput.value;

    if(messageValue == ""){
        messageInput.classList.add("is-invalid");
        messageErrPrint.innerHTML = "Please Enter Your Message.";
        validMessage = "";
    }else if(messageValue.length > 500){
        messageInput.classList.add("is-invalid");
        messageErrPrint.innerHTML = "Message Contains Maximum 500 Characters.";
        validMessage = "";
    }else{
        messageInput.classList.remove("is-invalid");
        messageErrPrint.innerHTML = "";
        messageInput.classList.add("is-valid");

        validMessage = messageValue; // Receive Valid Message
    }
})

messageInput.addEventListener("paste",function(){
    messageValue = messageInput.value;

    if(messageValue == ""){
        messageInput.classList.add("is-invalid");
        messageErrPrint.innerHTML = "Please Enter Your Message.";
        validMessage = "";
    }else if(messageValue.length > 500){
        messageInput.classList.add("is-invalid");
        messageErrPrint.innerHTML = "Message Contains Maximum 500 Characters.";
        validMessage = "";
    }else{
        messageInput.classList.remove("is-invalid");
        messageErrPrint.innerHTML = "";
        messageInput.classList.add("is-valid");

        validMessage = messageValue; // Receive Valid Message
    }
})
// ---------------------------------------------------------------------------------


// Form Submit 
var messageForm = document.getElementById("messageForm");
var formInputs = messageForm.querySelectorAll(".input");

messageForm.addEventListener("submit",function(e){
    e.preventDefault();

    // Name input is empty or not
    if(nameInput.value == ""){
        nameInput.classList.add("is-invalid");
        nameErrPrint.innerHTML = "Please Enter Your Name";
    }

    // Email input is empty or not
    if(emailInput.value == ""){
        emailInput.classList.add("is-invalid");
        emailErrPrint.innerHTML = "Please Enter Your Email Address.";
    }

    // Message Input is Empty or Not
    if(messageInput.value == ""){
        messageInput.classList.add("is-invalid");
        messageErrPrint.innerHTML = "Please Enter Your Message.";
    }


    // Check All Require Field is Complete or Not
    if(validName && validEmail && validMessage && validSubject == 1){
        
        messageXhr = new XMLHttpRequest();
        messageXhr.open("POST","/check-message",true);
        messageXhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        messageXhr.send("name=" + validName + "&email=" + validEmail + "&subject=" + subjectValue + "&message=" + validMessage);

        messageXhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == "success"){
                    formInputs.forEach(function(singleInput){
                        singleInput.classList.remove("is-valid");
                        singleInput.value = "";
                    })
                    validName = "";
                    validEmail = "";
                    validSubject = 0;
                    subjectValue = "";
                    validMessage = "";
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })
                      
                      Toast.fire({
                        icon: 'success',
                        title: 'Successfully Send Message!'
                    })
                }else{
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'center',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                          toast.addEventListener('mouseenter', Swal.stopTimer)
                          toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                      })
                      
                      Toast.fire({
                        icon: 'error',
                        title: 'Faild! Please Try Again.'
                    })
                }
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

// Function For Matching Speacial Characters
function checkSpeacialChar(name){
    let re = /[!@#$%^&*()_+-=]/;
    return name.match(re); 
}
// Name Validation Related Code End ################ -----------------------------------------------------------------



// Email Validation Related Function Start #################
/* 
    msgEmailValidation(
        Form Input Field Email,
        Email Field Empty Error Message,
        Email Nov Valide Error Message,
        Email Error Output HTML Element
    )
*/

function msgEmailValidation(email,emptyErr,notValidErr,errPrintElement){
    var emailValue = email.value;

    if(emailValue == ''){
        email.classList.add('is-invalid');
        errPrintElement.innerHTML = emptyErr;
        validEmail = "";
    }else if(!validateEmail(emailValue)){
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

// Function For Checking Valid Email
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
// Email Validation Related Function End ################# --------------------------------------------------------



// Function For Making Username Characters Validation
function checkNumChar(username){
    let re = /[!@#$%^&*()_ +-]/;
    return username.match(re);
}

