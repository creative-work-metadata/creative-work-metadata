<?php

namespace StructuredData\Values;

/**
 * A Topic is something contained in the image.
 */
class Topic {
	/**
	 * Name of the topic.
	 * @var \DataValues\MultilingualTextValue
	 */
	protected $name;

	/**
	 * Description of the topic.
	 * @var \DataValues\MultilingualTextValue|null
	 */
	protected $description;

	/**
	 * Wikidata ID of the topic.
	 * @var string|null
	 */
	protected $dataItem;

	/**
	 * @param string $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}

	/**
	 * @return string|null
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param \DataValues\MultilingualTextValue|null $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return \DataValues\MultilingualTextValue|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param \DataValues\MultilingualTextValue $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return \DataValues\MultilingualTextValue|null
	 */
	public function getName() {
		return $this->name;
	}
}
