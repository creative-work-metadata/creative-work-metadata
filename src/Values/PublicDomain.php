<?php

namespace StructuredData\Values;

/**
 * Use rationale for public domain works.
 */
class PublicDomain extends UseRationale {
	/**
	 * Type of public domain rationale (e.g. "PD-USGov-NASA").
	 * @var int
	 */
	protected $type;

	/**
	 * Wikidata item describing the rationale
	 * @var string
	 */
	protected $dataItem;

	/**
	 * Name of the rationale (e.g. "Work made by NASA")
	 * @var string
	 */
	protected $name;

	/**
	 * Detailed description, e.g. to show in an upload interface
	 * (is this needed?)
	 * @var string
	 */
	protected $description;

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
