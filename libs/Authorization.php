<?php
/**
 * Clase Authorization
 * 
 * Class that validate sthe users in the system
 *  @author Karen Hernández <karhega@gmail.com>
 * @version 1.0
 * @copyright karhega 2015
 */
class Authorization{
	
	/**
	 * logged Method 
	 * 
	 * Method that works to prove that the user has logged in the system
	 * @return  void no regresa ningún valor
	 */
	static function logged(){
		
		if(!isset($_SESSION)){
			session_start();
		}
		if(!$_SESSION['logged']){
		    header("Location: ".APP_URL."usuarios/login");
		    exit;
		}
	}

	/**
	 * login Method 
	 * 
	 * Method tha allows the user to log session in the system
	 * @param  $user array with the data of the user
	 * @return  void doesnt return any value
	 */
	public function login($user){
		session_start();
		$_SESSION['logged'] = true;
	    $_SESSION['username'] = $user["username"];
	    $_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;
	}	
	
	/**
	 *  logout Method
	 * 
	 * Method that ends the users session
	 * 
	 */
	public function logout(){
		// remove all variable session 
		session_unset();

		// destroy the session
		session_destroy();
		echo"<script type='text/javascript'>
		     alert('Ha salido correctamente');
		    window.location='".APP_URL."usuarios/login';
		    </script>";
	}
}