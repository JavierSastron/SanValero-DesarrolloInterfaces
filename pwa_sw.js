/* SERVICE WORKER */
/* Crear cache de archivos */
const NOMBRE_CACHE = 'cache_principal'
var urls = ['css/index.css',
            'iconos-pwa/72.png',
            'offline.html',
            'imagenes/Logo.png']
/* Cargar cache al registrar el SW */
self.addEventListener('install', function(event){
    // Espera hasta que termina la instalación
    event.waitUntil(
        caches.open(NOMBRE_CACHE).then(function(cache) {
            console.log('Cache abierta')
            return cache.addAll(urls);
        })
    )
})
//proxy para interceptar las peticiones y devovler desde la cache
self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function (response) {
            if (response) {
                console.log('Cargando desde cache:' + event.request.url)
                return response;
            }
            return fetch(event.request)
        }).catch(function(err){
            if(event.request.mode == 'navigate') {
                return cache.match('./offline.html')
            }
        })
    )
})


/**
 * 18/01/2023
 * Actualizaciones:
 * -Linea 23 (event.request.url)
 * -Linea 7 (Era una ruta incompleta)
 */