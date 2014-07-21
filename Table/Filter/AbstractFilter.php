<?php

namespace PZAD\TableBundle\Table\Filter;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of AbstractFilter
 *
 * @author Jan Mühlig
 */
abstract class AbstractFilter implements FilterInterface
{
	/**
	 * Name of the filter.
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Label of the filter.
	 * 
	 * @var string
	 */
	protected $label;
	
	/**
	 * Operator of the filter.
	 * 
	 * @var int
	 */
	protected $operator;
	
	/**
	 * Columns, the filter will work on.
	 * 
	 * @var array
	 */
	protected $columns;
	
	/**
	 * Attributes for rendering.
	 * 
	 * @var array 
	 */
	protected $attributes;

	public function getAttributes()
	{
		return $this->attributes;
	}

	public function getColumns()
	{
		return $this->columns;
	}

	public function getLabel()
	{
		return $this->label;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getOperator()
	{
		return $this->operator;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setOptions(array $options)
	{
		$optionsResolver = new OptionsResolver();
		
		// Set required.
		$optionsResolver->setRequired(array(
			'columns'
		));
		
		// Set defaults.
		$optionsResolver->setDefaults(array(
			'label' => '',
			'operator' => FilterOperator::EQ,
			'attr' => array()
		));
		
		// Resolve options.
		$resolvedOptions = $optionsResolver->resolve($options);
		
		$this->columns = $resolvedOptions['columns'];
		$this->label = $resolvedOptions['label'];
		$this->operator = $resolvedOptions['operator'];
		$this->attributes = $resolvedOptions['attr'];
		
		FilterOperator::validate($this->operator);
	}
}
