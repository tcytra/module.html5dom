<?php
/**
 *  Html5Element
 *  
 *  This object provides the ability to create and manipulate a PHP DomElement
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.1.5 Html5Element.php 2016-09-21
 *  @since		html5-0.0.1
 */
class Html5Element extends Html5
{
	//  DomDocument Objects
	
	/** @var object $domnode  The parent DomElement node; <html>,<body>,etc */
	private $domnode;
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Element
	 *  
	 *  @param  object  $parent
	 *  @param  object  $objnode = null
	 */
	public function __construct($parent, $objnode = null)
	{
		//$this->parent   = $parent;
		$this->domobj	= $parent->domobject();
		$this->domnode	= $parent->domnode();
		$this->objnode  = $objnode;
	}
	
	//  Html5Element Manipulation
	
	/**
	 *  attribute()
	 *  Get or set an attribute value by name
	 *  
	 *  @param  string  $name
	 *  @param  string  $value = null
	 *  @return string|object
	 */
	public	function attribute($name, $value = null)
	{
		if ($value) {
			$this->objnode->setAttribute($name, $value);
			
			//  the id attribute must be explicitly set in order to getElementById
			if ($name == "id") { $this->objnode->setIdAttribute($name, true); }
			
			return $this;
		}
		else
		if ($this->objnode->hasAttribute($name)) { return $this->objnode->getAttribute($name); }
	}
	
	/**
	 *  create()
	 *  @param  type    $nodename
	 *  @access public
	 */
	public function create($nodename)
	{
		//  create the new DomElement
		$this->objnode = $this->domobj->createElement($nodename);
		
		//echo $this->objnode->nodeName;
		//exit;
		
		//  append the new DomElement to the target node element
		$this->domnode->appendChild( $this->objnode );
		
		return	$this;
	}
}
?>
