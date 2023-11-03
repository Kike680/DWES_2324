<?php 
require_once 'modelos/ConnexionDB.php';
require_once 'modelos/Mensaje.php';
require_once 'modelos/MensajesDAO.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {

   
//Limpiamos los datos que vienen del usuario
$titulo= htmlspecialchars($_POST['titulo']);
$texto = htmlspecialchars($_POST['texto']);
//Validamos los datos
if (empty($titulo) || empty($texto)) {
    $error = "Los dos campos son obligatorios";
}else {
    //Creamos la conexion utilizando la clase que hemos creado

    $conexionDB = new ConnexionDB('root','', 'localhost', 'blog');
    $conn = $conexionDB->getConnexion();
 
 
    //Creamos el objeto mensajeDAO para acceder a la BBDD a traves de este objeto
    $mensajeDAO = new MensajesDAO($conn);
 
    $mensaje = new Mensaje();
    $mensaje->setTitulo($titulo);
    $mensaje->setTexto($texto);
    $mensaje->setIdUsuario(34);
    $mensajeDAO->insert($mensaje);
    header("Location: index.php");
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insertar_mensaje.php">
        <input type="text" name="titulo" placeholder="Escribe el titulo"><br>
        <textarea name="texto" placeholder="Escribe el mensaje"></textarea><br>
        <input type="submit">
    </form>
</body>
</html>