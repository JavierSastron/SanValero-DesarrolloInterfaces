function save() {
    $('.inputRed').removeClass('inputRed');
    $('.inputGreen').removeClass('inputGreen');
    $('#msj').html('');
    checkUser();
    checkPass();

    if ($('.inputRed').length > 0) {
        $('#msj').html('Revisa los campos en rojo');
    } else {
        //NO SALTA NINGUN ERROR EN LOS CAMPOS DEL FORM
        $('#formLogin').submit();
    }

}

function checkUser() {
    if($('#user').val()==='' ) {
        $('#user').addClass('inputRed');
    } else {
        $('#user').addClass('inputGreen');
    }
}

function checkPass() {
    if($('#password').val()==='') {
        $('#password').addClass('inputRed');
    } else {
        $('#password').addClass('inputGreen');
    }
}