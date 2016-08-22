<?php

namespace Config;
use Config\RemoteCommand as Remote;
/*
Clase usada para generar archivos BASH y ejecutarlos.
estos archivos se usar para crear tareas programadas.
tambien se usan para agilizar el despliegue de las vm
*/

class CreateBash {
	private $name;
	private $content;
	private $otros;
	private $remote

	public function __construct()
	{
		$this->remote = new Remote;
	}

	public function set($atributo,$contenido)
	{	
		$this->$atributo = $contenido;
	}

	public function init($filename)
	{
		$bash_folder = "../Bash/";
		$bash_init = "#!/bin/bash";

		$bash_content  = $bash_init;
		$bash_content .= "";
		$bash_content .= "";
		$bash_content .= "";
		$bash_content .= "";	
		$bash_content .= "";

		$basic = fopen($bash_folder.$filename, 'x');
		fwrite($basic, $bash_content);

		return $bash_folder.$filename;		
	}

	public function start ($filename)
	{
		
		$file = $this->init($filename);
		$this->remote->script($file);
		
	}
}

