<?php

class MensajesDAO {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getById($id):Mensaje {
       // if(!$result = $this->conn->query("SELECT * FROM mensajes WHERE id = $id"))
       if(!$stmt =  $this->conn->prepare("SELECT * FROM mensajes WHERE id = $id")){
       
            echo "Error en la SQL: " . $this->conn->error;
        }
       /*  if($result->num_rows == 1){
            $mensaje = $result->fetch_object(Mensaje::class);
            return $mensaje;
        }
        else{
            return null;
        }
 */

    //Asociar las variables a las interrogaciones (parametros)
    $stmt->bind_param('i', $id);
    //Ejecutamos la SQL
    $stmt->execute();
    //Obtener el objeteo mysql_result
    $result = $stmt->get_result();

    //Si ha encontrado algun resultado devolvemos un objeto de la clase Mensaje, sino null
    if($result->num_rows == 1){
        $mensaje = $result->fetch_object(Mensaje::class);
    }
    }
    public function getAll():array {
        if(!$stmt =  $this->conn->prepare("SELECT * FROM mensajes")){
            echo "Error en la SQL: " . $this->conn->error;
    }
    //Ejecutamos la SQL
    $stmt->execute();
    //Obtener el objeteo mysql_result
    $result = $stmt->get_result();

    $$array_mensajes = array();
// $array_mensajes = array();
//$num_fil a= $result_

    while($mensaje = $result ->fetch_object(Mensaje::class)){
        $array_mensajes[] = $mensaje;
    }
    return $array_mensajes;
    }
}
?>