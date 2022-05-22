
var subscriberEmail = document.getElementById("email");
var sEmailerrPrint = document.getElementById("email_err");
var validEmail = '';

subscriberEmail.addEventListener("keyup",function(){
    return emailValidation(subscriberEmail,"Please Enter Your Email Address.","Your Email is Not Valid. Please Enter a Valid Email Address.","This Email is Already Exist.",sEmailerrPrint);
})
subscriberEmail.addEventListener("paste",function(){
    return emailValidation(subscriberEmail,"Please Enter Your Email Address.","Your Email is Not Valid. Please Enter a Valid Email Address.","This Email is Already Exist.",sEmailerrPrint);
})

// Email Form Submit
var emailForm = document.getElementById("emailSubmit");

emailForm.addEventListener("submit",function(e){
    e.preventDefault();

    if(validEmail){
        var emailInsertxhr = new XMLHttpRequest();
        emailInsertxhr.open("POST","/subscriber-check",true);
        emailInsertxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        emailInsertxhr.send("email=" + validEmail);

        emailInsertxhr.onload = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == 'success'){
                    subscriberEmail.value = '';
                    email.classList.remove('is-valid');
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
                        title: 'Subscription Success.'
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
                location.href="/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }
    }
})

// __________________________________________________________________________________________________________

// Footer Subscriber  Start ####################################
var footerEmailInput = document.getElementById("footerEmail");
var footerValidEmail = "";

footerEmailInput.addEventListener("keyup",function(){
   var footerEmailValue = footerEmailInput.value;

    if(footerEmailValue == ""){
        footerEmailInput.style.border = "2px solid red";
        footerValidEmail = "";
    }else if(footerEmailValue.length > 0){
        var footeremailxhr = new XMLHttpRequest();
        footeremailxhr.open("POST","/subscriber-email-check",true);
        footeremailxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        footeremailxhr.send("email=" + footerEmailValue);

        footeremailxhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == 1){
                    footerEmailInput.style.border = "2px solid red";
                    footerValidEmail = "";
                }else{
                    if(!validateEmail(footerEmailValue)){
                        footerEmailInput.style.border = "2px solid red";
                        footerValidEmail = "";
                    }else{
                        footerEmailInput.style.border = "2px solid green";

                        footerValidEmail = footerEmailValue; // Receiving Valid Email Address.
                    }   
                }
            }else if(this.status == 404){
                location.href="/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }    
    }
})
footerEmailInput.addEventListener("paste",function(){
    var footerEmailValue = footerEmailInput.value;
 
    if(footerEmailValue == ""){
        footerEmailInput.style.border = "2px solid red";
        footerValidEmail = "";
    }else if(footerEmailValue.length > 0){
        var footeremailxhr = new XMLHttpRequest();
        footeremailxhr.open("POST","/subscriber-email-check",true);
        footeremailxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        footeremailxhr.send("email=" + footerEmailValue);

        footeremailxhr.onload = function(){
            if(this.status == 200){
                if(this.responseText == 1){
                    footerEmailInput.style.border = "2px solid red";
                    footerValidEmail = "";
                }else{
                    if(!validateEmail(footerEmailValue)){
                        footerEmailInput.style.border = "2px solid red";
                        footerValidEmail = "";
                    }else{
                        footerEmailInput.style.border = "2px solid green";

                        footerValidEmail = footerEmailValue; // Receiving Valid Email Address.
                    }   
                }
            }else if(this.status == 404){
                location.href="/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }    
    }
})

var footerEmailForm = document.getElementById("FooterEmailSubmit");
footerEmailForm.addEventListener("submit",function(e){
    e.preventDefault();

    if(footerEmailInput.value == ""){
        footerEmailInput.style.border = "2px solid red";
    }

    if(footerValidEmail){
        var footeremailInsertxhr = new XMLHttpRequest();
        footeremailInsertxhr.open("POST","/subscriber-check",true);
        footeremailInsertxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        footeremailInsertxhr.send("email=" + footerValidEmail);

        footeremailInsertxhr.onload = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.responseText == 'success'){
                    footerEmailInput.value = '';
                    footerEmailInput.style.border = "";
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
                        title: 'Subscription Success.'
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
                location.href="/404-not-found";
            }else if(this.status == 403){
                location.href="/403-forbidden";
            }
        }
    }
})
// Footer Subscriber  End ---------------------------------------------------------------------------------

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
        emailxhr.open("POST","/subscriber-email-check",true);
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

// Function For Checking Valid Email
function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}