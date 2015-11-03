<?php
/**
	* @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 * 
	 * Class Request, class that sanitizes the url y define the controler and methods to execute
	 * @param string $_controlador puts the content in lowercase
	 * @param string $_method puts the content in lowercase
	 * @param string $_argumentos redirects the arguments to url
	 **/
class Request{
	private $_controlador;
	private $_metodo;
	private $_argumentos;

	public function __construct(){
		if (isset($_GET['url'])) {
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);

			$this->_controlador = strtolower(array_shift($url));
			$this->_metodo = strtolower(array_shift($url));
			$this->_argumentos = $url;
		}

		if (!$this->_controlador) {
			$this->_controlador = DEFAULT_CONTROLLER;
		}

		if (!$this->_metodo) {
			$this->_metodo = 'index';
		}

		if (!$this->_argumentos) {
			$this->_argumentos = array();
		}

	}
	/**
	 * Defins the controller
	 * @return object _controlador that holds the controller to evoke
	 **/
	public function getControlador(){
		return $this->_controlador;
	}
	/**
	 * Defins the method
	 * @return object _metodo that holds the method to evoke
	 **/
	public function getMetodo(){
		return $this->_metodo;
	}
	/**
	 * Defins the arguments
	 * @return object _arguments that holds the arguments to evoke
	 **/
	public function getArgs(){
		return $this->_argumentos;
	}


}
