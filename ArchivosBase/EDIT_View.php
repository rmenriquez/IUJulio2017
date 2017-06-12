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
    </head>

    <body>
    <h3>Editar {{TABLE_NAME}}</h3>
    <form action="?action=EDIT" method="post">

        {{FORM}}
        <input type="submit" value="Editar"><br>

    </form>
    </body>
    </html>

    <?php
}

}

