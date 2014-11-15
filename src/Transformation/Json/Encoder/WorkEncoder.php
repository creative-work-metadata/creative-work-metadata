<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\Work;

class WorkEncoder extends Encoder {
	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param Work $work
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	public function encode( $work ) {
		$this->assertClass( $work );

		$json = array();

		$this->encodeField( $work, $json, 'title' );
		$this->encodeDataItem( $work, $json );

		//$this->encodeDeepField( $work, $json, 'events' );
		$this->encodeDeepField( $work, $json, 'contributors' );
		$this->encodeDeepField( $work, $json, 'useRationales' );

		return $json;
	}
}
