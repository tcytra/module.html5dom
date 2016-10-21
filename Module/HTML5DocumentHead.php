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
	 *  javascript()
	 *  Add a document <script> tag and attributes to the html5 node tree
	 *  
	 *  @param  string	$src
	 *  @return object  HTML5DocumentHead
	 *  @access public
	 */
	public function javascript($src)
	{
		/** @todo Perform a check on this $src */
		
		$node = $this->domobj->createElement("script");
		
		$node->setAttribute("type", "text/javascript");
		$node->setAttribute("src", $src);
		
		$this->objnode->appendChild($node);
		
		return	$this;
	}
	
	/**
	 *  meta()
	 *  Add a document <meta> tag and attributes to the html5 node tree
	 *  
	 *  @param  array   $attr
	 *  @return object  HTML5DocumentHead
	 *  @access public
	 */
	public function meta($attr)
	{
		$node = $this->domobj->createElement("meta");
		
		foreach ($attr as $name=>$text) {
			$nameok	= preg_match("/^[a-z]+$/", $name);
			$textok = preg_match("/^[a-zA-Z][a-zA-Z0-9:;=-_\.,]/", $text);
			
			if ($nameok && $textok) { $node->setAttribute($name, $text); }
		}
		
		if ($this->objnode->getElementsByTagName("title")->length) {
			$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("title")->item(0));
		} else {
			$this->objnode->appendChild($node);
		}
		
		return	$this;
	}
	
	/**
	 *  stylesheet()
	 *  Add a document <link> tag and attributes to the html5 node tree
	 *  
	 *  @param  string	$href
	 *  @return object  HTML5DocumentHead
	 *  @access public
	 */
	public function stylesheet($href)
	{
		/** @todo Perform a check on this $href */
		
		$node = $this->domobj->createElement("link");
		
		foreach (["rel"=>"stylesheet","type"=>"text/css"] as $name=>$text) { $node->setAttribute($name, $text); }
		
		$node->setAttribute("href", $href);
		
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
