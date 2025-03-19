<?php

class Conexion
{

  private static $server = "localhost";
  private static $user = "root";
  private static $pass = "";
  private static $db = "cosa_nostra";
  private static $conexion = null;

  public static function connectPDO()
  {
    if (self::$conexion === null) {

      try {
        self::$conexion = new mysqli(self::$server, self::$user, self::$pass, self::$db);
      } catch (Exception $ex) {
        if (self::$conexion->connect_errno) {
          die("Error de conexión: " . self::$conexion->connect_error);
        } else {
          echo "Error de conexión: " . $ex->getMessage();
        }
      }
    }
    return self::$conexion;
  }

}

?>