<?php
/**
 *  Abstract
 *  Class       HTML5Dom
 *  
 *  The HTMLDom Model is a global abstract object to effect general control of the DOMDocument
 *  + system that is created and manipulated by this modules's instance methods
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *	@version    0.1.1 class.html5dom.php 2016-09-14
 *	@since      system-0.5.1
 */
abstract class HTML5Dom
{
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
	{
		
	}
	
	/**
	 *  Document()
	 *  Create and return an instance of the HTML5Dom Document
	 *  
	 *  @return	object HTML5Document
	 *  @access	public
	 *  @static
	 */
	public static function Document()
	{
		self::$document = "new HTML5Document()";
		
		return self::$document;
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
	{
		
	}
	
	/**
	 *  Save()
	 *  Finish the instance of HTML5Dom Document and return the contents
	 *  
	 *  @return	string
	 *  @access public
	 *  @static
	 */
	public static function Save()
	{
		//return self::$document->save()->out();
	}
}
?>
