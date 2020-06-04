/**
 * Implmentacion de un servidor REST , nodejs.
 * 
 */

const express = require( 'express' );
const bodyParser = require( 'body-parser' );
const app = express();

app.use( bodyParser.urlencoded( {extended: true } ) );
app.use( bodyParser.json() );

let usuario = { 
    nombre: '',
    apellido: ''
}

let respuesta = {
    error: false,
    codigo: 200,
    mensaje: ''
}

// get default
app.get( '/', ( req,res )  => {
    respuesta = {
        error: true,
        codigo: 200,
        mensaje: 'punto de inicio'
    }
    res.send( respuesta );
});

// Router GET, POST, PUY, DELETE
app.route( '/usuario' )
    .get( (req,res ) => { // get usuario: recupera los datos del usuario
        respuesta = {
            error: false,
            codigo: 200,
            mensaje: ''
        }
        if (usuario.nombre == '' || usuario.apellido == '') {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'El usuario no ha sido creado'
            };
        }
        else {
            respuesta = {
                error: false,
                codigo: 200,
                mensaje: 'respuesta del usuario',
                respuesta: usuario
            };
        }
        res.send( respuesta );
    })
    .post( ( req,res ) => { // post usuario: agrega los datos al usuario
        if (!req.body.nombre || !req.body.apellido) {
            respuesta = {
                error: true,
                codigo: 502,
                mensaje: 'El campo nombre y apellido son requeridos'
            };
        }
        else {
            if (usuario.nombre != '' || usuario.apellido != '') {
                respuesta = {
                    error: true,
                    codigo: 503,
                    mensaje: 'El usuario ya fue creado previamente'
                };
            }
            else {
                usuario = {
                    nombre: req.body.nombre,
                    apellido: req.body.apellido
                };
                respuesta = {
                    error: false,
                    codigo: 200,
                    mensaje: 'Usuario creado',
                    respuesta: usuario
                };
            }
        }
        res.send( respuesta );
    })
    .put( (req,res) => {// put usuario: modifica datos del usuario 
        if (!req.body.nombre || !req.body.apellido) {
            respuesta = {
                error: true,
                codigo: 502,
                mensaje: 'El campo nombre y apellido son requeridos'
            };
        }
        else {
            if (usuario.nombre === '' || usuario.apellido === '') {
                respuesta = {
                    error: true,
                    codigo:  501,
                    mensaje: 'El usuario no ha sido creado'
                };
            }
            else {
                usuario = {
                    nombre: req.body.nombre,
                    apellido: req.body.apellido
                };
                respuesta = {
                    error: false,
                    codigo: 200,
                    mensaje: 'Usuario actualizado',
                    respuesta: usuario
                };
            }
        }
        res.send( respuesta );
    })
    .delete( (req,res) => { // delete usuario: elimina los datos del usuario.
        if (usuario.nombre === '' || usuario.apellido === '') {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'El usuario no ha sido creado'
            };
        }
        else if (req.body.nombre != usuario.nombre || req.body.apellido != usuario.apellido) {
            respuesta = {
                error: true,
                codigo: 501,
                mensaje: 'Los datos no coinciden con el usuario creado'
            };
        }
        else {
            usuario = {
                nombre: '',
                apellido: ''
            };
            respuesta = {
                error: false,
                codigo: 200,
                mensaje: 'Usuario eliminado',
                respuesta: usuario
            };
        }
        res.send( respuesta );
    });

app.use( function( req,res,next ) {
    respuesta = {
        error: true,
        codigo: 404,
        mensaje: 'URL no encontrada'
    };
    res.status( 404 ).send( respuesta );
});

// servidor escucha en el puerto 3000.
PORT = 3000;
app.listen( PORT, () => {
    console.log( "Servidor NodeJS http://localhost:" + PORT );
});