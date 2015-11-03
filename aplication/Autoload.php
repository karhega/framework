<?php
	/**
	 * @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 * @param string $name contain the name of the library
	 * @return void
	 **/
	function __autoload($name){
		require_once(ROOT."libs".DS.$name.".php");
	}


?>