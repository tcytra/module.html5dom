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
	static  $defaultNode = "div";
	
	//  Private Parameters
	
	/** @var string $constructor Is the argument for the element attributes */
	private $constructor;
	/** @var bool $strict Prevent the instance from assuming the $defaultNode */
	private $strict;
	
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
	function __construct($constructor, $strict = false)
	{
		//  if the constructor is an object, return the object
		if (gettype($constructor) === "object") { return $constructor; }
		
		$this->constructor = $constructor;
		$this->strict = $strict;
		
		//  otherwise, evaluate the provided constructor
		$this->evaluate();
	}
	
	//  Private Methods
	
	/**
	 *  evaluate()
	 *  Evaluate the instance construct and explode it into logical components
	 *  
	 *  @access private
	 */
	private function evaluate()
	{
		//  the instance constructor will be preserved for future reference, if required
		$constructor = $this->constructor;
		
		//  extract a node class definition, if available; match '.classname'
		if (preg_match("/\.[a-z]?([a-z0-9-]+)$/", $constructor)) {
			//  strip the classes from the construct and convert periods to spaces
			$this->class = str_replace(".", " ", substr($constructor, strpos($constructor, ".") +1));
			//  devise a new construct without the classes portion
			$constructor = substr($constructor, 0, strpos($constructor,"."));
		}
		
		//  extract a node identifier, if available; match '#elementid'
		if (preg_match("/#[a-z]?([a-zA-Z0-9_]+)$/", $constructor)) {
			//  strip the id from the construct
			$this->id = substr($constructor, strpos($constructor, "#") +1);
			//  devise a new construct without the id portion
			$constructor = substr($constructor, 0, strpos($constructor, "#"));
		}
		
		//  verify the remainder of the construct as the node name
		$this->name = preg_match("/^[a-z]?([a-z0-9]+)$/", $constructor)
				//  by default the remaining construct is a nodeName
				? $constructor
				//  with no remaining construct, decide how to default
				: (($this->strict) ? null : self::$defaultNode);
		
		//  ensure the construct node is a valid HTML5 entity
		//  + this should be (and is being) performed by the object calling the instance
		//if(!$this->able())
		//{ throw new Exception("The construct node '{$this->name}' is not a valid HTML5 entity."); }
	}
	
	//  Public Methods
	
	/**
	 *  able()
	 *  Determine whether a provided constructor is viable
	 *  
	 *  @return	bool
	 *  @access	public
	 */
	public function able()
	{
		return	Html5::isValid("nodename", $this->name);
	}
	
	/**
	 *  classNames()
	 *  Explode and return the class names in this constructor
	 *  
	 *  @return  array
	 *  @access  public
	 */
	public function classNames()
	{
		if (strlen($this->class)) { return explode(" ", trim($this->class)); }
		
		return array();
	}
	
	//  Global Methods
	
	/**
	 *  Explode()
	 *  Explode and evaluate the portions of the provided constructor
	 *  
	 *  @param  string|object $constructor
	 *  @return object
	 *  @access public
	 */
	public static function Explode($constructor, $strict = false)
	{
		//  create and return an instance of the HTML5Construct object
		$construct = new Html5Construct($constructor, $strict);
		
		return $construct;
	}
}
?>
