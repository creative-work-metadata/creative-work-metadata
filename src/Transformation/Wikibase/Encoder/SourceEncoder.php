<?php

namespace StructuredData\Transformation\Wikibase\Encoder;

use StructuredData\Transformation\Wikibase\WikidataConstants;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Source;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;

class SourceEncoder extends Encoder {
	/**
	 * Turns $object into a list of Wikibase statements and adds them to $statementList.
	 * @param Source $object
	 * @param Item $item
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function encode( $object, Item $item ) {
		if ( ! $object instanceof Source ) {
			throw new \InvalidArgumentException;
		}

		$dataItem = $object->getDataItem();

		if ( $dataItem ) {
			$snak =  $this->createSnak( WikidataConstants::PROP_SOURCE,
				new EntityIdValue( new ItemId( $dataItem ) ) );
			$this->addStatement( $item, $snak );
		}
	}

	/**
	 * Extracts a list of child objects from $object for passing to encode()
	 * @param ObjectMetadata $object
	 * @throws \InvalidArgumentException
	 * @return Source[]
	 */
	public function extractFromParentObject( $object ) {
		if ( ! $object instanceof ObjectMetadata ) {
			throw new \InvalidArgumentException( 'should be a child of ObjectMetadataEncoder' );
		}

		return $object->getSources();
	}
}