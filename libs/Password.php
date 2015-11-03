<?php
	/**
	 * @author Karen Hernández <karhega@gmail.com>
	 * @version 1.0
	 * @copyright karhega 2015
	 **/
/*
* Class to manage passwords
*
*/
class Password{
	
	public function __construct(){
		$this->checkBlowfish();
	}
	/**
	* checkblowfish checks the codification algorythm
	* @return void 
	*/
	private function checkBlowfish(){
		if (!defined("CRYPT_BLOWFISH") && !CRYPT_BLOWFISH) {
			echo "Algoritmo Blowfish no roportado";
			die();
		}
	}
	/**
	 * getpassword is a method to generate the hash of passwords
	* @param  string $password base password to generate the hash 
	* @return string hash of passwords generated
	*/

	public function getPassword($password, $dig = 7){
		$set_salt = './1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$salt = sprintf('$2a$%02d$', $dig);
		for ($i=0; $i < 22; $i++) { 
			$salt .= $set_salt[mt_rand(0, 22)];
		}

		return crypt($password, $salt);
	}

	public function isValid($pass1, $pass2){
		if (crypt($pass1, $pass2) == $pass2) {
			return true;
		}
		
		return false;	
	}
	/**
	* passwordverify description of the verifications of passwords
	* @param  string $pass1 hash to compare from 
	* @param  string $pass2 hash base
	* @return boolean    
	*/
	public function passwordVerify($pass1, $pass2){
		if (password_verify($pass1, $pass2)) {
			return true;
		}
		return false;
	}
}