<?php
//Es la conexión a la base de datos
//Cambiar el usuario y la contraseña


/**
 * Created by PhpStorm.
 * User: RaquelMarcos
 * Date: 27/3/17
 * Time: 21:03
 */
class PDOConnection
{

    const DRIVER = "mysql";
    const HOST = "127.0.0.1";
    const DBNAME = "DemoIUJulio";
    const PORT = 3306;
    const USER = "root";
    const PASSWORD = "";

    /**
     * @return PDO
     */
    public static function getConnection()
    {

        return new PDO(self::DRIVER . ":host=" . self::HOST . ";dbname=" . self::DBNAME . ";port=" . self::PORT, self::USER, self::PASSWORD);

    }


}