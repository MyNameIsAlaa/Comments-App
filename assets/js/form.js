$(document).ready(function() {
    
    $('#comment_form').submit(function(event){

        if($('#form_name').val().length <= 3){
           alert('Name must be more than 3 charcters.');
           event.preventDefault();
           return;
        }
        if($('#form_message').val().length <= 5){
           alert('Message must be more than 5 charcters.');
           event.preventDefault();
           return;
        }
        if(! isValidEmailAddress($('#form_email').val())){
            alert('Email is not valid');
            event.preventDefault();
            return;
        }

        $('comment_form').submit();
        
    });
})

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
}