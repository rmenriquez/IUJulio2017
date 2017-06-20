<?php

/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 12/6/17
 * Time: 21:28
 */
class {{TABLE_NAME}}_SEARCH_View
{
    public
    function render()
    {
        include 'Header.php';
        ?>
        <html>
        <head>
            <title> <?php $strings["SEARCH"]?> {{TABLE_NAME}}</title>
            <meta charset="UTF-8">
        </head>

        <body>
        <?php include 'Menu.php';
        ?>
        <h3><?php $strings["SEARCH"]?> {{TABLE_NAME}}</h3>
        <form action="?action=EDIT" method="post">

            {{FORM}}
            <input type="submit" value="<?php $strings['SEARCH']?>"><br>
        </form>
        <a href={{TABLE_NAME}}_Controller.php" title="<?php $strings["BACK"]?>"><?php$strings["BACK"]?></a>

        <?php include 'Footer.php';
        ?>
        </body>
        </html>

        <?php
    }
}