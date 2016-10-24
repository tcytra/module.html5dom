<?php
/**
 *  Html5
 *  
 *  This object is the parent instance in the Html5 object model and contains
 *  + the top level configuration and dom references and interaction
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.1.2 Html5.php 2016-10-21
 *  @since      Html5-0.0.7
 */
class Html5
{
	//  Html5 Document Parameters
	
	/** @var string $charset  The specified character set for the output */
	public	static	$charset	= "utf-8";
	/** @var string $language The specified language encoding for the output */
	public	static	$language	= "en-US";
	
	//  Local Object Parameters
	
	/** @var string $objtype  The instance type of this object is parent */
	public		$objtype	= "parent";
	
	//  PHP DomDocument Objects
	
	/** @var object $parent   The parent object instance */
	private		$parent;
	/** @var object @target   The parent object target element */
	private		$target;
	
	/**
	 * __construct()
	 *  Create an instance of the Html5 object
	 *  
	 *  @param  array  $config = null
	 */
	public function __construct($config = null)
	{
		//  cycle the provided configuration into the configure method
		if ($config && is_array($config)) {
			foreach ($config as $index=>$value) { $this->configure($index, $value); }
		}
	}
	
	//  Private Methods
	
	/**
	 *  configure()
	 *  Set a configuration value for this object by specified index
	 *  
	 *  @param  string  $index
	 *  @param  string  $value
	 *  @access private
	 */
	private	function configure($index, $value)
	{
		//  evaluate and execute the configuration change, if possible
		switch ($index) {
			case 'charset':
				if (self::isValid("charset", $value)) { self::$charset = $value; }
				break;
			case 'language':
				if (self::isValid("language", $value)) { self::$language = $value; }
				break;
		}
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
	 *  with()
	 *  Import the with argument into the object node
	 *  
	 *  @param  string  $with
	 *  @return object
	 *  @access public
	 */
	public function with($with)
	{
		//  create a temporary instance of the DomDocument object
		$domimp = new DOMImplementation;
		$domdtd = $domimp->createDocumentType("html", null, null);
		$domobj = $domimp->createDocument("", "", $domdtd);
		
		//  import the provided html into the temporary DomDocument
		@$domobj->loadHTML("<div>{$with}</div>");
		
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
				$valid = preg_match("/^[a-z]{2}_[A-Z]{2}$/", $value);
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
