<?php

//include 'Strings_SPANISH.php';
//include 'Strings_ENGLISH.php';

class {{TABLE_NAME}}_SHOWALL_View
{
    const HTML_HEADER ="<html>
        <head>
            <meta charset=\'UTF-8\'>
            <title>{{title}}</title>
            <link rel='stylesheet' href='Views/css/iu.css'>
        </head>
        <body>";

    const HTML_SKELETON = "
        <div class='data'>
            <h1>{{header}}</h1>
            {{data}} 
        </div>";

    private $title;
    private $header;
    private $field_list;
    private $values_list;

    /**
     * ASIGNATURA_SHOWALL_View constructor.
     * @param array $field_list Campos a mostrar en la vista
     * @param array $values_list Lista de valores a mostrar
     */
    public function __construct($field_list, $values_list)
    {
        global $strings;
        $this->field_list = $field_list;
        $this->values_list = $values_list;

        $this->title = $strings["SHOW ALL "]. "{{TABLE_NAME}}";
        $this->header = $strings["SHOW ALL "] . "{{TABLE_NAME}}";
    }

    /**
     * @return array
     */
    public function getFieldList()
    {
        return $this->field_list;
    }

    /**
     * @param array $field_list
     */
    public function setFieldList($field_list)
    {
        $this->field_list = $field_list;
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

    /**
     *
     */
    public function render()
    {
        $html = str_replace("{{title}}", $this->title, self::HTML_SKELETON);
        $html = str_replace("{{header}}", $this->header, $html);
        $html = str_replace("{{data}}", $this->generateTable(), $html);
        print (self::HTML_HEADER);
        include 'Menu.php';
        print ($html);
        include 'Footer.php';
        print ("</body></html>");
    }

    private function generateTable()
    {
        $table = "<table>";
        $table .= "<td> <a href='{{TABLE_NAME}}_Controller.php?action=ADD'>
								<img src='Views/Icons/add.png' height='20px' width='20px'>
							</a> </td>";
        $table = $table . "<tr>";

        foreach ($this->field_list as $field) {
            $table = $table . "<th>" . utf8_encode($field) . "</th>";
        }
        $table = $table . "</tr>";
        foreach ($this->values_list as $value) {
            $table = $table . "<tr>";
            foreach ($this->field_list as $field) {
                //la siguiente comprobación mira si el nombre del campo del los php coincide con el de la BD
                //Si no coincide, muestra una columna vacía
                if(isset($value[$field]) && !is_null($value[$field])){
                $table = $table . "<td>" . utf8_encode($value[$field]) . "</td>";

                }else{
                    $table = $table . "<td></td>";
                }
            }
            $table .= "<td> <a href='{{TABLE_NAME}}_Controller.php?{{ATRIBUTO}}&action=EDIT'>
								<img src='Views/Icons/edit.png' height='20px' width='20px'>
							</a> </td>";
            $table .= "<td> <a href='{{TABLE_NAME}}_Controller.php?{{ATRIBUTO}}&action=DELETE'>
								<img src='Views/Icons/delete.png' height='20px' width='20px'>
							</a> </td>";
            $table .= "<td> <a href='{{TABLE_NAME}}_Controller.php?{{ATRIBUTO}}&action=SHOWCURRENT'>
								<img src='Views/Icons/details.png' height='20px' width='20px'>
							</a> </td>";
            $table = $table . "</tr>";
        }
        $table = $table . "</table><br>";
        $table .=  '<a href="Index_Controller.php" title="Back">Back</a>';

        return $table;
    }
}