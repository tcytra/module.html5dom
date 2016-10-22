<?php
/**
 *  Html5Document
 *  
 *  This object provides the ability to create and utilize the PHP DomDocument
 *  + object to create, identify, and manipulate the types of nodes in the tree
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.5 Html5Document.php 2016-09-14
 *  @since      html5-0.0.1
 */
class Html5Document extends Html5
{
	//  PHP DomDocument Objects
	
	/** @var object $domdtd The definition of the HTML DOM DocumentType */
	private	$domdtd;
	/** @var object $domimp The DomImplementation of DOM DocumentType */
	private	$domimp;
	
	//  Html5Document Objects
	
	/** @var object $html   The <html> document element and global domnode */
	private $html;
	/** @var object $head   The instance of the Html5DocumentHead object */
	public  $head;
	/** @var object $body   The <body> document element and local objnode */
	public  $body;
	
	//  Html5Document Output
	
	/** @var string The saveHTML string returned from PHP DomDocument */
	private	$output;
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Document object
	 */
	function __construct($config = null)
	{
		parent::__construct($config);
		
		$this->implement();
	}
	
	//  HTML5Document Instance Private Methods
	
	/**
	 *  implement()
	 *  Create an instance of the DomImplementation for this Html5Document
	 *  
	 *  @access	private
	 */
	private	function implement()
	{
		//  create an instance of the PHP DomImplementation
		$this->domimp = new DOMImplementation;
		//  declare the doctype
		$this->domdtd = $this->domimp->createDocumentType("html", null, null);
		//  create the document object
		$this->domobj = $this->domimp->createDocument("", "html", $this->domdtd);
		//  format the document parameters
		$this->domobj->formatOutput = true;
		$this->domobj->preserveWhiteSpace = true;
		$this->domobj->encoding	= strtoupper( (Html5::$charset) ? Html5::$charset : "utf-8" );
		
		//  identify the instance $objnode as the "html" node
		$this->domnode = $this->domobj->documentElement;
		
		//  set the language attribute for the <html> element, if available
		if(Html5::$language){ $this->domnode->setAttribute("lang", Html5::$language); }
		
		//  append the <head> element to the document <html> element
		$this->head = new Html5DocumentHead($this, $this->objnode);
		
		//  append the <body> to the document <html> and identify the instance
		//  + $objnode as the "body" node
		$this->body = $this->domobj->createElement("body");
		$this->domnode->appendChild($this->body);
		$this->objnode = $this->body;
	}
	
	//  HTML5Document DomElement    ----
	
	/**
	 *  append()
	 *  Create and return a DomElement with the specified nodename
	 *  
	 *  @param  $nodename = "div"
	 *  @return object	Html5Element
	 *  @access	public
	 */
	public	function append($nodename = "div")
	{
		//  create a new instance of the Html5Element and create()
		$element = new Html5Element($this, $this->objnode);
		$element->create($nodename);
		
		//  return the instance of the Html5Element
		return	$element;
	}
	
	//  Html5Document Internal References
	
	/**
	 *  domnode()
	 *  Return the current working node for this instance
	 *  
	 *	@return	object
	 *  @access	public
	 */
	public	function domnode()
	{
		return	$this->domnode;
	}
	
	/**
	 *  domobject()
	 *  Return the DomDocument object for this instance
	 *  
	 *  @return	object
	 *  @access	public
	 */
	public	function domobject()
	{
		return	$this->domobj;
	}
	
	//  HTML5Document Head         ----
	
	/**
	 *  meta()
	 *  Add a document META tag and attributes to the html5 node tree
	 *  
	 *  @param  array   $attr
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function meta($attr)
	{
		if ($this->head) {
			$this->head->meta($attr);
			
			return $this;
		}
	}
	
	/**
	 *  title()
	 *  Add the document title tag to the html5 node tree
	 *  + 0 (Default) will overwrite, 1 will append, -1 will prepend
	 *  
	 *  @param  string  $text
	 *  @param  int	    $append = 0
	 *  @param  string  $join = null
	 *  @return object  Html5DocumentHead
	 *  @access public
	 */
	public function title($text, $append = 0, $join = null)
	{
		if ($this->head) {
			$this->head->title($text, $append, $join);
			
			return $this;
		}
	}
	
	//  HTML5Document Output       ----
	
	/**
	 *  save()
	 *  Perform a PHP DomDocument saveHTML into the instance $output variable
	 *  
	 *  @param	bool	$showdoctype = true
	 *  @return	object	Html5Document
	 *  @access	public
	 */
	public	function save()
	{
		$this->output = $this->domobj->saveHTML();
		
		return	$this;
	}
	
	/**
	 *  write()
	 *  Write the Html5Document DomDocument contents
	 *  
	 *  @access	public
	 */
	public	function write()
	{
		//  write the saveHTML output string
		echo $this->output;
	}
}
?>
