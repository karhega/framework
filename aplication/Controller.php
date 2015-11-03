<?php

abstract class Appcontroller
{
	/**
	 * @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 * 
	 * @param string $_view protected attribit of the class
	 * @param string $db object of the class PDO
	 **/
	protected $_view;
	protected $db;

	abstract public function index();

	public function __construct(){
		$this->_view = new View(new Request);
		$this->db = new classPDO();
	}
	protected function set($name = null, $value=array()){
		$GLOBALS[$name] = $value;
	}
	/**
	 *  helps redirect files
	 * @param array $url contains the parameters to redirect
	 * @var string  $path variable that stores the complete root of the redirection
	 * 
	 **/
	protected function redirect($url = array()){
		$path = "";

		if ($url['controller']) {
			$path .= $url['controller'];
		}
		if ($url['action']) {
			$path .= "/".$url['action'];
		}
		header("location: ".APP_URL.$path);

	}

}
