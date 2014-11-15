<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\Topic;

class TopicEncoder extends Encoder {
	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param Topic $topic
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	public function encode( $topic ) {
		$this->assertClass( $topic );

		$json = array();

		$this->encodeField( $topic, $json, 'name' );
		$this->encodeField( $topic, $json, 'description' );

		$this->encodeDataItem( $topic, $json );

		return $json;
	}
}
