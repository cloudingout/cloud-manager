<?php

namespace Controllers;

use Models\Auth\Auth as Auth;

use Models\Plan as Plan;

class HomeController
{


  public function index()
  {
    $plan = new Plan();
    return $plan->viewForUsers();
  }
}