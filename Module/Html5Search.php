<?php
/**
 *  Class       Html5Search
 *  Extends     Html5
 *  
 *  This object provides the ability to search for dom nodes matching a
 *  + provided construct argument and manipulate the list of nodes
 *  
 *  @author		Todd Cytra <tcytra@gmail.com>
 *  @version	0.0.1 Html5Search.php 2016-11-06
 *  @since		html5-0.1.2
 */
class Html5Search extends Html5
{
	//  Html5Search Parameters
	
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
		//  create an instance of the HTML5Contructor object
		$this->construct = HTML5Construct::Explode($construct, true);
		
		//  define the parent top level object node to search against
		$this->objnode = $this->parent->objnode;
		
		//  first, search for a match by id and return a result
		if ($this->construct->id) {
			if ($node = $this->domobj->getElementById($this->construct->id)) {
				
				$this->objnode = $node;
				
				return new Html5Element( ["parent"=>$this->parent] );
			} else {
				return $this;
			}
		}
	}
}
