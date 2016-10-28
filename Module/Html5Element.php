<?php
/**
 *  Html5Element
 *  
 *  This object provides the ability to create and manipulate a PHP DomElement
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.1.7 Html5Element.php 2016-09-21
 *  @since		html5-0.0.1
 */
class Html5Element extends Html5
{
	//  Local Object Parameters
	
	/** @var object $objnode  The local target PHP DomElement reference */
	protected	$objnode;
	/** @var string $objtype  The instance type of this object is element */
	public		$objtype	= "element";
	
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
			case 'parent':
				$this->domobj = $value->domobject();
				break;
			case 'target':
				$this->target = $value;
				break;
		}
	}
	
	//  Public Methods
	
	/**
	 *  create()
	 *  Create a DOMDocument element and append to the parent, with content if provided
	 *  
	 *  @param  string  $construct
	 *  @param  string  $with = null
	 *  @return object  Html5Element
	 *  @access public
	 */
	public function create($construct, $with = null)
	{
		//  create an instance of the HTML5Contructor object
		$this->construct = HTML5Construct::Set($construct);
		
		//  create a DomElement for this instance of the Html5Element, if able
		if ($this->construct->able()) {
			//  create the new DomElement
			$this->objnode = $this->domobj->createElement($this->construct->name);
			
			//  add a provided class attribute to the DomElement
			if ($this->construct->class) { $this->classAdd($this->construct->class); }
			
			//  add a provided id attribute to the DOMElement
			if ($this->construct->id && !$this->domobj->getElementById($this->construct->id)) {
				$this->setId($this->objnode, $this->construct->id);
			}
			
			//  append the new DomElement to the target node element
			$this->target->appendChild( $this->objnode );
			
			//  execute any provided $with arguments
			if ($with) { $this->with($with); }
		}
		
		return $this;
	}
}
?>
