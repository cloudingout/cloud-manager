<?php 

namespace Controllers;
use Config\CreateBash as Bash;
use Config\Predefinido as Definido;
use Config\Info as Info;

class BashController {

	private $bash;
	private $info;

	public function __construct()
	{
		$this->bash = new Bash;
		$this->info = new Info;

	}

	public function index()	
	{				
		print $this->bash->start_bash('launch','ubuntu:16.04','cristian');
		#$this->bash->start_bash('update');		
	}
}