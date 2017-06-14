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
    { ?>
        <html>
        <head>
            <title> Search {{TABLE_NAME}}</title>
            <meta charset="UTF-8">
        </head>

        <body>
        <h3>Search {{TABLE_NAME}}</h3>
        <form action="?action=EDIT" method="post">

            {{FORM}}
            <input type="submit" value="Search"><br>
            <a href="../Controller/{{TABLE_NAME}}_Controller.php" title="Back">Back</a>


        </form>
        </body>
        </html>

        <?php
    }
}