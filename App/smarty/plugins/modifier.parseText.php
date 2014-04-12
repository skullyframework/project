<?php


function smarty_modifier_parseText($string) {
	$string = str_replace('"', '', $string);
	return strip_tags($string);
}