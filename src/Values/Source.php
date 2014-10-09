<?php

namespace StructuredData\Values;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;

/**
 * Source represents where the work came from. This can be a URL from which the work was downloaded
 * from, or something more abstract like a GLAM partnership or a competition.
 */
class Source {
	/**
	 * Name of the source (such as an institution name), can be missing if source is just some URL
	 * @var MultilingualTextValue|null
	 */
	protected $name;

	/**
	 * URI that points to the file
	 * @var MonolingualTextValue|null
	 */
	protected $uri;

	/**
	 * URI that gives context; typically the URI of the page on which the file was found
	 * @var MonolingualTextValue|null
	 */
	protected $contextUri;

	/**
	 * Wikidata item of the source (if it's e.g. a GLAM institution)
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
	 * @param MultilingualTextValue|null $name
	 */
	public function setName( $name ) {
		$this->name = $name;
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

	/**
	 * @return MonolingualTextValue|null
	 */
	public function getContextUri() {
		return $this->contextUri;
	}

	/**
	 * @param MonolingualTextValue|null $contextUri
	 */
	public function setContextUri( $contextUri ) {
		$this->contextUri = $contextUri;
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
}
