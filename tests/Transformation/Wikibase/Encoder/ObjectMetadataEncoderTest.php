<?php

namespace StructuredData\Tests\Transformation\Wikibase\Encoder;

use DataValues\Geo\Values\LatLongValue;
use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Tests\Transformation\Wikibase\WikibaseTestCase;
use StructuredData\Transformation\Wikibase\Encoder\ObjectMetadataEncoder;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\PropertyId;

/**
 * @covers StructuredData\Transformation\Wikibase\ObjectMetadataEncoder
 */
class ObjectMetadataEncoderTest extends WikibaseTestCase {
	private function getObjectMetadataEncoder() {
		return new ObjectMetadataEncoder( array(
			ObjectMetadataEncoder::PROP_LOCATION => new PropertyId( 'P1' ),
		) );
	}

	private function getObjectMetadata() {
		$metadata = new ObjectMetadata();
		$work = new Work();
		$metadata->addWork( $work );
		return $metadata;
	}

	public function testTitle() {
		$title = new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'English text' ),
			new MonolingualTextValue( 'hu', 'Magyar szöveg' ),
		) );
		$metadata = $this->getObjectMetadata();
		$metadata->setTitle( $title );

		$encoder = $this->getObjectMetadataEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $metadata, $item );

		$labels = $item->getFingerprint()->getLabels();
		$this->assertTrue( $labels->hasTermForLanguage( 'en' ), 'No English term!' );
		$this->assertTrue( $labels->hasTermForLanguage( 'hu' ), 'No Hungarian term!' );
		$this->assertEquals( 2, $labels->count(), 'Too many terms!' );

		$this->assertEquals( 'English text', $labels->getByLanguage( 'en' )->getText() );
		$this->assertEquals( 'Magyar szöveg', $labels->getByLanguage( 'hu' )->getText() );
	}

	public function testDescription() {
		$description = new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'English text' ),
			new MonolingualTextValue( 'hu', 'Magyar szöveg' ),
		) );
		$metadata = $this->getObjectMetadata();
		$metadata->setDescription( $description );

		$encoder = $this->getObjectMetadataEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $metadata, $item );

		$descriptions = $item->getFingerprint()->getDescriptions();
		$this->assertTrue( $descriptions->hasTermForLanguage( 'en' ), 'No English term!' );
		$this->assertTrue( $descriptions->hasTermForLanguage( 'hu' ), 'No Hungarian term!' );
		$this->assertEquals( 2, $descriptions->count(), 'Too many terms!' );

		$this->assertEquals( 'English text', $descriptions->getByLanguage( 'en' )->getText() );
		$this->assertEquals( 'Magyar szöveg', $descriptions->getByLanguage( 'hu' )->getText() );
	}

	public function testLocation() {
		$location = new LatLongValue( 19, 23 );
		$metadata = $this->getObjectMetadata();
		$metadata->setLocation( $location );

		$encoder = $this->getObjectMetadataEncoder();
		$item = Item::newEmpty();
		$encoder->encode( $metadata, $item );

		$statements = $item->getStatements();
		$this->assertStatementListContainsPropertyValue( $statements, new PropertyId( 'P1' ),
			$location );
	}
}
