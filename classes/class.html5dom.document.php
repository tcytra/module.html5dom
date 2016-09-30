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
	private $charset;
	private $language;
	
	private	$domdtd;
	private	$domimp;
	private	$domobj;
	
	/**
	 * __construct()
	 *  Create an instance of the HTML5Document object
	 *  
	 *  @param  string  $root = null
	 */
	function __construct($root = null)
	{
		$this->implement($root);
	}
	
	/**
	 *  implement()
	 *  Create an instance of the DOMImplementation for this HTML5Document
	 *  
	 *  @param  string  $root
	 *  @access	private
	 */
	private	function implement($root)
	{
		$this->domimp	= new DOMImplementation;
		$this->domdtd	= $this->domimp->createDocumentType("html", null, null);
		$this->domobj	= $this->domimp->createDocument("", $root, $this->domdtd);
		$this->domobj->formatOutput = true;
		$this->domobj->preserveWhiteSpace = true;
		$this->domobj->encoding	= strtoupper( ($this->charset) ? $this->charset : "utf-8" );
		
		$this->domnode	= $this->domobj->documentElement;
		$this->objnode	= $this->domnode;
	}
	
}
?>
