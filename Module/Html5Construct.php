<?php
/**
 *  Html5Construct
 *  
 *  This class provides the ability to evaluate and manage a provided $construct
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.1.6 Html5Construct.php 2016-09-19
 *  @since		Html5-0.0.1
 */
class Html5Construct
{
	//  Public Parameters
	
	/** @var string $id */
	public	$id		= null;
	/** @var string $class */
	public	$class	= null;
	/** @var string $name */
	public  $name	= null;
	
	/**
	 * __construct()
	 *  Create a new instance of the HTML5Construct
	 */
	function __construct()
	{  }
	
	//  Public Methods
	
	/**
	 *  able()
	 *  Determine whether a provided constructor is viable
	 *  
	 *  @return	bool
	 *  @access	public
	 */
	public	function able()
	{
		return	Html5::isValid("nodename", $this->name);
	}
	
	//  Global Methods
	
	/**
	 *  Set()
	 *  Explode and evaluate the portions of the provided constructor
	 *  
	 *  @param  string|object $constructor
	 *  @return object
	 *  @access public
	 */
	public static function Set($constructor)
	{
		//  create an instance of the HTML5Construct object
		$construct	= new HTML5Construct();
		
		//  extract a node class definition, if available; match '.classname'
		if(preg_match("/\.[a-z]?([a-z0-9-]+)$/", $constructor))
		{ $construct->class = str_replace(".", " ", substr($constructor, strpos($constructor,".")+1)); $constructor = substr($constructor, 0, strpos($constructor,".")); }
		
		//  extract a node identifier, if available; match '#elementid'
		if(preg_match("/#[a-z]?([a-zA-Z0-9_]+)$/", $constructor))
		{ $construct->id = substr($constructor, strpos($constructor,"#")+1); $constructor = substr($constructor, 0, strpos($constructor,"#")); }
		
		//  verify the remainder as the node name
		$construct->name = preg_match("/^[a-z]?([a-zA-Z0-9-]+)$/", $constructor) ? $constructor : "div";
		
		//  ensure the construct node is a valid HTML5 entity
		if(!$construct->able())
		{ throw new Exception("The construct node '{$construct->name}' is not a valid HTML5 entity."); }
		
		return	$construct;
	}
}
?>
