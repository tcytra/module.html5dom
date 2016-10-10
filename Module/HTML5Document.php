<?php
/**
 *  Class       HTML5Document
 *  
 *  The top-level instance of the HTML5 object model
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.3 class.html5dom.document.php 2016-09-14
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
		$this->html = (($this->html === true) || (strtolower($this->html) == "html")) ? "html" : null;
		$this->body = (($this->body === true) || (strtolower($this->body) == "body")) && $this->html ? "body" : null;
		$this->head = (($this->head === true) || (strtolower($this->head) == "head")) && $this->body ? "head" : null;
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
			if(HTML5Dom::$language){ $this->domnode->setAttribute("lang", HTML5Dom::$language); }
			$this->objnode = $this->domnode;
		}
		
		//  append the <head> to the document <html>
		if ($this->head) {
			$head = $this->domobj->createElement("head");
			$this->domnode->appendChild($head);
		}
		
		//  append the <body> to the document <html> and identify the instance $objnode as the "body" node
		if ($this->body) {
			$body = $this->domobj->createElement("body");
			$this->domnode->appendChild($body);
			$this->objnode = $body;
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
