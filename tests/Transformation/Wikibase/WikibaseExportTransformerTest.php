<?php

namespace StructuredData\Tests\Transformation\Wikibase;
use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\Wikibase\Encoder\ObjectMetadataEncoder;
use StructuredData\Transformation\Wikibase\Encoder\TopicEncoder;
use StructuredData\Transformation\Wikibase\WikibaseExportTransformer;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Topic;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;

/**
 * @covers StructuredData\Transformation\Wikibase\WikibaseExportTransformer
 */
class WikibaseExportTransformerTest extends WikibaseTestCase {
	private function getObjectMetadata() {
		$metadata = new ObjectMetadata();
		$metadata->setTitle( new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'English text' ),
			new MonolingualTextValue( 'hu', 'Magyar szöveg' ),
		) ) );

		$topic1 = new Topic();
		$topic1->setDataItem( 'Q1' );
		$topic2 = new Topic();
		$topic2->setDataItem( 'Q2' );
		$metadata->addTopic( $topic1 );
		$metadata->addTopic( $topic2 );

		return $metadata;
	}

	public function getWikibaseExportTransformer() {
		$rootEncoder = new ObjectMetadataEncoder( array(
			ObjectMetadataEncoder::PROP_LOCATION => new PropertyId( 'P1' ),
		) );
		$sourceEncoder = new TopicEncoder( array(
			TopicEncoder::PROP_TOPIC => new PropertyId( 'P2' ),
		) );
		$rootEncoder->setEncoders( array( $sourceEncoder ) );
		$transformer = new WikibaseExportTransformer( $rootEncoder );
		return $transformer;
	}

	public function testExport() {
		$metadata = $this->getObjectMetadata();
		$transformer = $this->getWikibaseExportTransformer();
		$item = $transformer->transformToExternalModel( $metadata );

		$this->assertEquals( 'English text', $item->getFingerprint()->getLabel( 'en' )->getText() );
		$this->assertEquals( 'Magyar szöveg', $item->getFingerprint()->getLabel( 'hu' )->getText() );
		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P2' ), new EntityIdValue( new ItemId( 'Q1' ) ) );
		$this->assertStatementListContainsPropertyValue( $item->getStatements(),
			new PropertyId( 'P2' ), new EntityIdValue( new ItemId( 'Q2' ) ) );
	}
}
