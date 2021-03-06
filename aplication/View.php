<?php
class View
{
	/**
	* @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 * 
	 * Class view class that holds the elements that are necesaries to load the views
	 * @var object _controlador that holds the controller to evoke
	 * @var object _metodo that holds the method to evoke
	 **/
	private $_controlador;
	private $_metodo;

	public function __construct(Request $peticion){
		$this->_controlador = $peticion->getControlador();
		$this->_metodo = $peticion->getMetodo();
	}

	public function renderizar($vista){
	/**
	 * Function that contains the elements of the view
	 * @param  string $vista holds the name of the view
	 * @return void
	 */
		$_layoutParams = array(
				'ruta_css'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/css/',
				'ruta_img'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/img/',
				'ruta_js'=> APP_URL.'views/layouts/'.DEFAULT_LAYOUT.'/js/'
			);

		$rutaView = ROOT.'views'.DS.$this->_controlador.DS.$vista.'.phtml';

		if ($this->_metodo=='login') {
			$layout = 'login';
		}else{
			$layout = DEFAULT_LAYOUT;
		}

		/**
		 * Corroborate that the root can be read and the internal code has no mistakes
		 */
		if(is_readable($rutaView)){
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'header.php';
			include_once $rutaView;
			include_once ROOT.'views'.DS.'layouts'.DS.$layout.DS.'footer.php';
		}else{
			throw new Exception("Error de vista");
		}
	}
}