<?php

namespace StructuredData\Values;

/**
 * A UsageRestriction is a non-copyright limitation on how the work can be reused (e.g. personality
 * rights).
 */
class UsageRestriction {
	/**
	 * Type of the restriction.
	 * @var int
	 */
	protected $type;

	/**
	 * A name for the restriction (e.g. "personality rights").
	 * @var string
	 */
	protected $name;

	/**
	 * An explanation of the restriction (e.g. "This image depcits identifiable persons; their
	 * permission might be required for reuse.")
	 * @var string
	 */
	protected $description;

	/**
	 * Wikidata item describing the restriction.
	 * @var string
	 */
	protected $dataItem;

	/**
	 * @param int $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}

	/**
	 * @return string
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param string $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}
