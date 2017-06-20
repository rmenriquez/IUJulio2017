<?php

/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 12/6/17
 * Time: 21:35
 */
class {{TABLE_NAME}}_DELETE_View
{
    /**
     * @var array $values_list
     */
    private $values_list;


    public function __construct($values_list)
{
    $this->values_list = $values_list;
}

    /**
     * @return array
     */
    public function getValuesList()
{
    return $this->values_list;
}

    /**
     * @param array $values_list
     */
    public function setValuesList($values_list)
{
    $this->values_list = $values_list;
}

    public function render()
{
    include 'Header.php';
    ?>
    <html>
    <head>
        <title> <?php echo $strings["DELETE"]?> {{TABLE_NAME}}</title>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='Views/css/iu.css'>
    </head>
    <body>
    <div class="menu">
<?php
    include 'Menu.php';
?>
    </div>
    <div class="delete">
    <h1> <?php echo $strings["DELETE"]?> {{TABLE_NAME}}</h1>
        <table>
<?php
    $table = "";
    foreach ($this->values_list as $key => $values) {
        $table = $table . "<tr><td>" . utf8_encode($key) . "</td>";
        $table = $table . "<td>" . utf8_encode($values) . "</td><br>";
        $table = $table . "</tr>";
    }
    print ($table);?>
    </table>

    <input type="submit" value="<?php echo $strings['DELETE']?>"><br>
    <a href={{TABLE_NAME}}_Controller.php title="<?php echo $strings["BACK"]?>"><?php echo $strings["BACK"]?></a>
    </div>
        <?php
    include 'Footer.php';
    ?>
    </body>
    </html>

    <?php

}
}