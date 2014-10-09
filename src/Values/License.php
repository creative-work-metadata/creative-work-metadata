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
	 * @var string
	 */
	protected $shortName;

	/**
	 * Long name of the license (e.g. "Creative Commons Attribution-ShareAlike 3.0 Netherlands")
	 * @var string
	 */
	protected $longName;

	/**
	 * URI of the license deed
	 * @var string
	 */
	protected $uri;

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
	 * @param string $longName
	 */
	public function setLongName( $longName ) {
		$this->longName = $longName;
	}

	/**
	 * @return string
	 */
	public function getLongName() {
		return $this->longName;
	}

	/**
	 * @param string $shortName
	 */
	public function setShortName( $shortName ) {
		$this->shortName = $shortName;
	}

	/**
	 * @return string
	 */
	public function getShortName() {
		return $this->shortName;
	}

	/**
	 * @param string $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}

	/**
	 * @return string
	 */
	public function getUri() {
		return $this->uri;
	}
}
