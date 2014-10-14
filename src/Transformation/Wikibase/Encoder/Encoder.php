<?php

namespace StructuredData\Transformation\Wikibase\Encoder;

use DataValues\DataValue;
use DataValues\MultilingualTextValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Reference;
use Wikibase\DataModel\References;
use Wikibase\DataModel\Snak\PropertyValueSnak;
use Wikibase\DataModel\Snak\Snak;
use Wikibase\DataModel\Snak\Snaks;
use Wikibase\DataModel\Term\Term;
use Wikibase\DataModel\Term\TermList;

/**
 * Encoders turn some StructuredData\Values object into a set of wikibase statements.
 */
abstract class Encoder {
	/**
	 * @var Encoder[]
	 */
	protected $childEncoders = array();

	/**
	 * An associative array mapping internal property names to Wikibase ids.
	 * @var PropertyId[]
	 */
	protected $propertyMap;

	public function __construct( array $propertyMap = array() ) {
		$this->propertyMap = $propertyMap;
	}

	/**
	 * Turns $object into a list of Wikibase statements and adds them to $statementList.
	 * @param mixed $object one of the StructuredData\Values\* objects
	 * @param Item $item
	 * @return void
	 */
	abstract public function encode( $object, Item $item );

	/**
	 * Extracts a list of child objects from $object for passing to encode()
	 * @param mixed $object
	 * @return array
	 */
	abstract public function extractFromParentObject( $object );

	/**
	 * Sets up the encoding tree structure.
	 * FIXME this should be extracted into the object which manages dependency injection
	 * @param Encoder[] $encoders
	 */
	public function setEncoders( array $encoders ) {
		$this->childEncoders = $encoders;
	}

	public function encodeChildren( $object, Item $item ) {
		foreach ( $this->childEncoders as $encoder ) {
			foreach ( $encoder->extractFromParentObject( $object ) as $childObject ) {
				$encoder->encode( $childObject, $item );
			}
		}
	}

	/**
	 * @param string $pNumber a property id in the form 'P123'
	 * @param DataValue $dataValue
	 * @return PropertyValueSnak
	 */
	protected function createSnak( $pNumber, DataValue $dataValue ) {
		$propertyId = new PropertyId( $pNumber );
		$snak = new PropertyValueSnak( $propertyId, $dataValue );

		return $snak;
	}

	/**
	 * @param MultilingualTextValue $multiText
	 * @return TermList
	 */
	protected function convertMultilingualTextValueToTermList( MultilingualTextValue $multiText ) {
		$termList = new TermList();
		foreach ( $multiText->getTexts() as $monoText ) {
			$term = new Term( $monoText->getLanguageCode(), $monoText->getText() );
			$termList->setTerm( $term );
		}
		return $termList;
	}

	/**
	 * @param Item $item
	 * @param Snak $mainSnak
	 * @param Snak[]|Snaks|null $qualifiers
	 * @param Reference[]|References|null $references
	 */
	protected function addStatement( $item, Snak $mainSnak, $qualifiers = null, $references = null ) {
		$guid = $this->generateRandomString();
		$item->getStatements()->addNewStatement( $mainSnak, $qualifiers, $references, $guid );
	}

	protected function generateRandomString( $length = 16 ) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ( $i = 0; $i < $length; $i++ ) {
			$randomString .= $characters[ rand( 0, strlen( $characters ) - 1 ) ];
		}
		return $randomString;
	}
}
