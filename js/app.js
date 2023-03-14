function getView(controller, method, bonus) {
    var parameters='&controller='+controller+'&method='+method;
    if(bonus!=undefined && bonus!='') {
        parameters+='&' + bonus;
    }
    $.ajax({
        url: 'C_Ajax.php',
        type: 'POST',
        data: parameters,
        success: function(view) {
            $('#capaContenido').html(view);
        }
    })

}