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
 *  @version	0.0.5 Html5Search.php 2016-11-06
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
	 *  findByNodeId()
	 *  Cycle through a node tree to find elements with the requested nodeName
	 *  + This was originally performed via getElementById, however this method
	 *  + cannot be invoked on an element, only on the entire dom. There were
	 *  + other issues also.
	 *  
	 *  @param  string  $id
	 *  @param  object  $node
	 *  @access private
	 */
	private function findByNodeId($id, $node)
	{
		//  only evaluate html tag nodes
		if ($node->nodeType == 1) {
			//  ensure the node has ad id attribute
			if ($node->hasAttribute("id")) {
				//  retrieve the id attribute
				$nodeid = $node->getAttribute("id");
				//  compare the id attribute with the requested id
				if ($nodeid == $id) { $this->list[] = $node; }
			}
			
			//  a request for an id match can only have one result
			if (count($this->list)) { return; }
			
			//  continue searching through the available childNodes
			if ($node->childNodes->length) {
				//  cycle the childNodes back into this method
				foreach ($node->childNodes as $each) { $this->findByClassName($id, $each); }
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
		$this->objnode = $this->parent->objectnode();
		
		//  first, search for a match by id and return a result
		if ($construct->id) {
			//  create a local copy of the list
			$list = (count($this->list)) ? $this->list : $this->objnode->childNodes;
			//  reset the instance list to rebuild with matches
			$this->list = array();
			
			//  cycle the list and strike a match
			foreach ($list as $each) { $this->findByNodeId($construct->id, $each); }
			
			//  update the Html5Search list length
			$this->length = count($this->list);
			
			//  there can only be one match or nothing for an element id
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
			$list = (count($this->list)) ? $this->list : $this->objnode->childNodes;
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
	 *  @access public
	 */
	public function item($index = 0)
	{
		//  ensure the index exists in the list
		if ($index < $this->length) {
			//  return a new temporary instance of the Html5Element
			$object = $this->list[$index];
			return new Html5Element( ["object"=>$object] );
		}
		
		/** @todo report an error here, or create/return a new Html5Element? */
		return null;
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
	 *  append()
	 *  Create and return a DomElement with the specified nodename
	 *  
	 *  @param  string  $construct
	 *  @param  string  $with = null
	 *  @return object
	 *  @access	public
	 */
	public function append($construct, $with = null)
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
				parent::append($construct, $with);
			}
		}
		
		//  restore the original node
		$this->objnode = $node;
		
		return $this;
	}
	
	/**
	 *  attribute()
	 *  Get or set an attribute value by name
	 *  
	 *  @param  string  $name
	 *  @param  string  $value = null
	 *  @return string|object
	 */
	public function attribute($name, $value = null)
	{
		//  preserve the current object node
		$node = $this->objnode;
		
		//  cycle the current search list
		foreach ($this->list as $each) {
			//  test to ensure this listed node still exists
			if (isset($each->nodeType)) {
				//  create a new temporary instance of Html5Element
				$element = new Html5Element(["object"=>$each]);
				//  pass the method to the element instance
				$element->attribute($name, $value);
			}
		}
		
		//  restore the original node
		$this->objnode = $node;
		
		return $this;
	}
	
	/**
	 *  classAdd()
	 *  Add the provided classname(s) to the element class attribute
	 *  
	 *  @param  string  $className
	 *  @return object
	 *  @access public
	 */
	public function classAdd($className)
	{
		//  preserve the current object node
		$node = $this->objnode;
		
		//  cycle the current search list
		foreach ($this->list as $each) {
			//  test to ensure this listed node still exists
			if (isset($each->nodeType)) {
				//  create a new temporary instance of Html5Element
				$element = new Html5Element(["object"=>$each]);
				//  pass the method to the element instance
				$element->classAdd($className);
			}
		}
		
		//  restore the original node
		$this->objnode = $node;
		
		return $this;
	}
	
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
		
		//  restore the original node
		$this->objnode = $node;
		
		return $this;
	}
}
