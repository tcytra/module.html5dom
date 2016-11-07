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
	
	//  Public Methods
	
	public function find($construct)
	{
		//  the top level object node must be reset; the reason for this is that
		//  + this object will vary depending on the results.. if the results
		//  + are a list, the objnode must iterate to each item on the list
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
				$this->objnode = $node;
			}
			
			return $this;
		}
		
		//  search for a match by nodeName, if provided
		if ($this->construct->name) {
			$list = $this->domobj->getElementsByTagName($this->construct->name);
		}
		
		//  count the number of matching nodes
		$this->length = count($list);
		//  set the list as the instance parameter
		$this->list = $list;
		
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
}
