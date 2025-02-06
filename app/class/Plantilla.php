<?php

namespace App\Crud;

class Plantilla
{
   const EDIT = <<<FIN
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>

FIN;

   const BORRAR = <<<FIN
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20" class="h-6 w-6 text-red-700">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
FIN;

   private static function get_select_foranea(array $foraneas, DB $db): string
   {
      $select = "";

      return $select;
   }
   public static function get_formulario(array $campos, array $foraneas, $db): string
   {
      $html = "";

      return $html;
   }

   private static function add_field(string $campo): string
   {
      $html = "";

      return $html;


   }

   public static function get_tabla(array $campos, array $filas): string
   {

      $tabla = self::cabecera();
      $tabla .= self::titulos($campos);

      $tabla .= self::filas($filas);

      $tabla .= "</table>";

      $tabla .= "</div>";

      return $tabla;

   }

   /**
    * @return string
    */
   public static function cabecera(): string
   {
      $tabla = "";
      return $tabla;
   }

   private static function titulos(array $campos): string
   {
      $cabecera = "";
      return $cabecera;
   }

   /**
    * @param $filas
    * @param string $tabla
    * @param string $borrar
    * @param string $add
    * @return string
    */
   public static function filas(array $filas, string $borrar, string $edit): string
   {
      $tabla = "";
      foreach ($filas as $fila) {

      }




      return $tabla;
   }

   /**
    * @param string $usuario
    * @return string
    */


   public static function html_logout($usuario)
   {
      $html_logout = <<<LOGOUT_FORM
      <form action='index.php' method='post'>
         <input type='submit' value='Logout'>
      </form>
      LOGOUT_FORM;
      return $html_logout;

   }

   public static function html_login()
   {
      $html_login = <<<LOGIN_FORM
      <form action='sitio.php' method='post'>
         <input type='text' name='usuario' placeholder='Usuario'>
         <input type='password' name='password' placeholder='Contraseña'>
         <input type='submit' value='Login' name='submit'>
      </form>
      LOGIN_FORM;
      return $html_login;
   }

   public static function html_register()
   {
      $html_register = <<<REGISTER_FORM
      <form action='sitio.php' method='post'>
         <input type='text' name='nombre' placeholder='Nombre'>
         <input type='text' name='apellidos' placeholder='Apellidos'>
         <input type='text' name='email' placeholder='Email'>
         <input type='password' name='password' placeholder='Contraseña'>
        <input type='submit' value='Registrarse' name='submit'>
      </form>
      REGISTER_FORM;
      return $html_register;
   }

   public static function html_index()
   {
      $html_index = <<<INDEX_FORM
      <form action='index.php' method='post'>
        <input type='submit' value='Entrar' name='submit'>
        <input type='submit' value='Registrarse' name='submit'>
      </form>
      INDEX_FORM;
      return $html_index;
   }
}

?>