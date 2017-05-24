<?php defined('BASEPATH') || exit('No direct script access allowed');
class Calculation extends CI_Model
{
	private $roman_num=array('I' => 1,'V' => 5,'X' => 10,'L' => 50,'C' => 100,'D' => 500,'M' => 1000);
	function match_roman_to_number($num){
		$num_roma = 0;
		$last_val = null;

		for($i=strlen($num)-1; $i >= 0; --$i ) { // i am looping reverse
		$curr = $num[$i];
		if ( is_null($last_val) ) { // checking weather is first time
		    $num_roma += $this->roman_num[$num[$i]];
		} else {
		    $num_roma += $this->roman_num[$last_val] > $this->roman_num[$curr] ? -$this->roman_num[$curr] : +$this->roman_num[$curr]; // first value is greater than second then (-) or (+)
		}
		$last_val = $curr; //assign to last variable
		}
		return $num_roma; // returning total number
	}
	function calculator($num1,$num2,$operator){

		if($operator=="+"){
			$output=$this->match_roman_to_number($num1)+$this->match_roman_to_number($num2);
		}else if($operator=="-"){
			$output=$this->match_roman_to_number($num1)-$this->match_roman_to_number($num2);
		}else if($operator=="/"){
			$output=$this->match_roman_to_number($num1)/$this->match_roman_to_number($num2);
		}else if($operator=="*"){
			$output=$this->match_roman_to_number($num1)-$this->match_roman_to_number($num2);
		}
		return $this->romanic_number($output);
	}
	function romanic_number($given_num, $upcase = true) 
	{ 
 		 $result = '';
 		 $num='';
	 	foreach($this->roman_num as $roman => $value){
			if($value<=$given_num){
				$num[$roman]=$value; // getting all values less than the given integer
			}
		}
	 	$matched_key = array_search($given_num, $num); //checking only single number and its mattching any on the roman array
	 	if(isset($matched_key) && $matched_key!=''){
	 		$result=$matched_key;
	 	}else{
	
	 		while ($given_num > 0) {
	 			$matches = intval($given_num/max($num));
	 			$matched_key = array_search(max($num), $num);
  				$result .= str_repeat($matched_key,$matches);
  				$given_num = $given_num % max($num);
  				unset($num[$matched_key]);
  			}
	 	}
  		return $result;
	} 
}