<?php

namespace StructuredData\Transformation\Json\Decoder;

use StructuredData\Values\ObjectMetadata;

class ObjectMetadataDecoder extends Decoder {
	/**
	 * Decodes ObjectMetadata from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return ObjectMetadata
	 */
	public function decode( $json ) {
		$objectMetadata = new ObjectMetadata();

		$this->decodeField( $json, $objectMetadata, 'title' );
		$this->decodeField( $json, $objectMetadata, 'description' );
		$this->decodeField( $json, $objectMetadata, 'location' );

		$this->decodeDeepField( $json, $objectMetadata, 'sources' );
		$this->decodeDeepField( $json, $objectMetadata, 'works' );
		//$this->decodeDeepField( $json, $objectMetadata, 'usageRestrictions' );
		$this->decodeDeepField( $json, $objectMetadata, 'topics' );

		return $objectMetadata;
	}
}
