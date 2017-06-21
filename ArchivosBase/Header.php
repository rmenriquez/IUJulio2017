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

        include '../Locates/Strings_' . $_SESSION['idioma'] . '.php';
    }
?>
<html>

<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="../View/js/tcal.js"></script>
    <script type="text/javascript" src="../View/js/Validations.js"></script>
    <!-- <script type="text/javascript" src="../View/js/comprobar.js"></script>-->
    <!-- <link rel="stylesheet" type="text/css" href="../View/css/JulioCSS-2.css" media="screen" />-->
    <link rel="stylesheet" type="text/css" href="../View/css/tcal.css" media="screen" />
</head>
<body>
<header>
    <p>
    <h1>
        <?php echo $strings['MANAGEMENT']; ?>
    </h1>
    </p>


    <div class="language">
        <a href="../Controller/CambioIdioma.php?idioma=SPANISH"><img src="../View/Icons/spanish.png" style="width:20px; height:20px" title="<?php $strings['SPANISH']?>"></a>
        <a href="../Controller/CambioIdioma.php?idioma=ENGLISH"><img src="../View/Icons/english.png" style="width:20px; height:20px" title="<?php $strings['ENGLISH']?>"></a>

        <?php

        if (IsAuthenticated()){
        ?>

        <?php
        echo $strings['USER'] . ' : ' . $_SESSION['login'] . '<br>';
        ?>
    </div>
    <div class="logout">
        <a href='../Functions/Desconectar.php'>
            <img src='../View/Icons/sign-error.png' style="width:20px; height:20px">
        </a>
    </div>
    <?php
    }
    else{
        echo $strings['USER NOT FOUND'];
        echo 	"<form action='../Controller/Register_Controller.php' method='post'>
					<input type='submit' name='action' value='". $strings['REGISTER']."'>
				</form>";
    }
    ?>
</header>

<div class="main">
    <article>