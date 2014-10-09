<?php

namespace StructuredData\Values;

class UsagePermission {
	/** @var string */
	protected $uri;

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