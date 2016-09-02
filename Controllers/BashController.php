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
			$this->bash->start_bash('launch','ubuntu:16.04','cristian','tier1');
			#$this->bash->start_bash('update');
		}
}