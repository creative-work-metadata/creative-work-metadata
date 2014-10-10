<?php

namespace StructuredData\Transformation\Wikibase\Encoder;

use StructuredData\Transformation\Wikibase\WikidataConstants;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;

class WorkEncoder extends Encoder {
	/**
	 * Turns $object into a list of Wikibase statements and adds them to $statementList.
	 * @param Work $object
	 * @param Item $item
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function encode( $object, Item $item ) {
		if ( ! $object instanceof Work ) {
			throw new \InvalidArgumentException;
		}

		$types = $object->getTypes();
		foreach ( $types as $type ) {
			// FIXME map human-readable type names to Q-numbers
			$snak = $this->createSnak( WikidataConstants::PROP_TYPE_OF_WORK,
				new EntityIdValue( new ItemId( $type ) ) );
			$this->addStatement( $item, $snak );
		}

		// FIXME we only have the final work for now, and that one should not be explicitly encoded
//		$dataItem = $object->getDataItem();
//		if ( $dataItem ) {
//			$snak = $this->createSnak( WikidataConstants::ORIGINAL_WORK,
//				new EntityIdValue( new ItemId( $dataItem ) ) );
//			$this->addStatement( $item, $snak );
//		}

		$this->encodeChildren( $object, $item );
	}

	/**
	 * Extracts a list of child objects from $object for passing to encode()
	 * @param ObjectMetadata $object
	 * @throws \InvalidArgumentException
	 * @return Work[]
	 */
	public function extractFromParentObject( $object ) {
		if ( $object instanceof ObjectMetadata ) {
			return array( $object->getFinalWork() );
		} else {
			throw new \InvalidArgumentException( 'should be a child of ObjectMetadataEncoder' );
		}
	}
}