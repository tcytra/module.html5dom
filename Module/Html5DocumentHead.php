<?php
/**
 *  Class       Html5DocumentHead
 *  Extends     Html5Document
 *  
 *  This object provides the ability to create, identify, and manipulate the
 *  + document head elements distinctly.
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.1 Html5DocumentHead.php 2016-10-13
 *  @since      html5-0.0.6
 */
class Html5DocumentHead extends Html5Document
{
	//  Local Object Parameters
	
	/** @var object $objnode  The local target PHP DomElement reference */
	protected	$objnode;
	/** @var string $objtype  The instance type of this object is documenthead */
	public		$objtype	= "documenthead";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5DocumentHead
	 */
	function __construct($config = null)
	{
		//  pass the configuration to the parent constructor
		parent::__construct($config);
	}
	
	//  Secure Methods
	
	/**
	 *  implement()
	 *  Prevent an implementation attempt for the Html5DocumentHead
	 *  
	 *  @access	protected
	 */
	protected function implement()
	{ /* do nothing */ }
	
	//  Public Methods
	
	/**
	 *  create()
	 *  Create the document <head> tag and append to the parent target
	 */
	public function create()
	{
		$this->objnode	= $this->domobj->createElement("head");
		
		if (Html5::$charset) {
			$this->meta(["charset"=>Html5::$charset]);
		}
		
		$this->target->appendChild($this->objnode);
	}
	
	/**
	 *  favicon()
	 *  Add a document <link> tag and attributes for the icon to the node tree
	 *  
	 *  @param  string  $href = "/favicon.png"
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function favicon($href = "/favicon.png")
	{
		$node = null;
		
		//  detect an existing icon <link> tag and remove the href attribute
		foreach ($this->objnode->getElementsByTagName("link") as $each) {
			if ($each->hasAttribute("rel") && preg_match("/icon/", $each->getAttribute("rel"))) {
				$node = $each;
				$node->removeAttribute("href");
				break;
			}
		}
		
		//  otherwise create an icon <link> tag without the href attribute
		if (!$node) {
			$node = $this->domobj->createElement("link");
			$node->setAttribute("rel", "icon");
			
			//  ensure the icon <link> is appended after the <title> element
			if ($this->objnode->getElementsByTagName("title")->length) {
				$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("title")->item(0)->nextSibling);
			} else
			if ($this->objnode->getElementsByTagName("link")->length) {
				$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("link")->item(0));
			} else {
				$this->objnode->appendChild($node);
			}
		}
		
		//  finally, add the link href
		$node->setAttribute("href", $href);
		
		return $this;
	}
	
	/**
	 *  javascript()
	 *  Add a document <script> tag and attributes to the html5 node tree
	 *  
	 *  @param  string  $src
	 *  @param  string  $code = null
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function javascript($src, $code = null)
	{
		/** @todo Perform a check on this $src */
		
		if ($code) {
			$node = $this->domobj->createElement("script", "\n{$code}\n");
			$node->setAttribute("type", "text/javascript");
			
		} else {
			$node = $this->domobj->createElement("script");
			
			//  append the stylesheet attributes to this <meta> tag
			$node->setAttribute("type", "text/javascript");
			$node->setAttribute("src", $src);
		}
		
		$this->objnode->appendChild($node);
		
		return	$this;
	}
	
	/**
	 *  meta()
	 *  Add a document <meta> tag and attributes to the Html5 node tree
	 *  
	 *  @param  array   $attr
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function meta($attr)
	{
		$node = $this->domobj->createElement("meta");
		
		//  append the requested attributes to this <meta> tag
		foreach ($attr as $name=>$text) {
			$nameok	= preg_match("/^[a-z]+$/", $name);
			/** @todo need a better textok or not at all */
			//$textok = preg_match("/^[a-zA-Z][a-zA-Z0-9:;=-_\.,]/", $text);
			
			if ($nameok) { $node->setAttribute($name, $text); }
		}
		
		//  ensure the <meta> tag is appended before the <title>, <link>, or <script> tags
		if ($this->objnode->getElementsByTagName("title")->length) {
			$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("title")->item(0));
		} else 
		if ($this->objnode->getElementsByTagName("link")->length) {
			$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("link")->item(0));
		} else
		if ($this->objnode->getElementsByTagName("script")->length) {
			$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("script")->item(0));
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
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function stylesheet($href)
	{
		/** @todo Perform a check on this $href */
		
		$node = $this->domobj->createElement("link");
		
		//  append the stylesheet attributes to this <meta> tag
		foreach (["rel"=>"stylesheet","type"=>"text/css"] as $name=>$text) { $node->setAttribute($name, $text); }
		
		//  append the href attribute with the source file
		$node->setAttribute("href", $href);
		
		//  ensure the stylesheet is appended before any <script> tags
		if ($this->objnode->getElementsByTagName("script")->length) {
			$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("script")->item(0));
		} else {
			$this->objnode->appendChild($node);
		}
		
		return	$this;
	}
	
	/**
	 *  title()
	 *  Add the document <title> tag to the html5 node tree
	 *  
	 *  @param  string  $text
	 *  @param  int	    $amend = 0
	 *  @param  string  $join = null
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function title($text, $amend = 0, $join = null)
	{
		$amend = (!$amend) ? 0 : (($amend === -1) ? -1 : 1);
		$title = $this->objnode->getElementsByTagName("title");
		
		//  check to see if the <title> is being appended or amended
		if ($title->length) {
			$node = $this->objnode->getElementsByTagName("title")->item(0);
			
			//  the argument is to amend the existing <title>
			if ($amend) {
				$join = strlen($join) ? preg_replace("/\s+/", " ", " ".substr($join, 0, 1)." ") : "";
				$text = ($amend < 0) ? $text.$join.$node->textContent : $node->textContent.$join.$text;
			}
			
			$node->textContent = $text;
			
		} else {
			$node = $this->domobj->createElement("title", $text);
			
			//  ensure the <title> is appended before the <link> and <script> tags
			if ($this->objnode->getElementsByTagName("link")->length) {
				$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("link")->item(0));
			} else
			if ($this->objnode->getElementsByTagName("script")->length) {
				$this->objnode->insertBefore($node, $this->objnode->getElementsByTagName("script")->item(0));
			} else {
				$this->objnode->appendChild($node);
			}
		}
		
		return	$this;
	}
	
}
?>
