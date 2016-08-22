<?php 

namespace Config; 

	class RemoteCommand {
		
		private $command;
		private $host;
		private $user;
		private $key;

		/*
		Funcion encargada de asignar contenido al atributo de la clase
		*/
		public function add ($atributo, $contenido) 
		{
			$this->$atributo = $contenido;
		}

		/* 
		Esta funcion sirve para ejecutar scritp remotos en los anfitriones
		que van a contener las maquinas virtuales
		*/
		public function script ($script)
		{
			#construccion del comando 
			$new_comand = 'ssh -i ' . $this->key . ' ' . $this->user . '@'. $this->host . " bash -s" .' < ' . $script;
			$resultado = shell_exec($new_comand);
			#ejecucion y retorno del comando	
			return $resultado;
		}

		/* 
		Esta funcion sirve para ejecutar comandos remotos en los anfitriones 
		que van a contener las maquinas virtuales
		*/
		public function exeggutor ()
		{
			$new_comand = 'ssh -i ' . $this->key . ' ' . $this->user . '@' . $this->host . ' ' . $this->command;
			$resultado = '<pre>'.shell_exec($new_comand) . '</pre>';
			#ejecucion y retorno del comando	
			return $resultado;
		}

		/*
		Esta funcion se usa para ejecutar comando localmente.
		*/
		public function localExeggutor ()
		{
			$new_comand = $this->command;
			$resultado = '<pre>'.shell_exec($new_comand) . '</pre>';
			#ejecucion y retorno del comando	
			return $resultado;
		}

	}

	