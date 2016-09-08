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

	#nombre del script que se ejecutara
	private $name;
	
	#contenido del script
	private $content;

	#variable usada para instanciar la clase RemoteCommand
	private $remote;	

	#variable usada para instanciar la clase info
	private $info;

	public function __construct()
	{
		#Instanciamos la Clase Remote
		$this->remote = new Remote;
		$this->info = new Info;
	}

	public function set($atributo,$contenido)
	{	
		$this->$atributo = $contenido;
	}
	/*esta metodo se encarga de crear script's en bash deacuerdo al parametro
	que resiva este metodo */

	private function init($image_name=NULL,$vmname=NULL,$profile=NULL)
	{
		/*
		No modificar las variables.
		La primera indica el directorio base donde se guardaran los script's
		La segunda contine la forma somo se inician los script's bash
		*/
		
		if (!empty($vmname))
		{
			$this->info->set('vmname',$vmname);
		}

		/* Pasando   */
		if (!empty($image_name) AND !empty($vmname) AND $this->name == "launch")
		{
			$this->info->set('vmname',$vmname);
			$this->info->set('image_name',$image_name);
		}

		$bash_folder = "/home/luisito/Proyectos/cloud-manager/Bash/";
		$bash_init = "#!/bin/bash";

		switch ($this->name) 
		{
			case "launch":				
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "lxc launch ". $this->info->get('image_name') ." ".$this->info->get('vmname');				
				$this->content[] = "lxc config set ". $this->info->get('vmname') ." limits.memory ". $this->info->profile($profile)['ram']."MB";
				$this->content[] = "lxc config device set ". $this->info->get('vmname')." root size ".$this->info->profile($profile)['disk'];
				$this->content[] = "sleep 2";
				break;
			case "stop":
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "lxc stop ".$this->info->get('vmname');		
				$this->content[] = "sleep 1";				
				break;
			case "start":
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "lxc start ".$this->info->get('vmname');
				$this->content[] = "sleep 1";				
				break;
			case "delete":
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "lxc stop ".$this->info->get('vmname');
				$this->content[] = "lxc delete ".$this->info->get('vmname');
				$this->content[] = "sleep 1";					
				break;
			case "snapshot":
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "lxc snapshot ".$this->info->get('vmname');
				$this->content[] = "sleep 1";					
				break;
			case "upgrade":
				/* La variable $this->content contiene el cuerpo del documento bash */
				$this->content[] = $bash_init;
				$this->content[] = "apt-get upgrade";
				$this->content[] = "sleep 1";					
				break;
			case "update":
				$this->content[] = $bash_init;
				$this->content[] = "apt-get update";
				$this->content[] = "sleep 1";				
				break;
			}

			$writer = "";
			foreach ($this->content as $key => $value) {
				$writer .= $value.PHP_EOL;
			}
			/*
			Ahora vamos a crear el archivo con la funcione fopen
			luego guardamos el contenido y le cambiamos los permisos al archivo para que
			se puede ejecutar.
			*/
			$basic = fopen($bash_folder.$this->name.'.sh', 'x');
			fwrite($basic, $writer);
			/* Retornamos la ubicacion del archivo creado. */
			return $bash_folder.$this->name.'.sh';					
	}

	/* Esta funcion se encarga de ejecutar los script's creados por la funcion anterior*/
	public function start_bash ($filename,$vmname=NULL,$image_name=NULL,$profile=NULL)
	{		
		$this->name = $filename;
		/*Ejecutamos el metodo init contenido en este script*/
		$file = $this->init($image_name,$vmname,$profile);
		/*Definimos los parametros del server al que nos conectaremos */
		$this->remote->add('user','root');
		$this->remote->add('host','172.16.0.45');
		#se comento porque se añadio la clave publica al usuario por defecto.
		#$this->remote->add('key','/home/luisito/Proyectos/cloud-manager/Keys/Key_app.local');
		/*Ejecutamos el script en el servidor remoto */
		$retornos = $this->remote->script($file);
		
		/* Borramos archivos temporal */		
		#$removecommand = 'rm -fr '.$file;		
		$this->remote->add('command','rm -fr '.$file);
		$this->remote->localExeggutor();

		/*Retornamos el contenido */
		return $retornos;
	
	}

	public function time_script () 
	{
	
	}

}