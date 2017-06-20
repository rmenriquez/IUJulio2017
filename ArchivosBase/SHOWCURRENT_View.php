<?php

/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 29/3/17
 * Time: 21:30
 */
class {{TABLE_NAME}}_SHOWCURRENT_View
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
        include 'Header.php'; ?>
        <html>
            <head>
            <title> <?php $strings["SHOWCURRENT"] ?> {{TABLE_NAME}}</title>
            <meta charset="UTF-8">
            <link rel='stylesheet' href='../View/css/iu.css'>
            </head>
        <body>
        <?php
        include 'Menu.php'; ?>
        <h3> <?php $strings["SHOWCURRENT"]?> {{TABLE_NAME}}</h3>
        <?php
        $table = "<table>";
        $table = $table . "<tr>";
        foreach ($this->values_list as $key => $values) {
            $table = $table . "<th>" . utf8_encode($key) . "</th>";
        }
        $table = $table . "</tr>";
        foreach ($this->values_list as $value) {
            $table = $table . "<tr>";


            $table = $table . "<td>" . utf8_encode($value) . "</td>";


            $table = $table . "</tr>";
        }
        $table = $table . "</table><br>";
        print ($table);?>
        <a href={{TABLE_NAME}}_Controller.php" title="<?php $strings["BACK"]?>"><?php$strings["BACK"]?></a>
        <?php include 'Footer.php'; ?>
        </body>
        </html>
<?php


    }
}