<?php

namespace Config;
use Config\RemoteCommand as Remote;
/**
* Clase usada para crear archivos bash dinamicamente con php.
*
* @package CreateBash
* @author Luis Penagos <luispenagos91@gmail.com>
*/

/*
Clase usada para generar archivos BASH y ejecutarlos.
estos archivos se usar para crear tareas programadas.
tambien se usan para agilizar el despliegue de las vm
*/

class CreateBash {
	private $name;
	private $content;
	private $otros;
	private $remote;

	public function __construct()
	{
		/*Instanciamos la Clase Remote en  */
		$this->remote = new Remote;
	}

	public function set($atributo,$contenido)
	{	
		$this->$atributo = $contenido;
	}
	/*esta metodo se encarga de crear script's en bash deacuerdo al parametro
	que resiva este metodo */

	private function init($filename)
	{
		/*
		No modificar las variables.
		La primera indica el directorio base donde se guardaran los script's
		La segunda contine la forma somo se inician los script's bash
		*/
		$bash_folder = "/var/www/html/Cloud/cloud-manager/Bash/";
		$bash_init = "#!/bin/bash";

		switch ($filename) 
		{
			case "":				
				/* La variable $bash_content contiene el cuerpo del documento bash */
				$bash_content  = $bash_init;
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";	
				$bash_content .= "";
				break;
			case "":
				/* La variable $bash_content contiene el cuerpo del documento bash */
				$bash_content  = $bash_init;
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";	
				$bash_content .= "";
				break;
			case "":
				/* La variable $bash_content contiene el cuerpo del documento bash */
				$bash_content  = $bash_init;
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";
				$bash_content .= "";	
				$bash_content .= "";
				break;
			case "upgrade":
				/* La variable $bash_content contiene el cuerpo del documento bash */
				$bash_content[0] = $bash_init;
				$bash_content[1] = "apt-get upgrade";
				$bash_content[2] = "sleep 1";	
				$writer = "";
				foreach ($bash_content as $key => $value) {
					$writer .= $value.PHP_EOL;
				}

				break;
			default:
				$bash_content  = $bash_init;
				$bash_content .= "apt-get update";
				$bash_content .= "sleep 1";	
				break;
			}
			/*
			Ahora vamos a crear el archivo con la funcione fopen
			luego guardamos el contenido y le cambiamos los permisos al archivo para que
			se puede ejecutar.
			*/
			$basic = fopen($bash_folder.$filename.'.sh', 'x');
			fwrite($basic, $writer);
			/* Retornamos la ubicacion del archivo creado. */
			return $bash_folder.$filename;					
	}

	/* Esta funcion se encarga de ejecutar los script's creados por la funcion anterior*/
	public function start_bash ($filename)
	{
		/*Ejecutamos el metodo init contenido en este script*/
		$file = $this->init($filename);
		/*Ejecutamos el script en el servidor remoto */
		$retornos = $this->remote->script($file);
		/*Retornamos el contenido */
		return $retornos;

	}

	public function time_script () 
	{

	}
}

