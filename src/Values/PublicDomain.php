<?php

namespace StructuredData\Values;

use DataValues\MultilingualTextValue;

/**
 * Use rationale for public domain works.
 */
class PublicDomain extends UseRationale {
	const TYPE_PD_USGOV_NASA = 'Q123';

	/**
	 * Type of public domain rationale (e.g. "PD-USGov-NASA").
	 * @var string
	 */
	protected $type;

	/**
	 * Wikidata item describing the rationale
	 * @var string
	 */
	protected $dataItem;

	/**
	 * Name of the rationale (e.g. "Work made by NASA")
	 * @var MultilingualTextValue
	 */
	protected $name;

	/**
	 * Detailed description, e.g. to show in an upload interface
	 * (is this needed?)
	 * @var MultilingualTextValue|null
	 */
	protected $description;

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

	/**
	 * @return MultilingualTextValue
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param MultilingualTextValue $name
	 */
	public function setName( $name ) {
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
}
