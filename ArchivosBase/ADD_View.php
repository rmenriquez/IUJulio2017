<?php
include 'Footer.php';
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 3/4/17
 * Time: 21:30
 */
class {{TABLE_NAME}}_ADD_View{
    public
    function render()
    { ?>
        <html>
        <head>
            <title> ADD {{TABLE_NAME}}</title>
            <meta charset="UTF-8">
            <link rel='stylesheet' href='Views/css/iu.css'>
        </head>
        <body>
        <?php include 'Menu.php';
        ?>
        <h3>ADD {{TABLE_NAME}}</h3>
        <form action="?action=ADD" method="post">

            {{FORM}}
            <input type="submit" value="ADD"><br>
            <a href="{{TABLE_NAME}}_Controller.php" title="Back">Back</a>

        </form>
        <?php include 'Footer.php';
        ?>
        </body>
        </html>

        <?php
    }

}

