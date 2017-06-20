<?php
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 5/6/17
 * Time: 20:36
 */

class {{TABLE_NAME}}_EDIT_View
{

    private $values_list;
    private $field_list;

    public function __construct($field_list, $values_list){
        $this->field_list=$field_list;
        $this->values_list=$values_list;
    }

    public function render()
{
    include 'Header.php';
    ?>
    <html>
    <head>
        <title> <?php echo $strings["EDIT"]?> {{TABLE_NAME}}</title>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='../View/css/iu.css'>
    </head>
    <body>
    <?php include 'Menu.php';
    ?>
    <h3><?php echo $strings["EDIT"]?> {{TABLE_NAME}}</h3>
    <form action="?action=EDIT" method="post">

        {{FORM}}
        <input type="submit" value="<?php $strings["EDIT"]?>"><br>

    </form>
    <a href="{{TABLE_NAME}}_Controller.php" title="<?php echo $strings["BACK"]?>"><?php echo $strings["BACK"]?></a>

    <?php include 'Footer.php';
    ?>
    </body>
    </html>

    <?php
}

}

