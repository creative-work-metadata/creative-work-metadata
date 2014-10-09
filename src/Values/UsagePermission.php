<?php

namespace StructuredData\Values;

/**
 * A UsagePermission is a proof that the license was authorized by the copyright holder
 * (e.g. an email in which the copyright holder gives permission to use the image).
 */
class UsagePermission {
	/**
	 * An URI pointing to the document in which the right holder gives permission.
	 * @var string
	 */
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