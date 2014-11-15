<?php

namespace StructuredData\Transformation\Json\Encoder;

use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\License;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\UseRationale;

class UseRationaleEncoder extends Encoder {
	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param UseRationale $useRationale
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	public function encode( $useRationale ) {
		$this->assertClass( $useRationale );

		$json = array();

		//$this->encodeDeepField( $useRationale, $json, 'usagePermission' );
		//$this->encodeDeepField( $useRationale, $json, 'usageRequirements' );

		if ( $useRationale instanceof License ) {
			$json['_type'] = 'license';
			$this->encodeDataItem( $useRationale, $json );
			$this->encodeField( $useRationale, $json, 'shortName' );
			$this->encodeField( $useRationale, $json, 'longName' );
			$this->encodeField( $useRationale, $json, 'uri' );
		} elseif ( $useRationale instanceof PublicDomain ) {
			$json['_type'] = 'publicdomain';
			$this->encodeType( $useRationale, $json );
			$this->encodeDataItem( $useRationale, $json );
			$this->encodeField( $useRationale, $json, 'name' );
			$this->encodeField( $useRationale, $json, 'description' );
		}

		return $json;
	}

	protected function assertClass( $object ) {
		if ( !( $object instanceof License || $object instanceof PublicDomain ) ) {
			parent::assertClass( $object );
		}
	}

	/**
	 * @param PublicDomain $useRationale
	 * @param array $json
	 */
	private function encodeType( $useRationale, &$json ) {
		$json['type'] = $useRationale->getType();
	}
}
