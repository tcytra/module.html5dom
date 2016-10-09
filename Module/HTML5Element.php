<?php
/**
 *  Class	HTML5Element
 *  Extends	HTML5Document
 *  
 *  This class provides the ability to create and manipulate an HTML5Element
 *  HTML5Element serves as a wrapper interface for the PHP DOMElement object
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.1.3 class.html5.element.php 2016-09-21
 *  @since		system-0.5.1
 */
class HTML5Element extends HTML5Document
{
	//  DOMDocument Objects
	
	/** @var object	$domobj   The DOMDocument instance of DOMImplementation */
	private	$domobj;
	/** @var object $domnode  The parent DOMElement node; <html>,<body>,etc */
	private $domnode;
	/** @var object $objnode  The target DOMElement node; <div> by default */
	private $objnode;
	
	//  HTML5Element Objects
	
	/** @var object $parent   The parent HTML5 object appending an element */
	private	$parent;
	
	/**
	 * __construct()
	 *  Create an instance of the HTML5Element
	 *  
	 *  @param	object	$parent
	 *  @param	object	$objnode = null
	 */
	public function __construct($parent, $objnode = null)
	{
		$this->parent   = $parent;
		$this->domobj	= $parent->domobject();
		$this->domnode	= $parent->domnode();
		$this->objnode  = $objnode;
	}
	
	//  HTML5Element Manipulation
	
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
		//  create the new DOMElement
		$this->objnode = $this->domobj->createElement($nodename);
		
		//echo $this->objnode->nodeName;
		//exit;
		
		//  append the new DOMElement to the target node element
		$this->domnode->appendChild( $this->objnode );
		
		return	$this;
	}
}
?>
