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
		
		if ($objnode) {
			$objnode->appendChild($this->objnode);
		}
	}
	
	
}
?>
