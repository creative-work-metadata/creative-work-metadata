<?php

namespace StructuredData\Transformation\CommonsMetadata\Tests;
use StructuredData\Transformation\CommonsMetadata\AuthorExtractor;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Values\Contributor;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * @covers AuthorExtractor
 */
class AuthorExtractorTest extends \PHPUnit_Framework_TestCase {
	public function testExtractMetadata() {
		$commonsMetadata = new CommonsMetadata( array( 'Artist' => array( 'value' => 'E. Elmer' ) ) );
		$extractor = new AuthorExtractor( 'Q123' );

		$metadata = new ObjectMetadata();
		$metadata->addWork( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$contributors = $metadata->getFinalWork()->getContributors();

		$this->assertNotEmpty( $contributors );
		$this->assertCount( 1, $contributors );
		$this->assertEquals( array( 'Q123' ), $contributors[0]->getRoles() );
		$this->assertEquals( 'E. Elmer', $contributors[0]->getName()->getText() );
	}

	public function testExtractMetadataWhenMissing() {
		$commonsMetadata = new CommonsMetadata( array() );
		$extractor = new AuthorExtractor( 'Q123' );

		$metadata = new ObjectMetadata();
		$metadata->addWork( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$contributors = $metadata->getFinalWork()->getContributors();

		$this->assertEmpty( $contributors );
	}
}
