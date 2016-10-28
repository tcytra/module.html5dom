<?php
/**
 *  Html5Fragment
 *  
 *  This object provides the ability to create and manipulate a PHP DomFragment
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.2.1 Html5Fragment.php 2016-09-19
 *  @since		html5-0.0.1
 */
class Html5Fragment extends Html5
{
	/**
	 * __construct()
	 *  Create an instance of the Html5Document object
	 */
	function __construct($config = null)
	{
		//  cycle the provided configuration into the configure method
		if ($config && is_array($config)) {
			foreach ($config as $index=>$value) { $this->configure($index, $value); }
		}
		
		parent::__construct($config);
		
		$this->implement();
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
	
	/**
	 *  implement()
	 *  Create an instance of the DomImplementation for this Html5Document
	 *  
	 *  @access	private
	 */
	protected function implement()
	{
		//  if this fragment instance is created outside the Html5Document it
		//  + will not have a dom object to create a fragment against
		if (!$this->domobj) {
			parent::implement();
		}
		
		$this->domnode	= $this->domobj->createDocumentFragment();
	}
	
	/**
	 *  create()
	 *  Create a DOMDocument fragment and append to the parent, with content if provided
	 *  
	 *  @param  string  $construct
	 *  @param  string  $with = null
	 *  @return object  Html5Fragment
	 *  @access public
	 */
	public function create($construct, $with = null)
	{
		//  create an instance of the Html5Contruct object
		$this->construct = Html5Construct::Set($construct);
		
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
			
			//  execute any provided $with arguments
			if ($with) { $this->with($with); }
		}
		
		return $this;
	}
	
	//  Public Methods
	
	/**
	 *  appendTo()
	 *  Append this fragment to the provided target node
	 *  
	 *  @param  object  $node
	 *  @access public
	 */
	public function appendTo($node)
	{
		if ($node->nodeType == 1) {
			$node->appendChild($this->objnode);
		}
	}
}
?>
