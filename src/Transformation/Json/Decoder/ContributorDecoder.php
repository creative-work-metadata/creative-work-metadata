<?php

namespace StructuredData\Transformation\Json\Decoder;

use StructuredData\Values\Contributor;

class ContributorDecoder extends Decoder {
	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return Contributor
	 */
	public function decode( $json ) {
		$contributor = new Contributor();

		$this->decodeField( $json, $contributor, 'name' );
		$this->decodeField( $json, $contributor, 'uri' );
		$this->decodeField( $json, $contributor, 'wikiAccount' );

		$this->decodeRoles( $json, $contributor );
		$this->decodeDataItem( $json, $contributor );

		return $contributor;
	}

	private function decodeRoles( $json, Contributor $contributor ) {
		$contributor->setRoles( $json['roles'] );
	}

}
