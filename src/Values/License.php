<?php

namespace StructuredData\Values;

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
	 * @var \DataValues\MultilingualTextValue
	 */
	protected $shortName;

	/**
	 * Long name of the license (e.g. "Creative Commons Attribution-ShareAlike 3.0 Netherlands")
	 * @var \DataValues\MultilingualTextValue|null
	 */
	protected $longName;

	/**
	 * URI of the license deed
	 * @var \DataValues\MonolingualTextValue|null
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
	 * @return \DataValues\MultilingualTextValue
	 */
	public function getShortName() {
		return $this->shortName;
	}

	/**
	 * @param \DataValues\MultilingualTextValue $shortName
	 */
	public function setShortName( $shortName ) {
		$this->shortName = $shortName;
	}

	/**
	 * @return \DataValues\MultilingualTextValue|null
	 */
	public function getLongName() {
		return $this->longName;
	}

	/**
	 * @param \DataValues\MultilingualTextValue|null $longName
	 */
	public function setLongName( $longName ) {
		$this->longName = $longName;
	}

	/**
	 * @return \DataValues\MonolingualTextValue|null
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param \DataValues\MonolingualTextValue|null $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}
}
