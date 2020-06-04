
<?php 

  include './header.html'; 

?>
<div class="testbox">
    <?PHP
        echo '<form>';
        if ($_GET) {
          echo '<div>
                    <h1 style="color: black">GET usuario</h1><br><br>
                </div>';
          $get_data = callAPI( 'GET','http://localhost:3000/usuario', false );
        }
        else if($_POST && isset( $_POST['nombre'], $_POST['apellido'], $_POST['metodo'])) {
          $nombre = $_POST['nombre'];
          $apellido = $_POST['apellido'];
          $metodo = $_POST['metodo'];

          $data_array =  array(
            "nombre" => $nombre,
            "apellido" => $apellido
            );

          if ($metodo == 'post') {
            echo '<div>
                     <h1 style="color: black">POST usuario</h1><br><br>
                  </div>';
            $get_data = callAPI( 'POST','http://localhost:3000/usuario', json_encode( $data_array ));
          }
          else if ($metodo == 'put') {
            echo '<div>
                      <h1 style="color: black">PUT usuario</h1><br><br>
                  </div>';
            $get_data = callAPI( 'PUT','http://localhost:3000/usuario', json_encode( $data_array ));
          }
          else if ($metodo == 'del') {
            echo '<div>
                     <h1 style="color: black">DELETE usuario</h1><br><br>
                  </div>';
            $get_data = callAPI( 'DEL','http://localhost:3000/usuario', json_encode( $data_array ));
          }
        }
        //serror_log( print_r( 'callAPI : ' . $get_data ));
         $respuesta = json_decode( $get_data, true);
         $error = $respuesta['error'];
         $codigo = $respuesta['codigo'];
         $mensaje = $respuesta['mensaje'];
        echo '<div class="item">';
        echo '<p style="font-size: 20px">Respuesta servidor:</p><br>';
        echo '<div class="name-item" style="font-size: 18px">';
        if ($error) 
           echo '<span>Error codigo: ' . $codigo . '<br>' . $mensaje . '</span>';
        else {
         $resp = $respuesta['respuesta'];
         echo '<span>' . $mensaje . '<br>';
         echo 'nombre: ' . $resp['nombre'] . ', apellido: ' . $resp['apellido'] . '</span>';
        }
            
        echo '</div></div>';
        echo '<div>
                  <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
               </div>';
       
        echo '</form>';
        

        function callAPI($method, $url, $data){
          $curl = curl_init();
          switch ($method){
             case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
             case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);		
                break;
             case "DEL":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
                break;
             default:
                if ($data)
                   $url = sprintf("%s?%s", $url, http_build_query($data));
          }
          // OPTIONS:
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'APIKEY: 111111111111111111111',
             'Content-Type: application/json',
          ));
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          // EXECUTE:
          $result = curl_exec($curl);
          if(!$result){die("Connection Failure");}
          curl_close($curl);
          return $result;
       }
      ?>
          
</div>
</body>

<?php include './footer.html'; ?>

 