<?php
function validate($type, $value, $compare_value = "") {
	switch($type){
		case "username":
			if(check_username($value) || strlen($value) < 3)
				return false;
			break;
		case "email":
			$regexp="/^[a-z0-9]+([_+\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";    
			if (!preg_match($regexp, $value))
				return false;
			break;
		case "empty":
			if (empty($value) || strlen($value) <= 0)
				return false;
			break;
		case "compare":
			if($value != $compare_value)
				return false;
			break;
	}
	return true;
}
?>