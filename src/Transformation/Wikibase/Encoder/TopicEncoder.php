<?php

namespace StructuredData\Transformation\Wikibase\Encoder;

use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Topic;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Snak\PropertyValueSnak;

class TopicEncoder extends Encoder {
	const PROP_TOPIC = 'topic';

	/**
	 * Turns $object into a list of Wikibase statements and adds them to $statementList.
	 * @param Topic $object
	 * @param Item $item
	 * @throws \InvalidArgumentException
	 * @return void
	 */
	public function encode( $object, Item $item ) {
		if ( ! $object instanceof Topic ) {
			throw new \InvalidArgumentException;
		}

		$dataItem = $object->getDataItem();

		if ( $dataItem ) {
			$snak =  new PropertyValueSnak( $this->propertyMap[self::PROP_TOPIC],
				new EntityIdValue( new ItemId( $dataItem ) ) );
			$this->addStatement( $item, $snak );
		}
	}

	/**
	 * Extracts a list of child objects from $object for passing to encode()
	 * @param ObjectMetadata $object
	 * @throws \InvalidArgumentException
	 * @return array
	 */
	public function extractFromParentObject( $object ) {
		if ( ! $object instanceof ObjectMetadata ) {
			throw new \InvalidArgumentException( 'should be a child of ObjectMetadataEncoder' );
		}

		return $object->getTopics();
	}
}