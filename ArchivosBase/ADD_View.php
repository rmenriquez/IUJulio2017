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
    {

        include 'Header.php';
        ?>
        <html>
        <head>
            <title> <?php $strings["ADD"]?> {{TABLE_NAME}}</title>
            <meta charset="UTF-8">
            <link rel='stylesheet' href='../View/css/iu.css'>
        </head>
        <body>

        <?php
        include 'Menu.php';
        ?>
        <h3> <?php $strings["ADD"]?> {{TABLE_NAME}}</h3>
        <form action="?action=ADD" method="post">

            {{FORM}}
            <input type="submit" value="<?php $strings["ADD"]?>"><br>

        </form>
        <a href="{{TABLE_NAME}}_Controller.php" title="<?php echo $strings["BACK"]?>"><?php echo $strings["BACK"]?></a>

        <?php include 'Footer.php';
        ?>
        </body>
        </html>

        <?php
    }

}

