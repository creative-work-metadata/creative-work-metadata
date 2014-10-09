<?php

namespace StructuredData\Values;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;

/**
 * Representation of a license (such as CC-BY-SA-3.0-nl).
 */
class License extends UseRationale {
	/**
	 * Wikidata item of the license.
	 * @var string
	 */
	protected $dataItem;

	/**
	 * Short name of the license (e.g. "CC-BY-SA-3.0-nl")
	 * @var MultilingualTextValue
	 */
	protected $shortName;

	/**
	 * Long name of the license (e.g. "Creative Commons Attribution-ShareAlike 3.0 Netherlands")
	 * @var MultilingualTextValue|null
	 */
	protected $longName;

	/**
	 * URI of the license deed
	 * @var MonolingualTextValue|null
	 */
	protected $uri;

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

	/**
	 * @return MultilingualTextValue
	 */
	public function getShortName() {
		return $this->shortName;
	}

	/**
	 * @param MultilingualTextValue $shortName
	 */
	public function setShortName( MultilingualTextValue $shortName ) {
		$this->shortName = $shortName;
	}

	/**
	 * @return MultilingualTextValue|null
	 */
	public function getLongName() {
		return $this->longName;
	}

	/**
	 * @param MultilingualTextValue|null $longName
	 */
	public function setLongName( $longName ) {
		$this->longName = $longName;
	}

	/**
	 * @return MonolingualTextValue|null
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param MonolingualTextValue|null $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}
}
