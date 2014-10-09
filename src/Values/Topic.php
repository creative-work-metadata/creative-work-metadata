<?php

namespace StructuredData\Values;

use DataValues\MultilingualTextValue;

/**
 * A Topic is something contained in the image.
 */
class Topic {
	/**
	 * Name of the topic.
	 * @var MultilingualTextValue
	 */
	protected $name;

	/**
	 * Description of the topic.
	 * @var MultilingualTextValue|null
	 */
	protected $description;

	/**
	 * Wikidata ID of the topic.
	 * @var string|null
	 */
	protected $dataItem;

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
	 * @param string $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}
}
