<?php 

namespace Config;

include ('RemoteCommand.php');

class Predefinido {

	private $set;
	private $objeto;
	private $visaje;
	private $otrovisaje;
	private $comand;

	
	public function __construct()
	{
		$this->comand = new RemoteCommand;
	}
	
	/*
	Esta funcion se encarga de ejecutar comandos en el servidor
	remoto que contiene el hypervisor.
	*/

	public function query($query)
	{
		$this->comand->add('user','root');
		$this->comand->add('host','192.168.1.200');
		$this->comand->add('key','/usr/local/www/data/cloud_manager/llaves');
		$this->comand->add('command',$query);
		$impreso =  $this->comand->exeggutor();
		return $impreso;
				
	} 

/*
	Esta funcion recibe como parametro $descripcion
	y esta variable es un array
	$descripcion = array(
	'host' => 'nombre_maquina',
	'old' => 'maquina_base',
	'new' => 'nombre_nuevo',
	'hostname' => 'FQDN name',
	'ipv4' => 'Pool DHCP'
	);

	la funcion sirve para clonar maquinas virtuales cbsd
	*/

	public function clonevm($descripcion){

		$query = 'cbsd jclone old=' . $descripcion['old'] . ' new=' . $descripcion['new'] . ' host_hostname='.$descripcion['hostname'].' ip4_addr=' . $descripcion['ipv4'] . '';
		$resul = $this->query($query);
		return $resul;

	}

	/*
	esta funcion sirve para eliminar las maquinas virtuales cbsd
	*/

	public function deletevm($descripcion){
		$query = 'cbsd jremove '.$descripcion['new'].'';
		$resul = $this->query($query);
		return $resul;
	}

	/*
	esta funcion inicia las maquinas virtuales existentes
	*/

	public function startvm($descripcion){
		$query = 'cbsd jstart ' . $descripcion['new'] . '';
		$resul = $this->query($query);
		return $resul;
	}

	/*
	esta funcion detiene las maquinas virtuales
	*/	

	public function stopvm($descripcion){
		$query = 'cbsd jstop ' . $descripcion['new'] . '';
		$resul = $this->query($query);
		return $resul;
	}

}







