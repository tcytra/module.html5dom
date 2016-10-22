<?php
/**
 *  Html5
 *  
 *  This object is the parent instance in the Html5 object model and contains
 *  + the top level configuration and dom references and interaction
 *  
 *  @author     Todd Cytra <tcytra@gmail.com>
 *  @version    0.1.1 Html5.php 2016-10-21
 *  @since      Html5-0.0.7
 */
class Html5
{
	//  Html5 Document Parameters
	
	/** @var string $charset  Is the specified character set for this HTML5 output */
	public	static	$charset	= "utf-8";
	/** @var string $language Is the specified language encoding for this HTML5 output */
	public	static	$language	= "en-US";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5 object
	 *  
	 *  @param  object  $config = null
	 */
	public	function __construct($config = null)
	{
		
	}
	
	/**
	 *  configure()
	 *  Set a configuration value for this object by specified index
	 *  
	 *  @param  string  $index
	 *  @param  string  $value
	 *  @access private
	 */
	private	function configure($index, $value)
	{
		switch ($index) {
			case 'charset':
				if (preg_match("/^[a-z][a-z0-9-]+[0-9]{1}$/", $value)) { self::$charset = $value; }
				break;
		}
	}
}
