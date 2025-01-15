$(document).ready(function (){
    $('#myForm').validate({
        rules: {
            login: {
                required : true,
            }, 
            password: {
                required : true,
            }
            
        },
        messages :{
            login: {
                required : 'Please Enter Email Or Phone Or Username',
            }, 
            password: {
                required : 'Please Enter Validate Password',
            }, 
             

        },
        errorElement : 'span', 
        errorPlacement: function (error,element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight : function(element, errorClass, validClass){
            $(element).addClass('is-invalid');
        },
        unhighlight : function(element, errorClass, validClass){
            $(element).removeClass('is-invalid');
        },
    });
});




document.querySelector('form').addEventListener('submit', function(event) {
    const emailPhoneUsername = document.getElementById('login').value;
    const password = document.getElementById('password').value;

    // Validate email/phone/username format
    if (!isValidEmail(emailPhoneUsername) && !isValidPhone(emailPhoneUsername) && !isValidUsername(emailPhoneUsername)) {
        alert('Please enter a valid email, phone number, or username.');
        event.preventDefault();
    }

    // Additional password validation if needed

});

function isValidEmail(email) {
    // Regular expression for email validation
    // You can use a more complex regex for more stringent validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    // Regular expression for phone number validation
    // You can use a more complex regex depending on the format you want to accept
    const phoneRegex = /^[0-9]{10}$/; // Assumes a 10-digit phone number
    return phoneRegex.test(phone);
}

function isValidUsername(username) {
    // Additional validation for username if needed
    return true; // Replace with your validation logic
}
