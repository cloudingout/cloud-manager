<?php 
namespace Models\Auth;

/**
* Especifica los métodos que deben ser usados por la clase Auth
*
* @package Auth
* @author Cristhian David García
*
*/
interface IAuth 
{
  public function authenticate();
  public function isLoggedIn();
  public function redirect($url);
  public function logout();
}
