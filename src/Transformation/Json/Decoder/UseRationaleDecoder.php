<?php

namespace StructuredData\Transformation\Json\Decoder;

use StructuredData\Values\License;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\UseRationale;

class UseRationaleDecoder extends Decoder {
	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return UseRationale
	 */
	public function decode( $json ) {
		if ( $json['_type'] === 'license' ) {
			$useRationale = new License();
			$this->decodeDataItem( $json, $useRationale );
			$this->decodeField( $json, $useRationale, 'shortName' );
			$this->decodeField( $json, $useRationale, 'longName' );
			$this->decodeField( $json, $useRationale, 'uri' );
		} elseif ( $json['_type'] === 'publicdomain' ) {
			$useRationale = new PublicDomain();
			$this->decodeType( $json, $useRationale );
			$this->decodeDataItem( $json, $useRationale );
			$this->decodeField( $json, $useRationale, 'name' );
			$this->decodeField( $json, $useRationale, 'description' );
		}

		//$this->decodeDeepField( $json, $useRationale, 'usagePermission' );
		//$this->decodeDeepField( $json, $useRationale, 'usageRequirements' );

		return $useRationale;
	}

	/**
	 * @param array $json
	 * @param PublicDomain $useRationale
	 */
	private function decodeType( $json, $useRationale ) {
		$useRationale->setType( $json['type'] );
	}
}
