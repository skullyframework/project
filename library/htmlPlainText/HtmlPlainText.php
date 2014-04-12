<?php

libxml_use_internal_errors(true);

class HtmlPlainText {
	public $originalContent = '';
	public $plainText = '';

	private $doc;
	private $enterTag = array('div', 'p', 'br', 'li');

	function __construct($originalContent) {
		$this->originalContent = $originalContent;
		$this->convertToPlainText();
	}

	function convertToPlainText($originalContent = ''){
		if(!empty($originalContent))$this->originalContent = $originalContent;

		$this->doc = new \DOMDocument('4.0', 'UTF-8');
		$this->doc->loadHtml('<?xml encoding="UTF-8">' . $this->originalContent);
		$this->doc->encoding = 'UTF-8';
		$this->plainText = "";

		$this->iterateChild($this->doc->getElementsByTagName("body")->item(0));
//		error_log("plainText : " . $this->plainText);
	}

	function iterateChild($node){
		$hasText = false;

		if(empty($node))return false;

		if($node->tagName == 'br'){
			$this->plainText .= "\n";
		}
		else{

			if($node->tagName == 'li'){
				$this->plainText .= '  * ';
			}

			for($i=0; $i<$node->childNodes->length; $i++){
				if(get_class($node->childNodes->item($i)) == 'DOMText'){
					//				error_log("DOMText : " . $node->childNodes->item($i)->nodeValue);
					$hasText = true;
					$this->plainText .= $node->childNodes->item($i)->nodeValue;
				}
				else
					$hasText = $this->iterateChild($node->childNodes->item($i));
			}

			if($hasText) if(in_array($node->tagName, $this->enterTag)){ $this->plainText .= "\n"; $hasText = false;}
		}

		return $hasText;
	}
}