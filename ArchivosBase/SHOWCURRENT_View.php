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
        $table = $table . "</table>";
        return $table;

    }
}