var stars = document.querySelectorAll(".fa-star");
var rating_err = document.getElementById("rating_err");
var rating = "";
var validRating = "";

stars.forEach(function(singleStar){
    singleStar.addEventListener("click",function(){
        var dataCount = singleStar.getAttribute("data-count");

        stars.forEach(function(item){
            item.classList.remove("checked");
        })

        for(let i = 0; i <= dataCount - 1; i++){
            stars[i].classList.add("checked");
        }
        rating = dataCount;
        rating_err.innerHTML = "";
    })
})


var reviewInput = document.querySelector(".review_input");
var reviewErrPrint = document.getElementById("review_err");
var reviewCharCount = document.getElementById("type_count");
var reviewCountBox = document.querySelector(".count_box");
var validReview = "";

reviewInput.addEventListener("keyup",function(){
    var reviewInputValue = reviewInput.value;
    var reviewInputLength = reviewInputValue.length;
    
    reviewCharCount.innerHTML = reviewInputLength;

    if(reviewInputLength == 0){
        reviewInput.classList.add("is-invalid");
        reviewErrPrint.innerHTML = "Please Enter Your Review.";
    }else if(reviewInputLength > 500){
        reviewInput.classList.add("is-invalid");
        reviewErrPrint.innerHTML = "Review Contains Maximum 500 Characters.";
        reviewCountBox.style.color = "red"; 
    }else{
        reviewInput.classList.remove("is-invalid");
        reviewInput.classList.add("is-valid");
        reviewErrPrint.innerHTML = "";
        reviewCountBox.style.color = "";

        // If Valid
        validReview = reviewInputValue;
    }
})



var ratingForm = document.getElementById("ratingForm");
ratingForm.addEventListener("submit",function(e){
    e.preventDefault();

    // Check Rating Available or Not
    if(rating == ""){
        rating_err.innerHTML = "please Give Rating.";
    }else{
        validRating = rating;
    }


    // Check Review Available or Not
    if(reviewInput.value == ""){
        reviewInput.classList.add("is-invalid");
        reviewErrPrint.innerHTML = "Please Enter Your Review.";
    }


    // Check All Validation is Complete or not
    if(validRating && validReview){
        // console.log("working");

        var newXhr = new XMLHttpRequest();
        newXhr.open("POST","/check-client-review",true);
        newXhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        newXhr.send("rating=" + validRating + "&review=" + validReview);
        
        newXhr.onload = function(){
            if(this.status == 200){

                if(this.responseText == 1){
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
                        title: 'Successfully Send Your Review. Redirecting to all review.'
                    })

                    reviewInput.value = "";
                    reviewInput.classList.remove("is-valid");
                    reviewCharCount.innerHTML = 0;
                    stars.forEach(function(item){
                        item.classList.remove("checked");
                    })
                    // Redirecting To All review Page
                    const redirect = setTimeout(function(){
                        location.href = "/my-reviews";
                    },3000)

                }else if(this.responseText == 0){
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
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



