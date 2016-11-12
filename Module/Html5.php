<?php
/**
 *  Abstract
 *  Class       Html5
 *  
 *  This object is the parent instance in the Html5 object model and contains
 *  + the top level configuration and dom references and interaction
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.3 Html5.php 2016-10-21
 *  @since      Html5-0.0.7
 */
abstract class Html5
{
	//  Html5 Global Parameters
	
	/** @var string $charset  The specified character set for the output */
	public	static	$charset	= "utf-8";
	/** @var string $language The specified language encoding for the output */
	public	static	$language	= "en";
	
	//  Html5 Object Parameters
	
	/** @var string $objtype  The instance type of this object is parent */
	public		$objtype	= "parent";
	
	//  Html5 Objects
	
	/** @var object $parent   The parent object instance */
	protected	$parent;
	/** @var object @target   The parent object target element */
	protected	$target;
	
	//  PHP DomDocument Objects
	
	/** @var object $domdtd   The definition of the HTML DOM DocumentType */
	private		$domdtd;
	/** @var object $domimp   The DomImplementation of DOM DocumentType */
	private		$domimp;
	/** @var object	$domobj   The DomDocument instance of DomImplementation */
	protected	$domobj;
	/** @var object $domnode  The documentElement node, <html> element */
	protected	$domnode;
	
	//  DomDocument Implementation
	
	/**
	 *  implement()
	 *  Create an instance of the DomImplementation for this Html5Document
	 *  
	 *  @access	protected
	 */
	protected function implement()
	{
		//  the Html5Document will auto-implement an HTML doctype
		$rootnode = ($this->objtype == "document") ? "html" : "";
		
		//  create an instance of the PHP DomImplementation
		$this->domimp = new DOMImplementation;
		
		//  declare the doctype
		$this->domdtd = $this->domimp->createDocumentType("html", null, null);
		
		//  create the document object
		$this->domobj = $this->domimp->createDocument("", $rootnode, $this->domdtd);
		
		//  format the document parameters
		$this->domobj->formatOutput = true;
		$this->domobj->preserveWhiteSpace = true;
		$this->domobj->encoding	= strtoupper( self::isValid("charset", Html5::$charset) ? Html5::$charset : "utf-8" );
	}
	
	//  Secure Methods
	
	/**
	 *  configure()
	 *  Set a configuration value for this object by specified index
	 *  
	 *  @param  string  $index
	 *  @param  string  $value
	 *  @access protected
	 */
	protected function configure($index, $value)
	{
		//  evaluate and execute the configuration change, if possible
		switch ($index) {
			case 'charset':
				if (self::isValid("charset", $value)) { self::$charset = $value; }
				break;
			case 'language':
				if (self::isValid("language", $value)) { self::$language = $value; }
				break;
			case 'object':
				$this->objnode = $value;
				break;
			case 'parent':
				$this->domobj = $value->domobject();
				$this->parent = $value;
				break;
			case 'target':
				$this->target = $value;
				break;
		}
		
		//  ensure this config argument is removed to prevent reapplication
		$this->unsetconfig($index);
	}
	
	/**
	 *  unsetconfig()
	 *  Unset a configuration value for this object, if the index exists
	 *  
	 *  @param  string  $index
	 *  @access protected
	 */
	protected function unsetconfig($index)
	{
		//if (is_array($this->config) && array_key_exists($index, $this->config)) {
			unset($this->config[ $index ]);
		//}
	}
	
	//  Public Methods
	
	/**
	 *  append()
	 *  Create and return a DomElement with the specified nodename
	 *  
	 *  @param  string  $construct
	 *  @param  string  $with = null
	 *  @return object
	 *  @access	public
	 */
	public function append($construct, $with = null)
	{
		//  create a new instance of the Html5Element and create the element
		$element = new Html5Element(['parent'=>$this, 'target'=>$this->objnode]);
		$element->create($construct, $with);
		
		//  return the instance of the Html5Element
		return	$this;
	}
	
	/**
	 *  attribute()
	 *  Get or set an attribute value by name
	 *  
	 *  @param  string  $name
	 *  @param  string  $value = null
	 *  @return string|object
	 */
	public function attribute($name, $value = null)
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
	 *  classAdd()
	 *  Add the provided classname(s) to the element class attribute
	 *  
	 *  @param  string  $className
	 *  @return object
	 *  @access public
	 */
	public function classAdd($className)
	{
		//  retrieve a list of existing classes
		$list = ($class = $this->attribute("class")) ? explode(" ", $class) : array();
		
		//  exlode the list of classes to add
		$className = explode(" ", trim(str_replace(".", " ", $className)));
		
		//  add non existing classes to the list
		foreach ($className as $each) {
			if (!in_array($each, $list)) { $list[] = $each; }
		}
		
		//  implode the list into the attribute
		$this->attribute("class", implode(" ", $list));
		
		return $this;
	}
	
	/**
	 *  find()
	 *  Return a list of nodes matching the provided construct argument
	 *  
	 *  @param  string  $construct
	 *  @return object  Html5Search
	 *  @access public
	 */
	public function find($construct)
	{
		$search = new Html5Search($this);
		$search->find($construct);
		
		return $search;
	}
	
	/**
	 *  html()
	 *  Import the argument into the object node; replace existing text/html
	 *  
	 *  @param  string  $with
	 *  @param  bool    $clear = true
	 *  @return object
	 *  @access public
	 */
	public function html($with, $clear = true)
	{
		//  remove any existing structure from this objectnode
		if ($clear) {
			while ($this->objnode->childNodes->length) {
				$this->objnode->removeChild( $this->objnode->childNodes->item(0) );
			}
		}
		
		//  create a temporary instance of the DomDocument object
		$domimp = new DOMImplementation;
		$domdtd = $domimp->createDocumentType("html", null, null);
		$domobj = $domimp->createDocument("", "", $domdtd);
		
		//  import the provided html into the temporary DomDocument
		//  *** todo: this needs a try/catch into error reporting
		$domobj->loadHTML("<div>{$with}</div>");
		
		//  retrieve the imported nodes from the DomDocument
		$nodes  = $domobj->getElementsByTagName('div')->item(0)->childNodes;
		
		//  import the retrieved nodes into the Html5Element instance element
		foreach($nodes as $node)
		{
			$node = $this->domobj->importNode($node, true);
			
			if (($node->nodeType == 1) && $node->hasAttribute("id")) { $node->setIdAttribute("id", true); }
			
			$this->objnode->appendChild($node);
		}
		
		//  return this instance of the Html5 object
		return  $this;
	}
	
	/**
	 *  setId()
	 *  Add the provided id to this element id attribute
	 *  
	 *  @param  string  $node
	 *  @param  string  $id
	 *  @return object
	 *  @access public
	 */
	public function setId($node, $id)
	{
		$node->setAttribute("id", $id);
		$node->setIdAttribute("id", true);
		
		return $this;
	}
	
	//  Html5Document DOM References
	
	/**
	 *  domobject()
	 *  Return the DomDocument object for this instance
	 *  
	 *  @return	object
	 *  @access	public
	 */
	public function domobject()
	{
		return $this->domobj;
	}
	
	public function objectnode()
	{
		return $this->objnode;
	}
	
	//  Global Methods
	
	/**
	 *  isValid()
	 *  @param  string  $type
	 *  @param  string  $value
	 *  @return bool
	 *  @access global
	 */
	public static function isValid($type, $value)
	{
		$valid = false;
		
		switch (strtolower($type)) {
			case 'attribute':
				$valid = preg_match("/^[a-z][a-z0-9-]+$/", $value);
				break;
			case 'charset':
				$valid = preg_match("/^[a-z][a-z0-9-]+[0-9]{1}$/", $value);
				break;
			case 'language':
				$valid = preg_match("/^[a-z]{2}(-[A-Z]{2})?$/", $value);
				break;
			case 'nodename':
				$valid = preg_match("/^[a-z]+$/", $value);
				break;
			case 'title':
				$valid = preg_match("", $value);
				break;
		}
		
		return $valid;
	}
}
