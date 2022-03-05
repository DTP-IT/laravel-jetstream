function validate(value, reGex, field, error)
{
    if ('' == value) {
        $(error).html('Please enter your '+ field);

        return false;
    } else if (!reGex.test(value)) {
        $(error).html('Please enter the correct format!');
        
        return false;
    } else {
        $(error).html(''); 
    }
}
function required(value, error, message) {
    if ('' == value) {
        $(error).html(message);

        return false;
    } else {
        return true;
    }
}
function reGex(value, reGex, error, message) {
    if (!reGex.test(value)) {
        $(error).html(message);
        
        return false;
    } else {
        $(error).html(''); 
        return true;
    }
}
$('#frmAddUSer').on('submit', function() 
{
    var name = $('#name').val();
    var mail = $('#email').val();
    var passwd = $('#password').val();
    var confirmPasswd = $('#confirmPassword').val();
    var level = $('#level').val();
    var reGexName = /[a-zA-Z]{6,200}/;
    var reGexMail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/;
    var reGexPassword = /[a-zA-Z0-9]{6,100}/;

    validate(name, reGexName, 'name', '#errorName');
    validate(mail, reGexMail, 'mail', '#errorEmail');
    validate(password, reGexPassword, 'password', '#errorPasswd');

    if (required(confirmPasswd,'errorConfirmPassword','Please enter your confirm password!' )) {
        if (confirmPasswd != passwd) {
            $('#errorConfirmPassword').html('Password does not match!');
    
            return false;
        } else {
            $('#errorConfirmPassword').html(''); 
        }
    }
    
    if (level == '') {
        $('#errorLevel').html('Please select level');

        return false;
    } else if (level != 'Admin' && level != 'User') {
        $('#errorLevel').html('Please choose the right level!');

        return false;
    } else {
        $('#errorLevel').html('');
    }

    return true;
});

$('#frmAddCategory').on('submit', function() 
{
    var name = $('#name').val();
    var reGexName = /[^/d]{6,200}/;

    validate(name, reGexName, name, '#errorName');

    return true;
});

$('#frmAddBook').on('submit', function() 
{
    var title = $('#title').val();
    var publisher = $('#publisher').val();
    var category = $('#category').val();
    var quantity = $('#quantity').val();
    var price = $('#price').val();
    var reGexTitle = /^[@#%^*()+\=\[\]{};:"\\|.<>\/]*$/;
    var reGexPublisher = /[a-zA-Z0-9]{6,200}/;
    var reGexNumber = /[0-9]/;

    if (title != '' && reGexTitle.test(title)) {
        $('#errorTitle').html('Do not enter special characters: @#%^*()+\=\[\]{};:"\\|.<>\/');
            
        return false;
    } else {
        $('#errorTitle').html(''); 
    }

    if (publisher != '' && !reGexPublisher.test(publisher)) {
        $('#errorPublisher').html('Please enter the correct format!');

        return false;
    } else {
        $('#errorPublisher').html(''); 
    }

    if (category == '') {
        $('#errorCategory').html('Please enter a category!');

        return false;
    } else if (!reGexNumber.test(category)) {
        $('#errorCategory').html('Please enter the correct format!');

        return false;
    } else {
        $('#errorCategory').html(''); 
    }
    if (quantity != '' && !reGexNumber.test(quantity)) {
        $('#errorQuantity').html('Please enter the correct format!');

        return false;
    } else {
        $('#errorQuantity').html(''); 
    }
    
    if (price != '' && !reGexNumber.test(price)) {
        $('#errorPrice').html('Please enter the correct format!');

        return false;
    } else {
        $('#errorPrice').html('');
    }

    return true;
});

