<?php
/**
 * 
 */
class HTML5DocumentHead extends HTML5Document
{
	/** @var object	$domobj   The DOMDocument instance of DOMImplementation */
	private	$domobj;
	
	/** @var object $objnode  The DOMDocument "head" node */
	private $objnode;
	
	/**
	 * __construct()
	 *  Create an instance of the HTML5DocumentHead
	 */
	function __construct($parent, $objnode = null)
	{
		$this->domobj	= $parent->domobject();
		
		$this->objnode	= $this->domobj->createElement("head");
		
		if (HTML5Dom::$charset) {
			$this->meta(["charset"=>HTML5Dom::$charset]);
		}
		
		if ($objnode) {
			$objnode->appendChild($this->objnode);
		}
	}
	
	/**
	 *  meta()
	 *  
	 *  @param  array|object $attr
	 */
	public function meta($attr)
	{
		$node = $this->domobj->createElement("meta");
		
		foreach ($attr as $name=>$text) {
			if (preg_match("/^[a-z]+$/", $name)) { $node->setAttribute($name, $text); }
		}
		
		$this->objnode->appendChild($node);
		
		return	$this;
	}
	
	/**
	 *  title()
	 *  Add the document title tag to the html5 node tree
	 *  + 0 (Default) will overwrite, 1 will append, -1 will prepend
	 *  
	 *  @param  string  $text
	 *  @param  int	    $append = 
	 */
	public function title($text, $append = 0)
	{
		$search = $this->objnode->getElementsByTagName("title");
		
		if (!$search->length) {
			$node = $this->domobj->createElement("title", $text);
			//echo $node->textContent;exit;
			$this->objnode->appendChild($node);
		}
		
		//$exists = ($search->length) ? 1 : 0;
		//$node = ($exists) ? $search[0] : $this->domobj->createElement("title");
		
		return	$this;
	}
	
}
?>
