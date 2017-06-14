<?php

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
        </head>

        <body>
        <h3>ADD {{TABLE_NAME}}</h3>
        <form action="?action=ADD" method="post">

            {{FORM}}
            <input type="submit" value="ADD"><br>
            <a href="{{TABLE_NAME}}_Controller.php" title="Ir la página anterior">Volver</a>

        </form>
        </body>
        </html>

        <?php
    }

}

