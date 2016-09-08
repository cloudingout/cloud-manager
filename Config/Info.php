<?php

namespace Config;

/**
* Clase usada para guardar datos en los objetos y obtener la informacion.
*	el metodo profile se usa para obtener los perfiles disponibles para las mv
*
* @package Info
* @author Luis Penagos <luispenagos91@gmail.com>
*/

class info {

	private $vmname;
	private $cpu;
	private $ram;
	private $disk;
	private $image_name;
	private $profile;

	public function set($atributo,$contenido)
	{
		$this->$atributo = $contenido;
	}

	public function get($atributo)
	{
		return $this->$atributo;
	}

	/* 
	este metodo se utiliza para obtener la informacion de los
	perfiles disponibles para las mv
	*/

	public function profile($name)
	{
		$this->profile = array(

			"tier0" => array(
						"ram"  => "256",
						"cpu"  => "1",
						"disk" => "10GB" ),

			"tier1" => array(
						"ram"  => "512",
						"cpu"  => "1",
						"disk" => "20GB" ),

			"tier2" => array(
						"ram"  => "1024",
						"cpu"  => "2",
						"disk" => "50GB"),

			"tier3" => array(
						"ram"  => "2048",
						"cpu"  => "2",
						"disk" => "100GB"),

			"tier4" => array(
						"ram"  => "4096",
						"cpu"  => "2",
						"disk" => "150GB")			

			);
		#Retornamos la informacion
		return $this->profile[$name];
	}

}
