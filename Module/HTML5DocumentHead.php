<?php
/**
 *  HTML5DocumentHead
 *  
 *  This object provides the ability to create, identify, and manipulate the
 *  + document head elements distinctly.
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *	@version    0.1.1 HTML5DocumentHead.php 2016-10-13
 *	@since      system-0.5.1
 */
class HTML5DocumentHead
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
	 *  Add a document META tag and attributes to the html5 node tree
	 *  
	 *  @param  array   $attr
	 *  @return object  HTML5DocumentHead
	 *  @access public
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
	 *  Add the document TITLE tag to the html5 node tree
	 *  
	 *  @param  string  $text
	 *  @param  int	    $append = 0
	 *  @param  string  $join = null
	 *  @return object  HTML5DocumentHead
	 *  @access public
	 */
	public function title($text, $append = 0, $join = null)
	{
		$append = ($append == -1) ? -1 : 1;
		$search = $this->objnode->getElementsByTagName("title");
		
		if ($search->length) {
			$node = $this->objnode->getElementsByTagName("title")->item(0);
			
			if ($append) {
				$join = strlen($join) ? preg_replace("/\s+/", " ", " ".substr($join, 0, 1)." ") : "";
				$text = ($append < 0) ? $text.$join.$node->textContent : $node->textContent.$join.$text;
			}
			
			$node->textContent = $text;
			
		} else {
			$node = $this->domobj->createElement("title", $text);
			
			$this->objnode->appendChild($node);
		}
		
		return	$this;
	}
	
}
?>
