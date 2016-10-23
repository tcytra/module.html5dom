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
	//  Local Object Parameters
	
	/** @var object $objnode  The local target PHP DomElement reference */
	private $objnode;
	/** @var string $objtype  The instance type of this object is element */
	public	$objtype	= "element";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Element
	 *  
	 *  @param  object  $config = null
	 */
	public function __construct($config = null)
	{
		//  cycle the provided configuration into the configure method
		if ($config && is_array($config)) {
			foreach ($config as $index=>$value) { $this->configure($index, $value); }
		}
		
		//  pass the remaining config to the parent constructor
		parent::__construct($config);
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
			case 'parent':
				$this->domobj = $value->domobject();
				break;
			case 'target':
				$this->target = $value;
				break;
		}
	}
	
	//  Html5Element Construct
	
	/**
	 *  create()
	 *  @param  string  $construct
	 *  @access public
	 */
	public function create($construct)
	{
		//  create an instance of the HTML5Contructor object
		$this->construct = HTML5Construct::Set($construct);
		
		//  create a DomElement for this instance of the Html5Element, if able
		if ($this->construct->able()) {
			//  create the new DomElement
			$this->objnode = $this->domobj->createElement($this->construct->name);
			
			//  add a provided class attribute to the DomElement
			if ($this->construct->class) { $this->addClass($this->construct->class); }
			
			//  add a provided id attribute to the DOMElement
			if ($this->construct->id && !$this->domobj->getElementById($this->construct->id)) { $this->setId($this->construct->id); }
			
			//  append the new DomElement to the target node element
			$this->target->appendChild( $this->objnode );
		}
		
		return $this;
	}
	
	//  Html5Element Attributes
	
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
	 *  addClass()
	 *  Add the provided classname(s) to the HTML5Element class attribute
	 *  
	 *  @param  string  $classname
	 *  @return object  Html5Element
	 *  @access public
	 */
	public	function addClass($classname)
	{
		//  retrieve a list of existing classes
		$list = ($class = $this->attribute("class")) ? explode(" ", $class) : array();
		
		//  exlode the list of classes to add
		$classname = explode(" ", trim(str_replace(".", " ", $classname)));
		
		//  add non existing classes to the list
		foreach ($classname as $each) {
			if (!in_array($each, $list)) { $list[] = $each; }
		}
		
		//  implode the list into the attribute
		$this->attribute("class", implode(" ", $list));
		
		return $this;
	}
	
	/**
	 *  setId()
	 *  Add the provided id to this Html5Element id attribute
	 *  
	 *  @param  string  $id
	 *  @return object  Html5Element
	 *  @access public
	 */
	public function setId()
	{
		$this->objnode->setAttribute("id", $this->construct->id);
		$this->objnode->setIdAttribute("id", true);
		
		return $this;
	}
	
}
?>
