<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\Source;

class SourceEncoder extends Encoder {
	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param Source $source
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	public function encode( $source ) {
		$this->assertClass( $source );

		$json = array();

		$this->encodeField( $source, $json, 'name' );
		$this->encodeField( $source, $json, 'uri' );
		$this->encodeField( $source, $json, 'contextUri' );

		$this->encodeDataItem( $source, $json );

		return  $json;
	}
}
 