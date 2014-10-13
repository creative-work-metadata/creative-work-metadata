<?php

namespace StructuredData\Tests\Transformation\Wikibase\Encoder;

use StructuredData\Tests\Transformation\Wikibase\WikibaseTestCase;
use StructuredData\Transformation\Wikibase\Encoder\TopicEncoder;
use StructuredData\Values\Topic;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;

class TopicEncoderTest extends WikibaseTestCase {
	private function getTopicEncoder() {
		return new TopicEncoder( array(
			TopicEncoder::PROP_TOPIC => new PropertyId( 'P1' ),
		) );
	}

	public function testTopic() {
		$topic = new Topic();
		$topic->setDataItem( 'Q1' );

		$encoder = $this->getTopicEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $topic, $item );

		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P1' ), new EntityIdValue( new ItemId( 'Q1' ) ) );
	}
}
 