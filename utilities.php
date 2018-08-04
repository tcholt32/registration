<?php
function esc($string){
	return trim(htmlspecialchars($string, ENT_COMPAT, 'UTF-8'));
}
function checkAllLetters($string){
	return ctype_alpha(str_replace(' ', '', $string));
}
function checkAllNumbers($string){
	return is_numeric($string);
}
function checkAllNumbersLetters($string){
	return ctype_alnum(str_replace(' ', '', $string));
}
?>