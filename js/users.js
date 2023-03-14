function search() {
    let parameters='&controller=Users&method=search';
    parameters +='&'+$('#formSearch').serialize();

    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#capaSearchResult').html(view);
        }
    })
}

function saveUser(action) {
    let parameters='&controller=Users&method=executeThenReturn';
    parameters += '&' + action;
    parameters +='&'+$('#formUser').serialize();
    console.log(parameters)
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#capaContenido').html(view);
        }
    })
}

function changeStatus(bonus) {
    var parameters='&controller=Users&method=changeStatus';
    if(bonus!=undefined && bonus!='') {
        parameters+='&' + bonus;
    }
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            search();
        }
    })

}

function validateUser(id_Usuario) {
    $('.inputRed').removeClass('inputRed');
    $('#msj').html('');

    let form = $('#formUser').serializeArray()
    let reglasValidacion = /^[a-z][\w.-]+@\w[\w.-]+\.[\w.-]*[a-z][a-z]$/i;;
    let faltanCampos = false;
    let correoValido = true;

    form.forEach(function(value, index){
        if (value['value'] == '') {
            actualClass = '#' + value['name'];
            $(actualClass).addClass('inputRed');
            $('#msj').html('Faltan campos por rellenar');
            faltanCampos = true;
        }

        if (value['name'] == 'fMail') {
            if (!reglasValidacion.test(value['value'])) {
                actualClass = '#' + value['name'];
                $(actualClass).addClass('inputRed');
                $('#msj').html('El correo electrónico no es válido');
                correoValido = false;
            }
        }
    });


    if(!faltanCampos && correoValido) {
        validateUserDB(id_Usuario);
    }
    
}

function validateUserDB(id_Usuario) {
    let parameters='&controller=Users&method=checkLogin';
    parameters +='&login='+$('#fLogin').val()+id_Usuario;
    console.log(parameters)
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(existUser) {
            if (existUser == 'true') {
                $('#repeatedUser').html('El nombre de usuario ya existe');
                $('#fLogin').addClass('inputRed');
            } else {
                saveUser(id_Usuario);
            }
        }
    })
}