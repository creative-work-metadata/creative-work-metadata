<?php

namespace StructuredData\Tests\Transformation\Wikibase\Encoder;

use StructuredData\Tests\Transformation\Wikibase\WikibaseTestCase;
use StructuredData\Transformation\Wikibase\Encoder\WorkEncoder;
use StructuredData\Values\Work;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;

class WorkEncoderTest extends WikibaseTestCase {
	private function getWorkEncoder() {
		return new WorkEncoder( array(
			WorkEncoder::PROP_TYPE_OF_WORK => new PropertyId( 'P1' ),
		) );
	}

	public function testTypes() {
		$work = new Work();
		$work->setTypes( array( 'Q1', 'Q2' ) );

		$encoder = $this->getWorkEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $work, $item );

		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P1' ), new EntityIdValue( new ItemId( 'Q1' ) ) );
		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P1' ), new EntityIdValue( new ItemId( 'Q2' ) ) );
	}

	public function testTypeMapping() {
		$work = new Work();
		$work->setTypes( array( 'Q1', 'Q2' ) );
		$this->markTestIncomplete( 'type mapping not implemented yet' );
	}
}
