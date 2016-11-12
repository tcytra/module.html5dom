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
 *  @version	0.0.1 Html5Search.php 2016-11-06
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
	 *  Create an instance of the Html5Document object
	 */
	public function __construct($parent)
	{
		$this->configure("parent", $parent);
	}
	
	//  Private Methods
	
	
	
	//  Parent Methods
	
	public function html($with)
	{
		//  preserve the current object node
		$node = $this->objnode;
		
		//  cycle the current search list
		foreach ($this->list as $each) {
			//  target each search list node
			$this->objnode = $each;
			//  defer to the parent method
			parent::html($with);
		}
		
		//  restore the original node, probably null
		$this->objnode = $node;
		
		return $this;
	}
	
	//  Public Methods
	
	/**
	 *  find()
	 *  FInd matching nodes against a provided construct
	 *  
	 *  @param  string  $construct
	 *  @param  object  $node = null
	 *  @return object  Html5Search
	 *  @access public
	 */
	public function find($construct, $node = null)
	{
		//  the top level object node must be reset
		$this->objnode = null;
		
		//  create an empty array placeholder list
		$list = array();
		
		//  create an instance of the HTML5Contructor object
		$this->construct = HTML5Construct::Explode($construct, true);
		
		//  define the parent top level object node to search against
		$this->objnode = $this->parent->objnode;
		
		//  first, search for a match by id and return a result
		if ($this->construct->id) {
			if ($node = $this->domobj->getElementById($this->construct->id)) {
				//  the found node becomes the top level object node
				$this->list = array($node);
			}
			
			$this->length = count($this->list);
			
			//  there can only be one match for an element id
			return $this;
		}
		
		//  search for a match by nodeName, if provided
		if ($this->construct->name) {
			//  create a local copy of the list
			$list = (count($this->list)) ? $this->list : $list = $this->objnode->childNodes;
			//  reset the instance list to rebuild with matches
			$this->list = array();
			
			//  cycle the list and strike a match
			foreach ($list as $each) { $this->findByNodeName($this->construct->name, $each); }
		}
		
		//  search for a match by className, if provided
		if ($this->construct->class) {
			//  create a local copy of the list
			$list = (count($this->list)) ? $this->list : $this->parent->body->childNodes;
			//  reset the instance list to rebuild with matches
			$this->list = array();
			
			//  cycle the list and strike a match
			foreach ($list as $each) { $this->findbyClassName($this->construct->class, $each); }
		}
		
		//  count the number of matching nodes
		$this->length = count($this->list);
		
		return $this;
	}
	
	public function findByNodeName($name, $node)
	{
		//  only evaluate html tag nodes with class attributes
		if ($node->nodeType == 1) {
			//  compare the nodeName with the requested name
			if (strtolower($node->nodeName) == strtolower($name)) {
				//  add this node to the instance list
				$this->list[] = $node;
			}
			
			//  continue searching through the available childNodes
			if ($node->childNodes->length) {
				//  cycle the childNodes back into this method
				foreach ($node->childNodes as $each) { $this->findByNodeName($name, $each); }
			}
		}
	}
	
	/**
	 *  findByClass()
	 *  Cycle through a node tree to find elements with the requested class attribute
	 *  
	 *  @param  string  $class
	 *  @param  object  $node
	 *  @access public
	 */
	public function findByClassName($class, $node)
	{
		//  create an array of the classes to find
		$find = explode(" ", $class);
		
		//  only evaluate html tag nodes with class attributes
		if (($node->nodeType == 1) && $node->hasAttribute("class")) {
			//  convert the node classes into an array
			$classes = explode(" ", $node->getAttribute("class"));
			
			//  compare the intersection of the class arrays
			if (array_intersect($find, $classes) == $find) {
				//  add this node to the instance list
				$this->list[] = $node;
			}
		}
		
		//  continue searching through the available childNodes
		if (($node->nodeType == 1) && $node->childNodes->length) {
			//  cycle the childNodes back into this method
			foreach ($node->childNodes as $each) { $this->findByClassName($class, $each); }
		}
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
}
