<?php

namespace StructuredData\Transformation\Json\Decoder;

use StructuredData\Values\Source;

class SourceDecoder extends Decoder {
	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return Source
	 */
	public function decode( $json ) {
		$source = new Source();

		$this->decodeField( $json, $source, 'name' );
		$this->decodeField( $json, $source, 'uri' );
		$this->decodeField( $json, $source, 'contextUri' );

		$this->decodeDataItem( $json, $source );

		return $source;
	}
}
