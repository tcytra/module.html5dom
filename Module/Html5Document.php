<?php
/**
 *  Html5Document
 *  
 *  This object provides the ability to create and utilize the PHP DomDocument
 *  + object to create, identify, and manipulate the types of nodes in the tree
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.7 Html5Document.php 2016-09-14
 *  @since      html5-0.0.1
 */
class Html5Document extends Html5
{
	//  Html5Document Objects
	
	/** @var object $body     The document <body> element and local objnode */
	public		$body;
	/** @var object $head     The instance of the Html5DocumentHead object */
	public		$head;
	
	//  Html5Document Output
	
	/** @var string The saveHTML string returned from PHP DomDocument */
	private		$output;
	
	//  Html5Document Parameters
	
	/** @var string $objtype  The instance type of this object is document */
	public		$objtype	= "document";
	
	//  PHP DomDocument Objects
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Document object
	 */
	function __construct($config = null)
	{
		parent::__construct($config);
		
		$this->implement("html");
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
	{  }
	
	/**
	 *  implement()
	 *  Create an instance of the DomImplementation for this Html5Document
	 *  
	 *  @param  string  $rootnode = ""
	 *  @access	private
	 */
	protected function implement($rootnode = "")
	{
		parent::implement($rootnode);
		
		//  set the language attribute for the <html> element, if available
		if(Html5::$language){ $this->domnode->setAttribute("lang", Html5::$language); }
		
		//  append the <head> element to the document <html> element
		$this->head = new Html5DocumentHead(['parent'=>$this, 'target'=>$this->domnode]);
		$this->head->create();
		
		//  append the <body> to the document <html> and identify the instance
		//  + $objnode as the "body" node
		$this->body = $this->domobj->createElement("body");
		$this->domnode->appendChild($this->body);
		
		$this->objnode = $this->body;
	}
	
	//  Public Methods
	
	/**
	 *  fragment()
	 *  Create and return an instance of the Html5Fragment
	 *  
	 *  @param  string  $construct
	 *  @param  string  $with = null
	 *  @return object  Html5Fragment
	 *  @access public
	 */
	public function fragment($construct, $with = null)
	{
		//  create an instance of the HTML5Contruct object
		$construct = HTML5Construct::Set($construct);
		
		
	}
	
	//  Internal References
	
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
	
	//  Html5Document Output
	
	/**
	 *  save()
	 *  Perform a PHP DomDocument saveHTML into the instance $output variable
	 *  
	 *  @param	bool	$showdoctype = true
	 *  @return	object	Html5Document
	 *  @access	public
	 */
	public function save()
	{
		$this->output = $this->domobj->saveHTML();
		
		return $this;
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
