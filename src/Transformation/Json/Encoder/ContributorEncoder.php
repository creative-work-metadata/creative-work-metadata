<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\Contributor;

class ContributorEncoder extends Encoder {
	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param Contributor $contributor
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	public function encode( $contributor ) {
		$this->assertClass( $contributor );

		$json = array();

		$this->encodeField( $contributor, $json, 'name' );
		$this->encodeField( $contributor, $json, 'uri' );
		$this->encodeField( $contributor, $json, 'wikiAccount' );

		$this->encodeRoles( $contributor, $json );
		$this->encodeDataItem( $contributor, $json );

		return $json;
	}

	private function encodeRoles( Contributor $contributor, array &$json ) {
		$json['roles'] = $contributor->getRoles();
	}
}
 