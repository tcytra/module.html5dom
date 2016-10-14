<?php
/**
 *  HTML5Document
 *  
 *  This object provides the ability to create and utilize the PHP DOMDocument
 *  + object to create, identify, and manipulate all types of nodes in the tree
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.5 HTML5Document.php 2016-09-14
 *  @since      system-0.3.1
 */
class HTML5Document
{
	//  DOMDocument Objects
	
	/** @var object $domdtd   The definition of the HTML DOM DocumentType */
	private	$domdtd;
	/** @var object $domimp   The DOMImplementation of DOM DocumentType */
	private	$domimp;
	/** @var object	$domobj   The DOMDocument instance of DOMImplementation */
	private	$domobj;
	
	//  HTML5Document Objects
	
	/** @var object $objnode  The target DOMDocument node, normally "html" or "body" */
	private $objnode;
	
	private $html;
	private $head;
	private $body;
	
	//  HTML5Document Output
	
	/** @var string The saveHTML string returned from PHP DOMDocument */
	private	$output;
	
	/**
	 * __construct()
	 *  
	 *  Create an instance of the HTML5Document object
	 *  
	 *  Optionally, create the root "html" and "body" nodes by arguing
	 *  + (true, true) or ("html", "body") If the "html" and "body" are argued
	 *  + for, the <head> will also automatically be appended to <html>
	 *  
	 *  By default, this object instance will not create a root node or any 
	 *  + child nodes
	 *  
	 *  @param  bool,"html"  $html = null
	 *  @param  bool,"body"  $body = null
	 *  @param  bool,"head"  $head = null
	 */
	function __construct($html = null, $body = null, $head = true)
	{
		//  import the arguments into the object instance
		$this->html = $html;
		$this->body = $body;
		$this->head = $head;
		
		//  perform an instance parameter sanity check
		$this->checksane();
		
		//  create an implementation of this HTML5Document request
		$this->implement();
	}
	
	//  HTML5Document Instance Private Methods
	
	/**
	 *  checksane()
	 *  Ensure the object and/or its parameters are not completely batshit
	 *  
	 *  @return bool
	 *  @access private
	 */
	private function checksane()
	{
		//  sanity check: define rigid values for the "html" and "body" arguments
		$this->html = ( (gettype($this->html)!=="object") && (($this->html === true) || (strtolower($this->html) == "html")) ) ? "html" : $this->html;
		$this->body = ( (gettype($this->body)!=="object") && (($this->body === true) || (strtolower($this->body) == "body")) ) && $this->html ? "body" : $this->body;
		$this->head = ( (gettype($this->head)!=="object") && (($this->head === true) || (strtolower($this->head) == "head")) ) && $this->body ? "head" : $this->head;
	}
	
	/**
	 *  implement()
	 *  Create an instance of the DOMImplementation for this HTML5Document
	 *  
	 *  @access	private
	 */
	private	function implement()
	{
		//  create an instance of the PHP DOMImplementation
		$this->domimp = new DOMImplementation;
		//  declare the doctype
		$this->domdtd = $this->domimp->createDocumentType("html", null, null);
		//  create the document object
		$this->domobj = $this->domimp->createDocument("", $this->html, $this->domdtd);
		//  format the document parameters
		$this->domobj->formatOutput = true;
		$this->domobj->preserveWhiteSpace = true;
		$this->domobj->encoding	= strtoupper( (HTML5Dom::$charset) ? HTML5Dom::$charset : "utf-8" );
		
		//  identify the instance $objnode as the "html" node
		if ($this->html) {
			$this->domnode = $this->domobj->documentElement;
			$this->objnode = $this->domnode;
			
			if(HTML5Dom::$language){ $this->domnode->setAttribute("lang", HTML5Dom::$language); }
		}
		
		//  append the <head> to the document <html>
		if ($this->head) {
			$this->head = new HTML5DocumentHead($this, $this->objnode);
		}
		
		//  append the <body> to the document <html> and identify the instance $objnode as the "body" node
		if ($this->body) {
			$this->body = $this->domobj->createElement("body");
			$this->domnode->appendChild($this->body);
			$this->objnode = $this->body;
		}
	}
	
	//  HTML5Document DOMElement   ----
	
	/**
	 *  append()
	 *  Create and return a DOMElement with the specified nodeName
	 *  
	 *  @param  $nodeName = "div"
	 *  @return object	HTML5Element
	 *  @access	public
	 */
	public	function append($nodeName = "div")
	{
		//  create a new instance of the HTML5Element and create()
		$element = new HTML5Element($this, $this->objnode);
		$element->create($nodeName);
		
		//  return the instance of the HTML5Element
		return	$element;
	}
	
	//  HTML5Document Internal References
	
	/**
	 *  domnode()
	 *  Return the current working node for this instance
	 *  
	 *	@return	object
	 *  @access	public
	 */
	public	function domnode()
	{
		return	$this->objnode;
	}
	
	/**
	 *  domobject()
	 *  Return the DOMDocument object for this instance
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
	 *  @return object  HTML5DocumentHead
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
	 *  @return object  HTML5DocumentHead
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
	 *  Perform a PHP DOMDocument saveHTML into the instance $output variable
	 *  
	 *  @param	bool	$showdoctype = true
	 *  @return	object	HTML5Document
	 *  @access	public
	 */
	public	function save()
	{
		$this->output = $this->domobj->saveHTML();
		
		return	$this;
	}
	
	/**
	 *  write()
	 *  Write the HTML5Document DOMDocument contents
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
