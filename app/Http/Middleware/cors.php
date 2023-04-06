<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET'); // Le estamos dando los metodos disponibles desde el otro dominio
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application', 'ip');
        return $response;
    }
}

// Debemos resgitrar el middleware en Kernel.php

// Dicho Middleware nos permite que otro dominio 
// pueda coger datos por seguridad los navegadores lo bloquean
// En mi caso no la usare pero lo almacenare para futuras similitudes

// En el ejemplo que mencionas, parece que estás intentando 
// hacer una solicitud desde el dominio "http://127.0.0.1:5500" 
// a un servidor que está alojado en el dominio "http://sistemagestiontareas.test".
// Para solucionar este problema, debes agregar el encabezado "Access-Control-Allow-Origin" 
// en el servidor que está alojando los datos.

// Intercambio de recursos de origen cruzado (CORS)

// El intercambio de recursos de origen cruzado ( CORS ) 
// es un mecanismo basado en el encabezado HTTP que permite 
// que un servidor indique cualquier origen (dominio, esquema o puerto) 
// que no sea el suyo propio desde el cual un navegador debería permitir
// la carga de recursos.

/**
 * 
 *  Este es un mensaje de error común que se produce cuando intentas hacer una solicitud HTTP
 *  desde un dominio diferente al dominio del servidor que está sirviendo los datos.
 *  CORS significa "Cross-Origin Resource Sharing" y es un mecanismo de seguridad
 *  en los navegadores web que impide que el código JavaScript realice solicitudes HTTP
 *  a un servidor que está en un dominio diferente al dominio de origen de la página.
 *  La solución más común para este problema es habilitar el encabezado "Access-Control-Allow-Origin" 
 *  en el servidor que está sirviendo los datos. Este encabezado debe incluir el dominio del cliente 
 *  que está realizando la solicitud HTTP.
 */
