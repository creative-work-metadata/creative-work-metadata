<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;

/**
 * Value object representing the output of the CommonsMetadata extension
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class CommonsMetadata {

	/**
	 * @var array
	 */
	private $data;

	/**
	 * @param array $data Nested array structure as produced by the CommonsMetadata extension
	 */
	public function __construct( array $data ) {
		$this->data = $data;
	}

	/**
	 * @param string $field
	 *
	 * @return bool
	 */
	public function hasField( $field ) {
		return isset( $this->data[$field]['value'] );
	}

	/**
	 * Returns the raw value of a field.
	 *
	 * @param string $field
	 *
	 * @return string|array|null
	 */
	public function getField( $field ) {
		if ( isset( $this->data[$field]['value'] ) ) {
			$value = $this->data[$field]['value'];

			if ( !is_array( $value ) ) {
				$value = (string)$value;
			}

			return $value;
		}

		return null;
	}

	/**
	 * Returns a field value as a list of string.
	 * If the field is not set, an empty array will be returned.
	 * All text is sanitized.
	 *
	 * @param string $field
	 *
	 * @return string[]
	 */
	public function getList( $field ) {
		$raw = $this->getField( $field );

		if ( $raw === null ) {
			return array();
		}

		if ( !is_array( $raw ) ) {
			$raw = explode( '|', $raw );
		}

		foreach ( $raw as $i => $text ) {
			$raw[$i] = $this->sanitize( $raw[$i] );
		}

		return $raw;
	}

	/**
	 * Returns a MultilingualtextValue representation of the field.
	 * If the field is not set, an empty MultilingualTextValue will be returned.
	 * All text is sanitized.
	 *
	 * @param string $field
	 *
	 * @return MultilingualTextValue|null
	 */
	public function getMultilangValue( $field ) {
		$raw = $this->getField( $field );

		if ( $raw === null ) {
			return new MultilingualTextValue( array() );
		}

		if ( !is_array( $raw ) ) {
			$raw = array( 'en' => $raw );
		}

		return $this->makeMultilingualTextValue( $raw );
	}

	/**
	 * @param array $texts A map of language code to the corresponding texts
	 *
	 * @return MultilingualTextValue
	 */
	private function makeMultilingualTextValue( array $texts ) {
		$monolangTexts = array();

		foreach ( $texts as $lang => $text ) {
			if ( $lang === '_type' )  {
				continue;
			}

			$text = $this->sanitize( $text );
			$monolangTexts[$lang] = new MonolingualTextValue( $lang, $text );
		}

		return new MultilingualTextValue( $monolangTexts );
	}

	private function sanitize( $text ) {
		$text = trim( $text );
		$text = strip_tags( $text );
		return $text;
	}

}
