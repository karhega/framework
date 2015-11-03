<?php
/**
 * Class Validation to validate the  data filter 
 * 
 * Collection of functions to validate the data filter, 
 * Colección de funciones para validar filtro de datos, ranks and values
 *  @author Karen Hernández <karhega@gmail.com>
 * @version 1.0
 * @copyright karhega 2015
 */
class Validations {
	
	/**
	 * Method isInt
	 * Determins if a number is valid, between a rank
	 * @param   $number number to evaluate 
	 * @param   $min_range value below the rank 
	 * @param   $max_range value above the rank
	 * @return  bool bolean value as a result of the validation
	 */
	public function isInt($number, $min_range = null, $max_range = null){
	/**
	 * rank of numbers
	 * @var array lo validate the options
	 */
		$options = array();

		if($min_range && $max_range){
			$options = array(
				array(
					"min_range"=>$min_range,
					"max_range"=>$max_range
				)	
			);
		}else{
			if($min_range){
				$options = array(
					array(
					"min_range"=>$min_range
					)	
				);
			}

			if($max_range){
				$options = array(
					array(
						"max_range"=>$max_range
					)	
				);
			}
		}
		if(filter_var($number, FILTER_VALIDATE_INT, $options)){
			return true;
		}
		return false;
	}

	public function isEmail($email){
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);

		/**
		 * Application of the filter
		 */
		if(filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
		}
		return false;
	}

	public function sanitizeText($string){
		$string = filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS);
		return $string;
	}
}

$filter = new Validations();
