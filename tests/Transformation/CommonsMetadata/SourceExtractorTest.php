<?php

namespace StructuredData\Transformation\CommonsMetadata\Tests;
use DataValues\MultilingualTextValue;
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

		$metadata = new ObjectMetadata( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$sources = $metadata->getSources();

		$this->assertNotEmpty( $sources );
		$this->assertCount( 1, $sources );
		$this->assertEqualsInLanguage( 'National Archives', 'en', $sources[0]->getName() );
	}

	public function testExtractMetadataWithMultilingualText() {
		$commonsMetadata = new CommonsMetadata( array( 'Credit' => array( 'value' => array(
			'_type' => 'lang',
			'en' => 'National Archives',
			'hu' => 'Nemzeti Archívum',
		) ) ) );
		$extractor = new SourceExtractor();

		$metadata = new ObjectMetadata( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$sources = $metadata->getSources();

		$this->assertNotEmpty( $sources );
		$this->assertCount( 1, $sources );
		$this->assertEqualsInLanguage( 'National Archives', 'en', $sources[0]->getName() );
		$this->assertEqualsInLanguage( 'Nemzeti Archívum', 'hu', $sources[0]->getName() );
	}

	public function testExtractMetadataWhenMissing() {
		$commonsMetadata = new CommonsMetadata( array() );
		$extractor = new SourceExtractor();

		$metadata = new ObjectMetadata( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$sources = $metadata->getSources();

		$this->assertEmpty( $sources );
	}

	protected function assertEqualsInLanguage( $expectedText, $languageCode, MultilingualTextValue $text, $message = '' ) {
		$monolingualTexts = $text->getTexts();
		foreach ( $monolingualTexts as $monolingualText ) {
			if ( $monolingualText->getLanguageCode() === $languageCode ) {
				$this->assertEquals( $expectedText, $monolingualText->getText(), $message );
				return;
			}
		}
		$this->fail( "Could not assert that text equals '$expectedText' in '$languageCode' - language not found" );
	}
}
