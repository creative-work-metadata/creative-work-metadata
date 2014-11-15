<?php

namespace StructuredData\Transformation\Json\Decoder;


use StructuredData\Values\Topic;

class TopicDecoder extends Decoder {
	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return Topic
	 */
	public function decode( $json ) {
		$topic = new Topic();

		$this->decodeField( $json, $topic, 'name' );
		$this->decodeField( $json, $topic, 'description' );

		$this->decodeDataItem( $json, $topic );

		return $topic;
	}
}
