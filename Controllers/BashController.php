<?php 

namespace Controllers;
use Config\CreateBash as Bash;
use Config\Predefinido as Definido;

class BashController {

	private $bash;

	public function __construct()
	{
		$this->bash = new Bash;
	}

	public function index()
	{
		$this->bash->start_bash('upgrade');
		echo $_SERVER['SCRIPT_FILENAME'];
	}
}