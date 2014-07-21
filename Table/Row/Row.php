<?php

namespace PZAD\TableBundle\Table\Row;

use PZAD\TableBundle\Table\TableException;

/**
 * Represents a row of tabla data.
 */
class Row
{	
	/**
	 * Object.
	 * 
	 * @var object
	 */
	private $entity;
	
	/**
	 * Ongoing row number.
	 * 
	 * @var int 
	 */
	private $count;
	
	/**
	 * Attributes of the row.
	 * 
	 * @var array
	 */
	private $attributes;
	
	function __construct($entity, $count)
	{
		$this->entity = $entity;
		$this->count = $count;
		$this->attributes = array();
	}
	
	public function getEntity()
	{
		return $this->entity;
	}
	
	public function get($property)
	{
		if(isset($this->getEntity()->$property))
		{
			return $this->getEntity()->$property;
		}
		else
		{
			$propertyName = strtoupper($property[0]) . substr($property, 1);

			$possibleGetter = array(
				'get' . $propertyName,
				'has' . $propertyName,
				'is' . $propertyName
			);

			foreach($possibleGetter as $getter)
			{
				$callable = array($this->getEntity(), $getter);
				if(is_callable($callable))
				{
					return call_user_func($callable);
				}
			}
		}
		
		TableException::noSuchPorpertyOnEntity($property, $this->getEntity());
	}
	
	/**
	 * Get the ongoing number of rows for this row.
	 * 
	 * @return int
	 */
	public function getCount()
	{
		return $this->count;
	}
	
	public function setAttributes(array $attributes)
	{
		$this->attributes = $attributes;
	}
	
	/**
	 * @return array Attributes of this row.
	 */
	public function getAttributes()
	{
		return $this->attributes;
	}
}
