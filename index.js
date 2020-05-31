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

app.get( '/', ( req,res )  => {
    respuesta = {
        error: true,
        codigo: 200,
        mensaje: 'punto de inicio'
    }
    res.send( respuesta );
});

app.get( '/usuario', (req,res ) => {
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
});

app.post( '/usuario', ( req,res ) => {
    if (!req.body.nombre || !req.body.apellido) {
        respues = {
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
});

app.put( '/usuario', (req,res) => {
    if (!req.body.nombre || !req.body.apellido) {
        respuesta = {
            error: true,
            codigo: 502,
            mensaje: 'El campo nombre y apellido son requeridos'
        };
    }
    else {
        if (usuario.nombre === '' || apellido === '') {
            respuesta = {
                error: true,
                codigo:  501,
                mensaje: 'El usuario ha sido creado'
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
});

app.delete( '/usuario', (req,res) => {
    if (usuario.nombre === '' || usuario.apellido === '') {
        respuesta = {
            error: true,
            codigo: 501,
            mensaje: 'El usuario ha sido creado'
        };
    }
    else {
        respuesta = {
            error: false,
            codigo: 200,
            mensaje: 'Usuario eliminado'
        };
        usuario = {
            nombre: '',
            apellido: ''
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

app.listen( 3000, () => {
    console.log( "El servidor esta inicializando en el puerto 3000" );
});