<?php
/**
 *  Class       Html5Document
 *  Extends     Html5
 *  
 *  This object provides the ability to create and utilize the PHP DomDocument
 *  + object to create, identify, and manipulate the types of nodes in the tree
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.3.3 Html5Document.php 2016-09-14
 *  @since      html5-0.0.1
 */
class Html5Document extends Html5
{
	//  Html5Document Objects
	
	/** @var object $body     The document <body> element and local objnode */
	public		$body;
	/** @var object $head     The instance of the Html5DocumentHead object */
	public		$head;
	
	//  Html5Document Input
	
	/** @var string $export   . */
	//private		$export;
	/** @var string $import   . */
	//private		$import;
	
	//  Html5Document Output
	
	/** @var string The saveHTML string returned from PHP DomDocument */
	private		$output;
	
	//  Html5Document Parameters
	
	/** @var string $objtype  The instance type of this object is document */
	public		$objtype	= "document";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Document object
	 */
	function __construct($config = null)
	{
		//  the option exists to simply argue the language as the $config
		if (!is_array($config) && self::isValid("language", $config)) { $config = ["language" => $config]; }
		
		//  cycle the provided configuration array into the configure method
		if ($config && is_array($config)) {
			foreach ($config as $index=>$value) { $this->configure($index, $value); }
		}
		
		//  implement the DomDocument
		$this->implement();
	}
	
	//  Secure Methods
	
	/**
	 *  implement()
	 *  Create an instance of the DomImplementation for this Html5Document
	 *  
	 *  @access	private
	 */
	protected function implement()
	{
		//  sanity check: prevent another implementation if the domnode exists
		if ($this->domnode) { return; }
		
		parent::implement();
		
		//  the remainder of the implementation is specific to the document
		if($this->objtype != "document") { return; }
		
		//  create a reference to the dom documentelement
		$this->domnode = $this->domobj->documentElement;
		
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
		//  create an instance of the Html5Fragment object
		$fragment = new Html5Fragment(['parent' => $this]);
		
		//  pass the constructor and content with to the object
		$fragment->create($construct, $with);
		
		return $fragment;
	}
	
	/**
	 *  loadFile()
	 *  Load an HTML template from a provided filename
	 *  
	 *  @param  string  $filename
	 *  @return object  Html5Document
	 *  @access public
	 */
	public function loadFile($filename)
	{
		if (self::isValid("filename", $filename) && file_exists($filename)) {
			//  retrieve the file content
			$content = file_get_contents($filename);
			//  append the content to the document body
			$this->html($content);
		}
		
		return $this;
	}
	
	//  Html5Document Output
	
	/**
	 *  save()
	 *  Perform a PHP DomDocument saveHTML into the instance $output variable
	 *  
	 *  @return	object	Html5Document
	 *  @access	public
	 */
	public function save()
	{
		$this->output = $this->domobj->saveHTML();
		
		return $this;
	}
	
	/**
	 *  saveFile()
	 *  Save the HTML output to a specified directory/filename
	 *  
	 *  @param  string  $filename
	 *  @return object  Html5Document
	 *  @access public
	 */
	public function saveFile($filename)
	{
		if (self::isValid("filename", $filename)) {
			$dirname = dirname($filename);
			
			//  attempt to create a non-existing directory
			if (!file_exists($dirname)) {
				try { mkdir($dirname, 0755, true); }
				catch (Exception $e) { /** @todo generate an error */ }
			}
			
			//  determine if the target directory exists and is writable
			if ( file_exists($dirname) && is_writable($dirname) ) {
				//  save the content of the domdocument to the instance output
				$this->save();
				//  write the file content
				$result = file_put_contents($filename, $this->output);
				//  sanity check: ensure the file was written
				if ($result !== true) {
					/** @todo generate an error */
				}
			}
		}
		
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
