if ("serviceWorker" in navigator) {
    console.log('Navegador admite pwa')
    if (navigator.serviceWorker.controller) {
        console.log('El serviceworker ya existe, no se vuelve a registrar')
    } else {
        //Registrar el serviciworker
        navigator.serviceWorker.register("pwa_sw.js", {scope: "./"}).then(
            function (reg){
                console.log("SW registrado")
            }).catch(function(err){
                console.log("No se ha podido registrar el SW")
            })
    }
}