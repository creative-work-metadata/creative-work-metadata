<?php

namespace StructuredData\Transformation\CommonsMetadata\Tests;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\SourceExtractor;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * @covers SourceExtractor
 */
class SourceExtractorTest extends \PHPUnit_Framework_TestCase {
	public function testExtractMetadata() {
		$commonsMetadata = new CommonsMetadata( array( 'Credit' => array( 'value' => 'National Archives' ) ) );
		$extractor = new SourceExtractor();

		$metadata = new ObjectMetadata();
		$metadata->addWork( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$sources = $metadata->getSources();

		$this->assertNotEmpty( $sources );
		$this->assertCount( 1, $sources );
		$this->assertEquals( 'National Archives', reset( $sources[0]->getName()->getTexts() )->getText() );
	}

	public function testExtractMetadataWhenMissing() {
		$commonsMetadata = new CommonsMetadata( array() );
		$extractor = new SourceExtractor();

		$metadata = new ObjectMetadata();
		$metadata->addWork( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$sources = $metadata->getSources();

		$this->assertEmpty( $sources );
	}
}
 