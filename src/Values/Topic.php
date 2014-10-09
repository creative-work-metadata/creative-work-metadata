<?php

namespace StructuredData\Values;

/**
 * A Topic is something contained in the image.
 */
class Topic {
	/**
	 * Name of the topic.
	 * @var string
	 */
	protected $name;

	/**
	 * Description of the topic.
	 * @var string
	 */
	protected $description;

	/**
	 * Wikidata ID of the topic.
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
