<?php

namespace StructuredData\Transformation\Json\Decoder;


use StructuredData\Values\Work;

class WorkDecoder extends Decoder {
	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return Work
	 */
	public function decode( $json ) {
		$work = new Work();

		$this->decodeField( $json, $work, 'title' );
		$this->decodeDataItem( $json, $work );

		//$this->decodeDeepField( $json, $work, 'events' );
		$this->decodeDeepField( $json, $work, 'contributors' );
		$this->decodeDeepField( $json, $work, 'useRationales' );

		return $work;
	}
}
