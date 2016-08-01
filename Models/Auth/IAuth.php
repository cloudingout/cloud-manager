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
  public function authenticate($user);
  public function isAuthenticate();
  public function destroy();
  public function user();
  public function tokenUser();
}
