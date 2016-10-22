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
	
	//  PHP DomDocument Objects
	
	/** @var object	$domobj   The DomDocument instance of DomImplementation */
	private	$domobj;
	
	/**
	 * __construct()
	 *  Create an instance of the Html5 object
	 *  
	 *  @param  array  $config = null
	 */
	public	function __construct($config = null)
	{
		//  cycle the provided configuration into the configure method
		if ($config && is_array($config)) {
			foreach ($config as $index=>$value) {
				$this->configure($index, $value);
			}
		}
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
		//  evaluate and execute the configuration change, if possible
		switch ($index) {
			case 'charset':
				if (self::isValid("charset", $value)) { self::$charset = $value; }
				break;
			case 'language':
				if (self::isValid("language", $value)) { self::$language = $value; }
				break;
		}
	}
	
	//  Global Methods
	
	/**
	 *  isValid()
	 *  
	 */
	public	static	function isValid($type, $value)
	{
		$valid = false;
		
		switch (strtolower($type)) {
			case 'attribute':
				$valid = preg_match("/^[a-z][a-z0-9-]+$/", $value);
				break;
			case 'charset':
				$valid = preg_match("/^[a-z][a-z0-9-]+[0-9]{1}$/", $value);
				break;
			case 'language':
				$valid = preg_match("/^[a-z]{2}_[A-Z]{2}$/", $value);
				break;
			case 'nodename':
				$valid = preg_match("/^[a-z]+$/", $value);
				break;
			case 'title':
				$valid = preg_match("", $value);
				break;
		}
		
		return $valid;
	}
}
