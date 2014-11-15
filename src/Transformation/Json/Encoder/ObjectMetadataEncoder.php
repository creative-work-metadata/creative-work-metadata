<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\ObjectMetadata;

class ObjectMetadataEncoder extends Encoder {
	/**
	 * Transforms an ObjectMetadata object into an array representation of a JSON object
	 * @param ObjectMetadata $objectMetadata
	 * @returns array JSON representation of the object
	 * @throws InvalidArgumentException
	 */
	public function encode( $objectMetadata ) {
		$this->assertClass( $objectMetadata );

		$json = array();

		$this->encodeField( $objectMetadata, $json, 'title' );
		$this->encodeField( $objectMetadata, $json, 'description' );
		$this->encodeField( $objectMetadata, $json, 'location' );

		$this->encodeDeepField( $objectMetadata, $json, 'sources' );
		$this->encodeDeepField( $objectMetadata, $json, 'works' );
		//$this->encodeDeepField( $objectMetadata, $json, 'usageRestrictions' );
		$this->encodeDeepField( $objectMetadata, $json, 'topics' );

		return $json;
	}
}
