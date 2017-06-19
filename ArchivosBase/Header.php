<?php
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 16/6/17
 * Time: 18:14
 */

	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
        $_SESSION['idioma'] = 'SPANISH';
        include '../Locates/Strings_' . $_SESSION['idioma'] . '.php';
    }
    else{
        //$_SESSION['idioma'] = 'SPANISH'; // quitar y solucionar el problema de que inicilice el idioma a galego
        include '../Locates/Strings_' . $_SESSION['idioma'] . '.php';
    }
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ejemplo pagina web</title>
    <script type="text/javascript" src="../View/js/tcal.js"></script>
   <!-- <script type="text/javascript" src="../View/js/Validaciones.js"></script> -->
    <!-- <script type="text/javascript" src="../View/js/comprobar.js"></script>-->
    <!-- <link rel="stylesheet" type="text/css" href="../View/css/JulioCSS-2.css" media="screen" />-->
    <link rel="stylesheet" type="text/css" href="../View/css/tcal.css" media="screen" />
</head>
<body>
<header>
    <p style="text-align:center">
    <h1>
        <?php echo $strings['GESTIÓN']; ?>
    </h1>
    </p>


    <div width: 50%; align="right">
        <a href="../Controller/CambioIdioma.php?idioma=SPANISH"><img src="../View/Icons/spanish.png" style="width:20px; height:20px" title="Spanish"></a>
        <a href="../Controller/CambioIdioma.php?idioma=ENGLISH"><img src="../View/Icons/english.png" style="width:20px; height:20px" title="English"></a>


        <?php

        if (IsAuthenticated()){
        ?>

        <?php
        echo $strings['Usuario'] . ' : ' . $_SESSION['login'] . '<br>';
        ?>
    </div>
    <div width: 50%; align="right">
        <a href='../Functions/Desconectar.php'>
            <img src='../View/Icons/sign-error.png' style="width:20px; height:20px">
        </a>
    </div>
    <?php
    }
    else{
        echo $strings['Usuario no autenticado'];
        echo 	'<form action=\'../Controller/Register_Controller.php\' method=\'post\'>
					<input type=\'submit\' name=\'action\' value=\'REGISTER\'>
				</form>';
    }
    ?>
</header>

<div id = 'main'>
    <?php
    //session_start();
    if (IsAuthenticated()){
        include 'Menu.php';
    }
    ?>
    <article>