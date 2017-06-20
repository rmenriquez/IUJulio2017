<?php
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 19/6/17
 * Time: 12:49
 */

<?php

class MESSAGE{

    private $message;
    private $volver;

    function __construct($message, $volver){
        $this->string = $message;
        $this->volver = $volver;
        $this->render();
    }

    function render(){
        include '../View/Header.php';
    ?>
    <html>
        <head>
            <meta charset=\'UTF-8\'>
            <title><?php echo $strings['MESSAGE'] ?></title>
            <link rel='stylesheet' href='../View/css/iu.css'>
        </head>
        <body>
        <div class="menu">
            <?php
            include 'Menu.php';
            ?>
        </div>
        <div class="message">
            <?php
             echo $strings[$this->message];
            ?>
        </div>

        <?php
        echo '<a href=\'' . $this->volver . "'>" . $strings['BACK'] . " </a>";
        include '../View/Footer.php';
        ?>
        </body>
    </html>
<?php
}

}
