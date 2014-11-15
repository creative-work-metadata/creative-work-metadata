<?php

namespace StructuredData\Transformation\Json\Encoder;

use DataValues\Serializers\DataValueSerializer;
use StructuredData\Transformation\Json\InvalidArgumentException;
use StructuredData\Values\Contributor;
use StructuredData\Values\License;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\Source;
use StructuredData\Values\Topic;
use StructuredData\Values\Work;

// FIXME use Serializers/Serializer compatible classes instead?
abstract class Encoder {
	/**
	 * An associative array of encoders for the children of the target object of this encoder,
	 * keyed by field name.
	 * @var Encoder[]
	 */
	protected $encoders = array();

	/**
	 * @var DataValueSerializer
	 */
	protected $dataValueSerializer;

	/**
	 * Transforms a StructuredData object into an array representation of a JSON object
	 * @param mixed $object
	 * @returns array
	 * @throws InvalidArgumentException
	 */
	abstract public function encode( $object );

	/**
	 * @param Encoder[] $encoders
	 * @param DataValueSerializer $dataValueSerializer
	 */
	public function __construct( $encoders, $dataValueSerializer ) {
		$this->encoders = $encoders;
		$this->dataValueSerializer = $dataValueSerializer;
	}

	/**
	 * Asserts that the encoder works for the object
	 * @param mixed $object
	 * @throws InvalidArgumentException
	 */
	protected function assertClass( $object ) {
		$thisClass = explode( '\\', preg_replace( '/Encoder$/', '', get_called_class() ) );
		$thisClass = end( $thisClass );

		$objectClass = explode( '\\', get_class( $object ) );
		$objectClass = end( $objectClass );

		if ( $objectClass !== $thisClass ) {
			throw new InvalidArgumentException( "Expected $thisClass, got $objectClass" );
		}

	}

	/**
	 * @param string $object
	 * @param string $fieldName
	 * @return mixed
	 * @throws \Exception on internal logic errors
	 */
	protected function getProtectedField( $object, $fieldName ) {
		$getter = 'get' . ucfirst( $fieldName );
		if ( !method_exists( $object, $getter ) ) {
			throw new \Exception( "expected $fieldName to have a getter (object type was " . get_class( $object ) . ")" );
		}
		$field = $object->$getter();
		return $field;
	}

	/**
	 * Encodes a DataValues field
	 * @param mixed $object the object from where the field should be copied
	 * @param array $json a JSON object (represented as an array) where the encoded field should be put
	 * @param string $fieldName field name in the object
	 * @param string $jsonFieldName field name in the JSON array, if different
	 * @throws \Exception on internal logic errors
	 */
	protected function encodeField( $object, &$json, $fieldName, $jsonFieldName = NULL ) {
		if ( !$jsonFieldName ) {
			$jsonFieldName = $fieldName;
		}
		$field = $this->getProtectedField( $object, $fieldName );
		if ( is_null( $field ) ) {
			// FIXME enforce required fields
			return;
		}
		if ( !$this->dataValueSerializer->isSerializerFor( $field ) ) {
			throw new \Exception( 'No serializer for ' . get_class( $field ) );
		}
		$json[$jsonFieldName] = $this->dataValueSerializer->serialize( $field );
	}

	/**
	 * Encodes a StructuredData field
	 * @param mixed $object the object from the field should be copied
	 * @param array $json a JSON object (represented as an array) where the encoded field should be put
	 * @param string $fieldName field name in the object
	 * @param string $jsonFieldName field name in the JSON array, if different
	 * @throws \Exception on internal logic errors
	 */
	protected function encodeDeepField( $object, &$json, $fieldName, $jsonFieldName = NULL ) {
		if ( !$jsonFieldName ) {
			$jsonFieldName = $fieldName;
		}

		if ( !isset( $this->encoders[$fieldName] ) ) {
			throw new \Exception( 'No encoder for ' . $fieldName );
		}

		$field = $this->getProtectedField( $object, $fieldName );
		if ( is_null( $field ) ) {
			// FIXME enforce required fields
			return;
		}

		if ( is_array( $field ) ) {
			$jsonList = array( '_list' => true );
			foreach ( $field as $value ) {
				$jsonList[] = $this->encoders[$fieldName]->encode( $value );
			}
			$json[$jsonFieldName] = $jsonList;
		} else {
			$json[$jsonFieldName] = $this->encoders[$fieldName]->encode( $field );
		}
	}

	/**
	 * @param Contributor|Source|Topic|License|Work|PublicDomain $object
	 * @param array $json
	 */
	protected function encodeDataItem( $object, array &$json ) {
		$dataItem =  $object->getDataItem();
		if ( isset( $dataItem ) ) {
			$json['dataItem'] = $dataItem;
		}
	}
}
