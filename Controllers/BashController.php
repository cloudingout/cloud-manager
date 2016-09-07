<?php 

namespace Controllers;
use Config\CreateBash as Bash;
use Config\Info as Info;

/**
* Controlador para Bash
*
* @package BashController
* @author Luis Penagos <luispenagos91@gmail.com>
*/ 

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
			$names = ['luis','mv2','mv3'];

			foreach($names as $name)
			{			
				$this->bash->start_bash('launch',$name,'ubuntu:16.04','tier0');
				sleep(1);
			}
			#start_bash('accion','nombre de la vm',' nombre template','plan usado')
			#$this->bash->start_bash('update');
		}
}