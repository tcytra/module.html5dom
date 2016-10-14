<?php
/**
 *  HTML5Dom
 *  
 *  This object is a global abstract means of creating and manipulating HTML5
 *  + instances of document, fragment, element, etc.
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *	@version    0.1.3 HTML5Dom.php 2016-09-14
 *	@since      system-0.5.1
 */
abstract class HTML5Dom
{
	//  HML5Dom Configuration
	
	/** @var string $charset  Is the specified character set for this HTML5 output */
	public	static	$charset	= "utf-8";
	/** @var string $language Is the specified language encoding for this HTML5 output */
	public	static	$language	= "en-US";
	
	//  HTML5Dom Objects
	
	/** @var object $document Is the existing instance of the HTML5Document */
	static	$document = null;
	
	/**
	 *  Construct()
	 *  Create and return an instance of the HTML5Construct implementation
	 *  
	 *  @return object HTML5Construct
	 *  @access public
	 *  @static
	 */
	public static function Construct()
	{  }
	
	/**
	 *  CreateDocument()
	 *  Create and return an instance of the HTML5Dom Document
	 *  
	 *  @return	object HTML5Document
	 *  @access	public
	 *  @static
	 */
	public static function CreateDocument()
	{
		//  sanity check: ensure an instance does not already exist
		if (self::$document) {
			/** @todo Issue a warning */
			return;
		}
		
		//  create an instance of the HTML5Document
		self::$document = new HTML5Document("html", "body");
	}
	
	/**
	 *  Element()
	 *  Create and return an instance of the HTML5Dom Element
	 *  
	 *  @return	object HTML5Element
	 *  @access	public
	 *  @static
	 */
	public static function Element()
	{  }
	
	/**
	 *  Out()
	 *  Save the instance of HTML5Dom Document and output the contents
	 *  
	 *  @return	string
	 *  @access public
	 *  @static
	 */
	public static function Out()
	{
		self::$document->save()->write();
	}
}
?>
