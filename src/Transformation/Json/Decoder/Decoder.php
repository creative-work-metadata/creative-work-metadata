<?php

namespace StructuredData\Transformation\Json\Decoder;

use DataValues\Deserializers\DataValueDeserializer;
use StructuredData\Values\Contributor;
use StructuredData\Values\License;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\Source;
use StructuredData\Values\Topic;
use StructuredData\Values\Work;

// FIXME use Deserializers\Deserializer compatible classes instead?
abstract class Decoder {
	/**
	 * An associative array of decoders for the children of the target object of this decoder,
	 * keyed by field name.
	 * @var Decoder[]
	 */
	protected $decoders = array();

	/**
	 * @var DataValueDeserializer
	 */
	protected $dataValueDeserializer;

	/**
	 * Decodes a value object from its JSON representation
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @return mixed
	 */
	abstract public function decode( $json );

	/**
	 * @param Decoder[] $decoders
	 * @param DataValueDeserializer $dataValueDeserializer
	 */
	public function __construct( $decoders, $dataValueDeserializer ) {
		$this->decoders = $decoders;
		$this->dataValueDeserializer = $dataValueDeserializer;
	}

	/**
	 * Decodes a value or a list of values
	 * @param array $json array representation of a JSON string
	 * @returns mixed a single value or an array of values
	 */
	protected function decodeOneOrMany( $json ) {
		if ( isset( $json['_list'] ) && isset( $json['_list'] ) ) {
			$list = array();
			foreach ( $json as $key => $value ) {
				if ( $key === '_list' ) {
					continue;
				}
				$list[] = $this->decode( $value );
			}
			return $list;
		} else {
			return $this->decode( $json );
		}
	}

	/**
	 * @param string $object
	 * @param string $fieldName
	 * @param mixed $value
	 * @throws \Exception on internal logic errors
	 */
	protected function setProtectedField( $object, $fieldName, $value ) {
		$setter = 'set' . ucfirst( $fieldName );
		if ( !method_exists( $object, $setter ) ) {
			throw new \Exception( "expected $fieldName to have a setter (object type was " . get_class( $object ) . ")" );
		}
		$object->$setter( $value );
	}

	/**
	 * Decodes a DataValues field
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @param mixed $object the object where the field should be copied
	 * @param string $fieldName field name in the JSON representation
	 * @param string $objectFieldName field name in the object, if different
	 * @throws \Exception on internal logic errors
	 */
	protected function decodeField( $json, $object, $fieldName, $objectFieldName = NULL ) {
		if ( !$objectFieldName ) {
			$objectFieldName = $fieldName;
		}
		if ( isset( $json[$fieldName] ) ) {
			$field = $json[$fieldName];
			if ( !$this->dataValueDeserializer->isDeserializerFor( $field ) ) {
				throw new \Exception( 'No deserializer for ' . var_export( $field, true ) );
			}
			$value = $this->dataValueDeserializer->deserialize( $field );
			$this->setProtectedField( $object, $objectFieldName, $value );
		}
	}

	/**
	 * Decodes a StructuredData field
	 * @param array $json a JSON object represented as an array (such as the output of json_decode)
	 * @param mixed $object the object where the field should be copied
	 * @param string $fieldName field name in the JSON representation
	 * @param string $objectFieldName field name in the object, if different
	 * @throws \Exception on internal logic errors
	 */
	protected function decodeDeepField( $json, $object, $fieldName, $objectFieldName = NULL ) {
		if ( !$objectFieldName ) {
			$objectFieldName = $fieldName;
		}

		if ( !isset( $this->decoders[$objectFieldName] ) ) {
			throw new \Exception( 'No decoder for ' . $objectFieldName );
		}

		if ( isset( $json[$fieldName] ) ) {
			$field = $json[$fieldName];
			$value = $this->decoders[$objectFieldName]->decodeOneOrMany( $field );
			$this->setProtectedField( $object, $objectFieldName, $value );
		}
	}

	/**
	 * @param array $json
	 * @param Contributor|Source|Topic|License|Work|PublicDomain $object
	 */
	protected function decodeDataItem( $json, $object ) {
		if ( isset( $json['dataItem'] ) ) {
			$object ->setDataItem( $json['dataItem'] );
		}
	}
}
