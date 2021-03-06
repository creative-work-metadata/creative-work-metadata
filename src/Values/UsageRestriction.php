<?php

namespace StructuredData\Values;

use DataValues\MultilingualTextValue;

/**
 * A UsageRestriction is a non-copyright limitation on how the work can be reused (e.g. personality
 * rights).
 */
class UsageRestriction {
	const TYPE_FREEDOM_OF_PANORAMA = 'Q123';
	const TYPE_PERSONALITY_RIGHTS = 'Q234';

	/**
	 * Type of the restriction.
	 * @var string
	 */
	protected $type;

	/**
	 * A name for the restriction (e.g. "personality rights").
	 * @var MultilingualTextValue
	 */
	protected $name;

	/**
	 * An explanation of the restriction (e.g. "This image depcits identifiable persons; their
	 * permission might be required for reuse.")
	 * @var MultilingualTextValue|null
	 */
	protected $description;

	/**
	 * Wikidata item describing the restriction.
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
	 * @return MultilingualTextValue
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param MultilingualTextValue $name
	 */
	public function setName( MultilingualTextValue $name ) {
		$this->name = $name;
	}

	/**
	 * @return MultilingualTextValue|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param MultilingualTextValue|null $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return string|null
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param string|null $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}
}
