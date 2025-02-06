<?php
namespace App\Crud;

use mysqli;
use mysqli_sql_exception;
use mysqli_stmt;
use Exception;

class DB
{

   private $con;

   public function __construct()
   {
      $host = $_ENV['HOST'];
      $user = $_ENV['DB_USER'];
      $pass = $_ENV['PASSWORD'];
      $db = $_ENV['DATABASE'];
      try {
         $this->con = new mysqli($host, $user, $pass, $db);

      } catch (mysqli_sql_exception $e) {
         die("Error accediendo a la base de datos " . $e->getMessage());
      }
   }



   /**
    * @param string $nombre
    * @param string $pass
    * @return array
    * //Verifica si un usuario existe en la base de datos
    */
   public function validar_usuario(string $nombre, string $pass): array
   {
      // Verificar la conexión antes de ejecutar
      if (!$this->con) {
         return [];
      }

      $sql = "SELECT * FROM usuarios WHERE nombre = ? AND pass = ?";
      $stmt = $this->ejecuta_sentencia($sql, [$nombre, password_hash($pass)]);
      if ($stmt) {
         $stmt->bind_result($id, $nombre, $pass, $token, $rol);
         $resultCount = 0;
         while ($stmt->fetch()) {
            $resultCount++;
            if ($resultCount > 1) {
               break;
            }
            $user = ["id" => $id, "nombre" => $nombre, "pass" => $pass, "token" => $token, "rol" => $rol];
         }
         $stmt->close();
         if ($resultCount !== 1) {
            return [];
         }
         return $user;
      } else {
         return [];
      }

   }
   /*
    * Este método tendría que investigar en el diccionario de datos
    * Devolverá qué campos de esta tabla son claves foráneas
    * */
   public function get_foraneas(string $tabla): array
   {
   }


   public function get_campos(string $table): array
   {
      $campos = [];
      if (!$this->con) {
         return false;
      }



      return $campos;

   }

   // Retorna un array con las filas de una tabla
   public function get_filas(string $sentencia): array
   {
      $filas = [];
      if (!$this->con) {
         return false;
      }

      return $filas;
   }

   //Borra una fila de una tabla dada su código
   //Retorna un mensaje diciendo si lo ha podido borrar o no
   public function borrar_fila(string $table, int $cod): string
   {
      if (!$this->con) {
         return "Error en la conexión";
      }

   }

   public function close()
   {
      $this->con->close();
   }

   // Añade una fila cuyos valores se pasan en un array.
   //Tengo el nombre de la tabla y el array ["nombre_Campo"=>"valor"]
   public function add_fila(string $tabla, array $campos)
   {


      if (!$this->con) {
         return false;

      }

   }

   //Registra un usuario en la tabla usuarios y me pasan el nombre y el pass
   //El pass tiene que estar cifrado antes de insertar
   //Retorna un bool = true si ha ido bien o un mensaje si ha ocurrdio algún problema, como que el usuario ya existiese
   public function registrar_usuario($nombre, $pass): bool|string
   {
      if (!$this->con) {
         return false;
      }



   }

   //Verifica si un usuario existe o no
   private function existe_usuario(string $nombre): bool
   {

   }

   //Ejecuta una sentencia y retorna un mysql_stmt
   //La sentencia hay que paraemtrizarla
   //Recibo la sentencia con parámetros y un array indexado con los valores
   private function ejecuta_sentencia(string $sql, array $datos): mysqli_stmt|null
   {
      if (!$this->con) {
         return null;
      }
      try {
         $stmt = $this->con->prepare($sql);

         if (!$stmt) {
            die("Error al preparar la sentencia: " . $this->con->error);
         }

         if (!empty($datos)) {
            // Generar los tipos de datos para el bind_param (s = string, i = integer, d = double, b = blob)
            $tipos = str_repeat('s', count($datos)); // Suponiendo que todos los parámetros son strings

            $stmt->bind_param($tipos, ...$datos);
         }

         $stmt->execute();

         return $stmt;
      } catch (Exception $e) {
         echo "Error: " . $e->getMessage();
         return null;
      }
   }

   private static function genToken(): string
   {
      return bin2hex(random_bytes(64));
   }

   private static function updateToken(array $user): string
   {
      $token = self::genToken();
      $db = new DB();
      $sql = "UPDATE usuarios SET token = ? WHERE id = ?";
      $db->ejecuta_sentencia($sql, [$token, $user["id"]]);
      $db->close();
      return $token;

   }

   public static function getUser(string $token): array
   {
      $db = new DB();
      $sql = "SELECT * FROM usuarios WHERE token = ?";
      try {
         $stmt = $db->ejecuta_sentencia($sql, [$token]);
         $stmt->bind_result($id, $nombre, $pass, $token, $rol);
         $stmt->fetch();
         $stmt->close();
         $db->close();
         $user = ["id" => $id, "nombre" => $nombre, "pass" => $pass, "token" => $token, "rol" => $rol];
         $token = self::updateToken($user);
         $user["token"] = $token;
         return $user;
      } catch (Exception $e) {
         echo "Error: " . $e->getMessage();
         $db->close();
         return [];
      }

   }

}
?>