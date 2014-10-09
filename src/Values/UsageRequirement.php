<?php

namespace StructuredData\Values;

/**
 * A UsageRequirement is something required from reusers by the license (e.g. "you must attribute
 * the author").
 */
class UsageRequirement {
	const TYPE_ATTRIBUTION = 'Q123';
	const TYPE_SHAREALIKE = 'Q234';

	/**
	 * Requirement type
	 * @var string
	 */
	protected $type;

	/**
	 * Wikidata item describing the requirement.
	 * @var string
	 */
	protected $dataItem;

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param string $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}
}
