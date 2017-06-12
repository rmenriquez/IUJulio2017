<?php

/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 27/3/17
 * Time: 21:54
 */
class SHOWALL_View
{

    const HTML_SKELETON = "
        <html>
        <head>
            <meta charset=\"UTF-8\">
            <title>{{title}}</title>
        </head>
        <body>
        <h1>{{header}}</h1>
        {{data}}
        </body>
        </html>";

    const TITLE_KEY = "{{title}}";
    protected $title;

    const HEADER_KEY = "{{header}}";
    protected $header;

    const DATA_KEY = "{{data}}";

    private $field_list;
    private $values_list;

    /**
     * ASIGNATURA_SHOWALL_View constructor.
     * @param array $field_list Campos a mostrar en la vista
     * @param array $values_list Lista de valores a mostrar
     */
    public function __construct($field_list, $values_list)
    {
        $this->field_list = $field_list;
        $this->values_list = $values_list;

        $this->title = "Listado {{TABLE_NAME}}";
        $this->header = "Listado {{TABLE_NAME}}";

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
        $html = str_replace(/*self::TITLE_KEY*/"{{title}}", $this->title, self::HTML_SKELETON);
        $html = str_replace(/*self::HEADER_KEY*/"{{header}}", $this->header, $html);
        $html = str_replace(/*self::DATA_KEY*/"{{data}}", $this->generateTable(), $html);
        print ($html);
    }

    private function generateTable()
    {
        $table = "<table>";
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
            $table = $table . "</tr>";
        }
        $table = $table . "</table>";
        return $table;
    }
}