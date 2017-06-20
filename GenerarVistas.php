<?php
/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 4/4/17
 * Time: 19:50
 *
 * SOLO VAN A TENER TIPO DE DATOS VARCHAR, INT Y DATE
 */


$aux = "iupruebasql";
$path = "pruebasVarias/";
include_once "PDOConnection.php";
include_once "ArchivosBase/css/tcal.css";

function getTablesNames()
{
    $db = PDOConnection::getConnection();
    $sql = "show tables";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $names = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    /*foreach ($names as $aux){
        var_dump($aux);

    }
    //var_dump($names);
*/
    return $names;
    //fetchAll porque vamos a devolver varias filas
}

function getTablesColumns($name)
{
    $db = PDOConnection::getConnection();
    $sql = "DESCRIBE $name";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
}

function getInformacion()
{

    $names = getTablesNames();
    $info = array();
    for ($i = 0; $i < count($names); $i++) {
        array_push($info, array("name" => $names[$i], "columns" => getTablesColumns($names[$i])/*,
        "relations" => getRelationships($GLOBALS['aux'], $names[$i])*/));

    }
    var_dump($info);
    return $info;

}

/*function getRelationships($bd, $tableName)
{
    $db = PDOConnection::getConnection();
    $sql = "SELECT `TABLE_SCHEMA`, `TABLE_NAME`, `COLUMN_NAME`, `REFERENCED_TABLE_SCHEMA`, `REFERENCED_TABLE_NAME`, `REFERENCED_COLUMN_NAME`" .
        "FROM `INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE` " .
        "WHERE `REFERENCED_TABLE_SCHEMA` = :bd AND `TABLE_NAME` = :tableName";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(":bd", $bd);
    $stmt->bindParam(":tableName", $tableName);
    $stmt->execute();
    return $stmt->fetchall(PDO::FETCH_ASSOC);
}*/

//Ahora tenemos la infomación de todas las tablas, no los datos
//Ahora lo tendriamos que mandar a un documentos externo

$info = getInformacion();


mkdir($path, 0777, true);

//Se crea la carpeta de las vistas
mkdir($path . '/View', 0777, true);

//Se crea la carpeta de los strings
mkdir($path . '/Locates', 0777, true);

$pathIdiomas = "pruebasVarias/Locates";

//Se crea el directorio de los iconos
mkdir($path . '/View/Icons', 0777, true);
//se copian las imágenes en la carpeta Icons generada
copy("ArchivosBase/Icons/add.png", $path . "/View/Icons/add.png");
copy("ArchivosBase/Icons/delete.png", $path . "/View/Icons/delete.png");
copy("ArchivosBase/Icons/details.png", $path . "/View/Icons/details.png");
copy("ArchivosBase/Icons/edit.png", $path . "/View/Icons/edit.png");
copy("ArchivosBase/Icons/spanish.png", $path . "/View/Icons/spanish.png");
copy("ArchivosBase/Icons/english.png", $path . "/View/Icons/english.png");

//se crea el directorio del css
mkdir($path . '/View/css', 0777, true); //path, permisos, recursivo
//Se copia el archivo css
copy("ArchivosBase/css/iu.css", $path . "/View/css/iu.css");


//se crea el directorio del javaScript
mkdir($path . '/View/js', 0777, true); //path, permisos, recursivo
//se copia el archivo de
copy("ArchivosBase/js/Validations.js", $path . "/View/js/Validations.js");


//se copia el index en la carpeta final
copy("ArchivosBase/index.php", $path . "index.php");

//se copia los arrays de los idiomas
//Inglés
if (!file_exists($pathIdiomas . "/Strings_ENGLISH.php")) {
    copy("ArchivosBase/Strings_ENGLISH.php", $path . "/Locates/Strings_ENGLISH.php");
} else {
    $strings = file_get_contents("ArchivosBase/Strings_ENGLISH.php");
    $strings = str_replace("\$strings", "\$strings2", $strings);
    $strings .= "\$strings = \$strings + \$strings2";
}
//Español
if (!file_exists($pathIdiomas . "/Strings_SPANISH.php")) {
    copy("ArchivosBase/Strings_SPANISH.php", $path . "/Locates/Strings_SPANISH.php");
} else {
    $strings = file_get_contents("ArchivosBase/Strings_SPANISH.php");
    $strings = str_replace("\$strings", "\$strings2", $strings);
    $strings .= "\$strings = \$strings + \$strings2";
}

//Se copia el menú lateral
copy("ArchivosBase/Menu.php", $path . "/view/Menu.php");
//Se genera el codigo del menú
$code = "";
foreach ($info as $table) {
    $tableName = $table["name"];
    $code .= "<li> <a href=" . "'../Controller/" . $tableName . "_Controller.php'> Gestión de " . $tableName . "</a> </li>";

}
$html = file_get_contents("ArchivosBase/Menu.php");
$html = str_replace("{{data}}", $code, $html);
file_put_contents("$path/View/Menu.php", $html);

//Se crea la fecha del Footer.php
$date = New DateTime('UTC');
$date = $date->format("D-M-Y");
$html = file_get_contents("ArchivosBase/Footer.php");
$html = str_replace("{{DATE}}", $date, $html);
file_put_contents("$path/View/Footer.php", $html);


//Se copia el Header
copy("ArchivosBase/Header.php", $path . "/View/Header.php");


//Se crean los SHOWALL_View a través de las tablas
foreach ($info as $table) {
    $tableName = $table["name"];
    $id_field = "";
    foreach ($table["columns"] as $column) {
        if ($column["Key"] === "PRI") {
            $id_field = $column["Field"];
        }
        $code = $id_field . '="' . '.$value[' . "\"$id_field\"" . ']."';
        $html = file_get_contents("ArchivosBase/SHOWALL_View.php");
        $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
        $html = str_replace("{{ATRIBUTO}}", $code, $html);
        file_put_contents("$path/View/" . strtoupper($tableName) . "_SHOWALL_View.php", $html);
    }
}

//Crear las vistas showCurrent
foreach ($info as $table) {
    $tableName = $table["name"];
    $html = file_get_contents("ArchivosBase/SHOWCURRENT_View.php");
    $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
    file_put_contents("$path/View/" . strtoupper($tableName) . "_SHOWCURRENT_View.php", $html);
}


//Crear las vistas ADD
foreach ($info as $table) {
    $tableName = $table["name"];
    $form = "";
    foreach ($table["columns"] as $column) {

        $form .= "<label >" . $column["Field"] . "</label><br> \n";

        if (strpos($column["Type"], "int") !== false) {
            $ini = strpos($column["Type"], "(") + 1;
            $fin = strpos($column["Type"], ")");
            $n = substr($column["Type"], $ini, $fin - $ini);
            $form .= '<input type="number" name="' . $column["Field"] . '" min="0" maxLength="' . $n . '"><br>' . "\n";
        } else {
            if (strpos($column["Type"], "varchar") !== false) {
                $ini = strpos($column["Type"], "(") + 1;
                $fin = strpos($column["Type"], ")");
                $n = substr($column["Type"], $ini, $fin - $ini);
                $form .= '<input type="text" name="' . $column["Field"] . '" maxLength="' . $n . '"><br>' . "\n";
            } else {
                if (strpos($column["Type"], "date") !== false) {
                    $form .= '<input class="tcal" type="date" name="' . $column["Field"] . '"><br>' . "\n";
                } else {
                    if (strpos($column["Type"], "enum") !== false) {
                        $enum = str_replace("enum(", "", $column["Type"]);
                        $enum = str_replace(")", "", $enum);
                        $options = explode(",", $enum);
                        $select = '<select>';
                        foreach ($options as $opt) {
                            $select .= "<option value=" . $opt . ">" . $opt . "</option> \n";
                        }
                        $select .= "</select>" . "\n";
                        $form .= $select;
                    } else {
                        if (strpos($column["Type"], "float") !== false || strpos($column["Type"], "double") !== false) {
                            $ini = strpos($column["Type"], "(") + 1;
                            $fin = strpos($column["Type"], ")");
                            $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                            $form .= '<input type="text" name="' . $column["Field"] . '" maxLength="' . $n . '"><br>' . "\n";
                        } else {
                            if (strpos($column["Type"], "year") !== false) {
                                $form .= '<input type="number" name="' . $column["Field"] . '" min="1000" maxLength="4"><br>' . "\n";
                            } else {
                                if (strpos($column["Type"], "char") !== false) {
                                    $ini = strpos($column["Type"], "(") + 1;
                                    $fin = strpos($column["Type"], ")");
                                    $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                                    $form .= '<input type="text" name="' . $column["Field"] . '" min="0" maxLength="' . $n . '"  size="' . $n . '"><br>' . "\n";

                                }
                            }
                        }
                    }
                }
            }
        }

    }

    $html = file_get_contents("ArchivosBase/ADD_View.php");
    $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
    $html = str_replace("{{FORM}}", $form, $html);
    file_put_contents("$path/View/" . strtoupper($tableName) . "_ADD_View.php", $html);
}

//Crear las vistas EDIT
foreach ($info as $table) {
    $tableName = $table["name"];
    $form = "";
    foreach ($table["columns"] as $column) {

        $form .= "<label >" . $column["Field"] . "</label><br> \n";

        if (strpos($column["Type"], "int") !== false) {
            $ini = strpos($column["Type"], "(") + 1;
            $fin = strpos($column["Type"], ")");
            $n = substr($column["Type"], $ini, $fin - $ini);
            $form .= '<input type="number" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" min="0" maxLength="' . $n . '"><br>' . "\n";
        } else {
            if (strpos($column["Type"], "varchar") !== false) {
                $ini = strpos($column["Type"], "(") + 1;
                $fin = strpos($column["Type"], ")");
                $n = substr($column["Type"], $ini, $fin - $ini);
                $form .= '<input type="text" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" maxLength="' . $n . '"><br>' . "\n";
            } else {
                if (strpos($column["Type"], "date") !== false) {
                    $form .= '<input class="tcal" type="date" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" ><br>' . "\n";
                } else {
                    if (strpos($column["Type"], "enum") !== false) {
                        $enum = str_replace("enum(", "", $column["Type"]);
                        $enum = str_replace(")", "", $enum);
                        $options = explode(",", $enum);
                        $select = '<select>';
                        foreach ($options as $opt) {
                            $select .= "<option value=" . $opt . ">" . $opt . "</option>" . "\n";
                        }
                        $select .= "</select>" . "\n";
                        $form .= $select;
                    } else {
                        if (strpos($column["Type"], "float") !== false || strpos($column["Type"], "double") !== false) {
                            $ini = strpos($column["Type"], "(") + 1;
                            $fin = strpos($column["Type"], ")");
                            $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                            $form .= '<input type="text" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" maxLength="' . $n . '"><br>' . "\n";
                        } else {
                            if (strpos($column["Type"], "year") !== false) {
                                $form .= '<input type="number" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" min="1000" maxLength="4"><br>' . "\n";
                            } else {
                                if (strpos($column["Type"], "char") !== false) {
                                    $ini = strpos($column["Type"], "(") + 1;
                                    $fin = strpos($column["Type"], ")");
                                    $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                                    $form .= '<input type="text" name="' . $column["Field"] . '" value="<?php echo $this->valueList["' . $column['Field'] . '"]; ?>" min="0" maxLength="' . $n . '"  size="' . $n . '"><br>' . "\n";

                                }
                            }
                        }
                    }
                }
            }
        }

    }
    $html = file_get_contents("ArchivosBase/EDIT_View.php");
    $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
    $html = str_replace("{{FORM}}", $form, $html);
    file_put_contents("$path/View/" . strtoupper($tableName) . "_EDIT_View.php", $html);
}

//Crear las vistas SEARCH
foreach ($info as $table) {
    $tableName = $table["name"];
    $form = "";
    foreach ($table["columns"] as $column) {

        $form .= "<label >" . $column["Field"] . "</label><br> \n";

        if (strpos($column["Type"], "int") !== false) {
            $ini = strpos($column["Type"], "(") + 1;
            $fin = strpos($column["Type"], ")");
            $n = substr($column["Type"], $ini, $fin - $ini);
            $form .= '<input type="number" name="' . $column["Field"] . ' maxLength="' . $n . '"><br>' . "\n";
        } else {
            if (strpos($column["Type"], "varchar") !== false) {
                $ini = strpos($column["Type"], "(") + 1;
                $fin = strpos($column["Type"], ")");
                $n = substr($column["Type"], $ini, $fin - $ini);
                $form .= '<input type="text" name="' . $column["Field"] . ' maxLength="' . $n . '"><br>' . "\n";
            } else {
                if (strpos($column["Type"], "date") !== false) {
                    $form .= '<input class="tcal" type="date" name="' . $column["Field"] . '"><br>' . "\n";
                } else {
                    if (strpos($column["Type"], "enum") !== false) {
                        $enum = str_replace("enum(", "", $column["Type"]);
                        $enum = str_replace(")", "", $enum);
                        $options = explode(",", $enum);
                        $select = '<select>';
                        foreach ($options as $opt) {
                            $select .= "<option value=" . $opt . ">" . $opt . "</option>" . "\n";
                        }
                        $select .= "</select>" . "\n";
                        $form .= $select;
                    } else {
                        if (strpos($column["Type"], "float") !== false || strpos($column["Type"], "double") !== false) {
                            $ini = strpos($column["Type"], "(") + 1;
                            $fin = strpos($column["Type"], ")");
                            $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                            $form .= '<input type="text" name="' . $column["Field"] . ' maxLength="' . $n . '"><br>' . "\n";
                        } else {
                            if (strpos($column["Type"], "year") !== false) {
                                $form .= '<input type="number" name="' . $column["Field"] . ' maxLength="4"><br>' . "\n";
                            } else {
                                if (strpos($column["Type"], "char") !== false) {
                                    $ini = strpos($column["Type"], "(") + 1;
                                    $fin = strpos($column["Type"], ")");
                                    $n = substr($column["Type"], $ini, $fin - ($ini + 1));
                                    $form .= '<input type="text" name="' . $column["Field"] . 'maxLength="' . $n . '"  size="' . $n . '"><br>' . "\n";

                                }
                            }
                        }
                    }
                }
            }
        }

    }
    $html = file_get_contents("ArchivosBase/SEARCH_View.php");
    $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
    $html = str_replace("{{FORM}}", $form, $html);
    file_put_contents("$path/View/" . strtoupper($tableName) . "_SEARCH_View.php", $html);
}


//Crear vista DELETE
foreach ($info as $table) {
    $tableName = $table["name"];
    $html = file_get_contents("ArchivosBase/DELETE_View.php");
    $html = str_replace("{{TABLE_NAME}}", strtoupper($tableName), $html);
    file_put_contents("$path/View/" . strtoupper($tableName) . "_DELETE_View.php", $html);
}





