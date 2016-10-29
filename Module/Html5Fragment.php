<?php
/**
 *  Html5Fragment
 *  
 *  This object provides the ability to create and manipulate a PHP DomFragment
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.2.3 Html5Fragment.php 2016-09-19
 *  @since		html5-0.0.1
 */
class Html5Fragment extends Html5
{
	//  Html5Fragment Output
	
	/** @var string The saveHTML string returned from PHP DomDocument */
	private		$output;
	
	//  Html5Fragment Parameters
	
	/** @var string $objtype  The instance type of this object is fragment */
	public		$objtype	= "fragment";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Document object
	 */
	function __construct($config = null)
	{
		//  the instance config will be passed to the parent object but first
		//  + any locally applicable configuration will be applied and stripped
		$this->config = $config;
		
		//  cycle the provided configuration into the configure method
		if ($this->config && is_array($this->config)) {
			foreach ($this->config as $index=>$value) { $this->configure($index, $value); }
		}
		
		//  pass the remaining config to the parent object for further evaluation
		parent::__construct($this->config);
		
		//  implement the DomDocumentFragment
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
		//  pass the arguments to the parent object
		parent::configure($index, $value);
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
		
		//  the new DomDocumentFragment becomes the instance domnode (?)
		$this->domnode	= $this->domobj->createDocumentFragment();
	}
	
	//  Public Methods
	
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
		
		/** @todo  perform this element create via the Html5Element */
		
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
	
	/**
	 *  cloneInto()
	 *  Clone this fragment into a target node a specified number of times
	 *  
	 *  @param  object  $node
	 *  @access public
	 */
	public function cloneInto($node, $repeat = 1)
	{  }
	
	//  Html5Fragment Output
	
	/**
	 *  getOutput()
	 *  Return the derived output from this Html5Fragment
	 */
	public function getOutput($stripnewlines = false)
	{
		return ($stripnewlines) ? preg_replace("/[\n|\r]/", "", $this->output) : $this->output;
	}
	
	/**
	 *  save()
	 *  Perform a PHP DomDocument saveHTML into the instance $output variable
	 *  
	 *  @return	object	Html5Document
	 *  @access	public
	 */
	public function save()
	{
		//  append the fragment to the domdocument
		if (!$this->domobj->documentElement) {
			$this->domobj->appendChild($this->objnode);
		}
		
		//  remove the DOCTYPE declaration from the domdocument
		if ($this->domobj->childNodes->item(0)->nodeType == 10) {
			$this->domobj->removeChild( $this->domobj->childNodes->item(0) );
		}
		
		$this->output = $this->domobj->saveHTML();
		
		return $this;
	}
	
	/**
	 *	wrap()
	 *	Wrap the HTML5Fragment contents with the specified construct
	 *	
	 *	@param	string	$construct = null
	 *	@return	object	HTML5Fragment
	 *	@access	public
	 */
	public	function wrap($construct = null)
	{
		//	create an instance of the HTML5Contruct object
		$construct = Html5Construct::Set($construct);
		
		if ($construct->able()) {
			//  create an instance of the Html5Element object and construct the element
			$wrapper = new Html5Element(["parent"=>$this]);
			$wrapper->create($construct);
			
			//  append the current objnode to the new objectnode
			$wrapper->objectnode()->appendChild( $this->objnode );
			
			//  define the new objnode as the objectnode
			$this->objnode = $wrapper->objectnode();
		}
		
		//	return this instance of the HTML5Fragment
		return	$this;
	}
	
	/**
	 *  write()
	 *  Write the Html5Document DomDocument contents
	 *  
	 *  @access	public
	 */
	public function write()
	{
		//  write the saveHTML output string
		echo $this->output;
	}
}
?>
