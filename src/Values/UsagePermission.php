<?php

namespace StructuredData\Values;

use DataValues\MonolingualTextValue;

/**
 * A UsagePermission is a proof that the license was authorized by the copyright holder
 * (e.g. an email in which the copyright holder gives permission to use the image).
 */
class UsagePermission {
	/**
	 * An URI pointing to the document in which the right holder gives permission.
	 * @var MonolingualTextValue
	 */
	protected $uri;

	/**
	 * @return MonolingualTextValue
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param MonolingualTextValue $uri
	 */
	public function setUri( MonolingualTextValue $uri ) {
		$this->uri = $uri;
	}
}