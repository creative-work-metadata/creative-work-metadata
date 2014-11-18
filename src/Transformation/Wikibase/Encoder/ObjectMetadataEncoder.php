<?php

namespace StructuredData\Transformation\Wikibase\Encoder;

use DataValues\Geo\Values\GlobeCoordinateValue;
use DataValues\MultilingualTextValue;
use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\Entity\Item;
use StructuredData\Transformation\Wikibase\WikidataConstants;

class ObjectMetadataEncoder extends Encoder {

	/**
	 * Turns $object into a list of Wikibase statements and adds them to $statementList.
	 * @param ObjectMetadata $object
	 * @param Item $item
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function encode( $object, Item $item ) {
		if ( ! $object instanceof ObjectMetadata ) {
			throw new \InvalidArgumentException;
		}

		$title = $object->getTitle();
		$description = $object->getDescription();
		$location = $object->getLocation();

		if ( $title ) {
			$this->encodeTitle( $title, $item );
		}
		if ( $description ) {
			$this->encodeDescription( $description, $item );
		}
		if ( $location ) {
			$this->encodeLocation( $location, $item );
		}

		$this->encodeChildren( $object, $item );
	}

	/**
	 * @param MultilingualTextValue $title
	 * @param Item $item
	 */
	protected function encodeTitle( MultilingualTextValue $title, Item $item ) {
		$terms = $this->convertMultilingualTextValueToTermList( $title );
		$item->getFingerprint()->setLabels($terms );
	}

	/**
	 * @param MultilingualTextValue $description
	 * @param Item $item
	 */
	protected function encodeDescription( MultilingualTextValue $description, Item $item ) {
		$terms = $this->convertMultilingualTextValueToTermList( $description );
		$item->getFingerprint()->setLabels($terms );
	}

	/**
	 * @param GlobeCoordinateValue $location
	 * @param Item $item
	 */
	protected function encodeLocation( GlobeCoordinateValue $location, Item $item ) {
		$snak = $this->createSnak( WikidataConstants::PROP_LOCATION, $location );
		$this->addStatement( $item, $snak );
	}

	/**
	 * Extracts a list of child objects from $object for passing to encode()
	 * @param mixed $object
	 * @throws \LogicException
	 * @return array
	 */
	public function extractFromParentObject( $object ) {
		throw new \LogicException( 'not implemented, this is the root type' );
	}
}
