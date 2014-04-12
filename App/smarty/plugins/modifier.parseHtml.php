<?php


function smarty_modifier_parseHtml($string) {
	$string = str_replace(array("\r\n", "\n", "\r"), array("<br />", "<br />", "<br />"), $string);
	$string = strip_tags($string, "<br><p><a><b><i><u><strong><strike>");
	return $string;
}