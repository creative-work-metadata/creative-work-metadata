<?php

namespace StructuredData\Values;

/**
 * Source represents where the work came from. This can be a URL from which the work was downloaded
 * from, or something more abstract like a GLAM partnership or a competition.
 */
class Source {
	/**
	 * Name of the source (such as an institution name), can be missing if source is just some URL
	 * @var string|null
	 */
	protected $name;

	/**
	 * URI that points to the file
	 * @var string
	 */
	protected $uri;

	/**
	 * URI that gives context; typically the URI of the page on which the file was found
	 * @var string
	 */
	protected $contextUri;

	/**
	 * Wikidata item of the source (if it's e.g. a GLAM institution)
	 * @var string
	 */
	protected $dataItem;

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
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
	public function getUri() {
		return $this->uri;
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
	public function getContextUri() {
		return $this->contextUri;
	}

	/**
	 * @param string $contextUri
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
