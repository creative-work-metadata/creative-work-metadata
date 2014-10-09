<?php

namespace StructuredData\Values;

class License extends UseRationale {
	/** @var string */
	protected $dataItem;

	/** @var string */
	protected $shortName;

	/** @var string */
	protected $longName;

	/** @var string */
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
