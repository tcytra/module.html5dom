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
		$this->target->appendChild( $this->objnode );
		
		return	$this;
	}
}
?>
