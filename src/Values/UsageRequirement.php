<?php

namespace StructuredData\Values;

/**
 * A UsageRequirement is something required from reusers by the license (e.g. "you must attribute
 * the author").
 */
class UsageRequirement {
	/**
	 * Requirement type
	 * @var int
	 */
	protected $type;

	/**
	 * Wikidata item describing the requirement.
	 * @var string
	 */
	protected $dataItem;

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
}
