<?php
/**
 *  Class       HTML5Document
 *  
 *  This Model is the top-level object of the HTML5Dom module for manipulating and extending
 *  + the PHP DOMDocument system
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.2.3 class.html5dom.document.php 2016-09-14
 *  @since      system-0.3.1
 */
class HTML5Document
{
	//  Various configuration options necessary for tailoring HTML5 output
	
	/** @var string $charset Is the specified character set for this HTML5 output */
	private $charset;
	/** @var string $language Is the specified language encoding for this HTML5 output */
	private $language;
	
	//  The objects involved in the PHP Document Object Model
	
	/** @var object $domdtd   Is the definition of the HTML DOM DocumentType */
	private	$domdtd;
	/** @var object $domimp   Is the PHP DOMImplementation of the HTML DOM DocumentType */
	private	$domimp;
	/** @var object	$domobj   Is the PHP DOMDocument instance of the DOMImplementation */
	private	$domobj;
	/** @var object $objnode  Is the target DOMDocument node, normally "html" or "body" */
	private $objnode;
	
	private $html;
	private $head;
	private $body;
	
	//  The document output value
	
	/** @var string The saveHTML string returned from PHP DOMDocument */
	private	$output;
	
	/**
	 * __construct()
	 *  Create an instance of the HTML5Document object
	 *  Optionally, create the root "html" and "body" nodes by arguing (true, true) or ("html", "body")
	 *  By default, this object instance will not create a root node or any child nodes
	 *  
	 *  @param  mixed   $html = null
	 *  @param  mixed   $body = null
	 */
	function __construct($html = null, $body = null)
	{
		//  sanity check: define rigid values for the "html" and "body" arguments
		$this->html = (($html === true) || (strtolower($html) == "html")) ? "html" : null;
		$this->body = (($body === true) || (strtolower($body) == "body")) && $this->html ? "body" : null;
		
		//  create an implementation of this HTML5Document request
		$this->implement();
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
		$this->domobj->encoding	= strtoupper( ($this->charset) ? $this->charset : "utf-8" );
		
		//  identify the instance $objnode as the "html" node
		if ($this->html) {
			$this->domnode = $this->domobj->documentElement;
			$this->objnode = $this->domnode;
		}
		
		//  identify the instance $objnode as the "body" node
		if ($this->body) {
			$body = $this->domobj->createElement("body");
			$this->domnode->appendChild($body);
			$this->objnode = $body;
		}
		
		//echo $this->objnode->nodeName;
		//exit;
	}
	
	//  HTML5Document Output Functionality ----
	
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
