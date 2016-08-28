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
		$this->bash->start_bash('launch','ubuntu:i386','vm1');
		#$this->bash->start_bash('update');		
	}
}