<?php

namespace StructuredData\Tests\Transformation\Wikibase\Encoder;

use StructuredData\Tests\Transformation\Wikibase\WikibaseTestCase;
use StructuredData\Transformation\Wikibase\Encoder\SourceEncoder;
use StructuredData\Values\Source;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;

class SourceEncoderTest extends WikibaseTestCase {
	private function getSourceEncoder() {
		return new SourceEncoder( array(
			SourceEncoder::PROP_SOURCE => new PropertyId( 'P1' ),
		) );
	}

	public function testSource() {
		$source = new Source();
		$source->setDataItem( 'Q1' );

		$encoder = $this->getSourceEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $source, $item );

		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P1' ), new EntityIdValue( new ItemId( 'Q1' ) ) );
	}
}
