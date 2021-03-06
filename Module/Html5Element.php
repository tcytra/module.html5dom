<?php
/**
 *  Class       Html5Element
 *  Extends     Html5
 *  
 *  This object provides the ability to create and manipulate a PHP DomElement
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.3 Html5Element.php 2016-09-21
 *  @since      html5-0.0.1
 */
class Html5Element extends Html5
{
	//  Html5Element Parameters
	
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
		//  the instance config will be passed to the parent object but first
		//  + any locally applicable configuration will be applied and stripped
		$this->config = $config;
		
		//  cycle the provided configuration into the configure method
		if ($this->config && is_array($this->config)) {
			foreach ($this->config as $index=>$value) { $this->configure($index, $value); }
		}
		
		//  pass the remaining config to the parent object for further evaluation
		//parent::__construct($this->config);
	}
	
	//  Secure Methods
	
	/**
	 *  implement()
	 *  Ensure the implement method is not invoked in Html5Element
	 *  
	 *  @access	protected
	 */
	protected function implement()
	{ /* do nothing */ }
	
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
		$this->construct = HTML5Construct::Explode($construct);
		
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
			if ($this->target) { $this->target->appendChild( $this->objnode ); }
			
			//  execute any provided $with arguments
			if ($with) { $this->html($with); }
		}
		
		return $this;
	}
	
	public function setNode($node)
	{
		$this->objnode = $node;
	}
}
?>
