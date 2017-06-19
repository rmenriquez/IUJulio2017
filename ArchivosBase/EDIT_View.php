<?php
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 5/6/17
 * Time: 20:36
 */

class {{TABLE_NAME}}_EDIT_View
{
    public function render()
{ ?>
    <html>
    <head>
        <title> Edit {{TABLE_NAME}}</title>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='Views/css/iu.css'>
    </head>

    <body>
    <?php include 'Menu.php';
    ?>
    <h3>Edit {{TABLE_NAME}}</h3>
    <form action="?action=EDIT" method="post">

        {{FORM}}
        <input type="submit" value="Editar"><br>
        <a href="{{TABLE_NAME}}_Controller.php" title="Back">Back</a>


    </form>
    <?php include 'Footer.php';
    ?>
    </body>
    </html>

    <?php
}

}

