<?php 

namespace Models\Auth;

interface IAuth 
{
  public function authenticate($user);
  public function isAuthenticate();
  public function destroy();
  public function user();
  public function tokenUser();
}
