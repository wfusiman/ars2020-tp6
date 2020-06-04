<?php
include './header.html';
?>
 <div class="testbox">
        <?php
        if($_GET && isset( $_GET['nuevo'])){
            echo '<form action="./usuarios.php" method="POST">';
            echo '<div>
                    <h1 style="color: black">Crear usuario</h1><br><br>
                  </div>';
            echo '<div class="item">
                    <p>Nombre:</p>
                    <div class="name-item">
                        <input type="text" name="nombre" placeholder="ingrese nombre"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Apellido:</p>
                    <div class="name-item">
                        <input type="text" name="apellido" placeholder="ingrese apellido" />
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="post"/>';
            echo '<div>
                    <button id="btnGuardar">Guardar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else if($_GET && isset( $_GET['modificar'])){
            echo '<form action="./usuarios.php" method="POST">';
            echo '<div>
                    <h1 style="color: black">Modificar datos de usuario</h1><br><br>
                    </div>';
            echo '<div class="item">
                    <p>Nombre:</p>
                    <div class="name-item">
                        <input type="text" name="nombre" placeholder="ingrese nombre"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Apellido:</p>
                    <div class="name-item">
                        <input type="text" name="apellido" placeholder="ingrese apellido" />
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="put"/>';
            echo '<div>
                    <button id="btnGuardar">Actualizar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else if($_GET && isset( $_GET['eliminar'])){
            echo '<form action="./usuarios.php" method="POST">';
            echo '<div >
                    <h1 style="color: black">Borrar usuario</h1> <br><br>
                  </div>';
            echo '<div class="item">
                    <p>Nombre:</p>
                    <div class="name-item">
                        <input type="text" name="nombre" placeholder="ingrese nombre"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Apellido:</p>
                    <div class="name-item">
                        <input type="text" name="apellido" placeholder="ingrese apellido" />
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="del"/>';
            echo '<div>
                    <button id="btnEliminar">Eliminar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else {
            echo '<form>';
            echo '<div>
                        <h4>Conexion Cliente PHP - Servidor NodeJs</h4>
                  </div>';
           echo' <ul>
                    <li><a href="/rest/dashboard/usuarios.php?recuperar">Buscar usuario</a></li>
                    <li><a href="/rest/dashboard/inicio.php?nuevo">Crear nuevo usuario</a></li>
                    <li><a href="/rest/dashboard/inicio.php?modificar">Actualizar datos de usuario</a></li>
                    <li><a href="/rest/dashboard/inicio.php?eliminar">Borrar usuario</a></li>
                </ul>';
            echo '</form>';
        }
        ?>
    </div>
</body>

<?php
include './footer.html'; 
?>