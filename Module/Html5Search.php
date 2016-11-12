<?php
/**
 *  Class       Html5Search
 *  Extends     Html5
 *  
 *  This object provides the ability to search for dom nodes matching a
 *  + provided construct argument and manipulate the list of nodes
 *  
 *  Unlike other classes that extend Html5, this class has a null objnode by
 *  + default as it may be the case a list of nodes match the search criteria
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.0.3 Html5Search.php 2016-11-06
 *  @since		html5-0.1.2
 */
class Html5Search extends Html5
{
	//  Html5Search Parameters
	
	/** @var int    $length   The number of nodes in the search list */
	public		$length		= 0;
	/** @var array  $list     The list of nodes matching the search criteria */
	public		$list		= array();
	/** @var string $objtype  The instance type of this object is search */
	public		$objtype	= "search";
	
	/**
	 * __construct()
	 *  Create an instance of the Html5Search object
	 */
	public function __construct($parent)
	{
		$this->configure("parent", $parent);
	}
	
	//  Private Methods
	
	/**
	 *  findByClassName()
	 *  Cycle through a node tree to find elements with the requested class attribute
	 *  
	 *  @param  string  $className
	 *  @param  object  $node
	 *  @access private
	 */
	private function findByClassName($className, $node)
	{
		//  create an array of the classes to find
		$match = explode(" ", $className);
		
		//  only evaluate html tag nodes
		if ($node->nodeType == 1) {
			//  ensure the node has a class attribute
			if ($node->hasAttribute("class")) {
				//  convert the node classes into an array
				$class = explode(" ", $node->getAttribute("class"));
				
				//  compare the intersection of the class arrays
				if (array_intersect($match, $class) == $match) {
					//  add this node to the instance list
					$this->list[] = $node;
				}
			}
			
			//  continue searching through the available childNodes
			if ($node->childNodes->length) {
				//  cycle the childNodes back into this method
				foreach ($node->childNodes as $each) { $this->findByClassName($className, $each); }
			}
		}
	}
	
	/**
	 *  findByNodeName()
	 *  Cycle through a node tree to find elements with the requested nodeName
	 *  
	 *  @param  string  $nodeName
	 *  @param  object  $node
	 *  @access private
	 */
	private function findByNodeName($nodeName, $node)
	{
		//  only evaluate html tag nodes with class attributes
		if ($node->nodeType == 1) {
			//  compare the nodeName with the requested name
			if (strtolower($node->nodeName) == strtolower($nodeName)) {
				//  add this node to the instance list
				$this->list[] = $node;
			}
			
			//  continue searching through the available childNodes
			if ($node->childNodes->length) {
				//  cycle the childNodes back into this method
				foreach ($node->childNodes as $each) { $this->findByNodeName($nodeName, $each); }
			}
		}
	}
	
	//  Public Methods
	
	/**
	 *  find()
	 *  Find matching nodes against a provided construct
	 *  
	 *  @param  string  $constructor
	 *  @return object  Html5Search
	 *  @access public
	 */
	public function find($constructor)
	{
		//  create an instance of the HTML5Contructor object
		$construct = Html5Construct::Explode($constructor, true);
		
		//  define the parent top level object node to search against
		$this->objnode = $this->parent->objnode;
		
		//  first, search for a match by id and return a result
		if ($construct->id) {
			if ($node = $this->domobj->getElementById($construct->id)) {
				//  the found node becomes the top level object node
				$this->list = array($node);
			}
			
			$this->length = count($this->list);
			
			//  there can only be one match for an element id
			return $this;
		}
		
		//  search for a match by nodeName, if provided
		if ($construct->name) {
			//  create a local copy of the list
			$list = (count($this->list)) ? $this->list : $this->objnode->childNodes;
			//  reset the instance list to rebuild with matches
			$this->list = array();
			
			//  cycle the list and strike a match
			foreach ($list as $each) { $this->findByNodeName($construct->name, $each); }
		}
		
		//  search for a match by className, if provided
		if ($construct->class) {
			//  create a local copy of the list
			$list = (count($this->list)) ? $this->list : $this->parent->body->childNodes;
			//  reset the instance list to rebuild with matches
			$this->list = array();
			
			//  cycle the list and strike a match
			foreach ($list as $each) { $this->findByClassName($construct->class, $each); }
		}
		
		//  count the number of matching nodes
		$this->length = count($this->list);
		
		return $this;
	}
	
	/**
	 *  item()
	 *  Return a requested item in this Html5Search by index, if possible
	 *  
	 *  @param  int	    $index = 0
	 *  @return object  Html5Element
	 */
	public function item($index = 0)
	{
		$this->objnode = ($index < $this->length) ? $this->list[$index] : null;
		
		return $this;
	}
	
	/**
	 *  not()
	 *  Exclude matching nodes against a provided construct
	 *  
	 *  @param  string  $constructor
	 *  @return object  Html5Search
	 *  @access public
	 */
	public function not($constructor)
	{
		//  exit if there isn't a list to exclude from
		if (!count($this->list)) { return $this; }
		
		//  create an instance of the HTML5Contructor object
		$construct = Html5Construct::Explode($constructor, true);
		
		//  create a local empty list
		$list = array();
		
		//  cycle the instance list and determine whether to exclude
		foreach ($this->list as $each) {
			$exclude = false;
			
			//  examine a match by id and exclude if necessary
			if ($construct->id && $each->hasAttribute("id") && ($each->getAttribute("id") == $construct->id)) {
				$exclude = true;
			}
			
			//  examine a match by nodeName and exclude if necessary
			if ($construct->name && ($each->nodeName == $construct->name)) {
				$exclude = true;
			}
			
			//  examine a match by className and exclude if necessary
			if ($construct->class && $each->hasAttribute("class")) {
				$match = explode(" ", $construct->class);
				$class = explode(" ", $each->getAttribute("class"));
				
				if (array_intersect($match, $class) == $match) {
					$exclude = true;
				}
			}
			
			//  append this node back into the list, if allowed
			if (!$exclude) { $list[] = $each; }
		}
		
		//  restore the local revised list into the instance
		$this->list		= $list;
		$this->length	= count($list);
		
		return $this;
	}
	
	//  Parent Methods
	
	/**
	 *  html()
	 *  Import the argument into the object node; replace existing text/html
	 *  
	 *  @param  string  $with
	 *  @param  bool    $clear = true
	 *  @return object  Html5Search
	 *  @access public
	 */
	public function html($with, $clear = true)
	{
		//  preserve the current object node
		$node = $this->objnode;
		
		//  cycle the current search list
		foreach ($this->list as $each) {
			//  test to ensure this listed node still exists
			if (isset($each->nodeType)) {
				//  target each search list node
				$this->objnode = $each;
				//  defer to the parent method
				parent::html($with, $clear);
			}
		}
		
		//  restore the original node, probably null
		$this->objnode = $node;
		
		return $this;
	}
	
}
