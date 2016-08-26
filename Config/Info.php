<?php

namespace Config;

class info {

	private $vmname;
	private $cpu;
	private $ram;
	private $disk;
	private $image_name;

	public function set($atributo,$contenido)
	{
		$this->$atributo = $contenido;
	}

	public function get($atributo)
	{
		return $this->$atributo;
	}

}