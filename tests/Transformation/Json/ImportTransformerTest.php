<?php

namespace StructuredData\Transformation\Json\Tests;

use DataValues\MultilingualTextValue;
use StructuredData\Transformation\Json\ImportTransformer;

/**
 * @covers ImportTransformer
 */
class ImportTransformerTest extends \PHPUnit_Framework_TestCase {
	public function testEmptyImport() {
		// FIXME not really valid but we don't check required fields yet
		$json = '{}';

		$transformer = new ImportTransformer();

		$objectMetadata = $transformer->import( $json );

		$this->assertInstanceOf( 'StructuredData\Values\ObjectMetadata', $objectMetadata );
	}

	public function testBasicImport() {
		$transformer = new ImportTransformer();
		$json = '{"title":{"value":[{"text":"My hamster Berta","language":"en"},{"text":"Mein Hamster Berta","language":"de"}],"type":"multilingualtext"},"description":{"value":[{"text":"This is my pet hamster Berta. It has four legs.","language":"en"},{"text":"Dieser ist mein Hamster Berta. Er hat vier Beine.","language":"de"}],"type":"multilingualtext"},"location":{"value":{"latitude":15,"longitude":28},"type":"geocoordinate"}}';

		$objectMetadata = $transformer->import( $json );

		$this->assertInstanceOf( 'StructuredData\Values\ObjectMetadata', $objectMetadata );
		$this->assertEquals( 'My hamster Berta', $this->getTextByLanguage( $objectMetadata->getTitle(), 'en' ) );
		$this->assertEquals( 'Mein Hamster Berta', $this->getTextByLanguage( $objectMetadata->getTitle(), 'de' ) );
		$this->assertEquals( 'This is my pet hamster Berta. It has four legs.', $this->getTextByLanguage( $objectMetadata->getDescription(), 'en' ) );
		$this->assertEquals( 'Dieser ist mein Hamster Berta. Er hat vier Beine.', $this->getTextByLanguage( $objectMetadata->getDescription(), 'de' ) );
		$this->assertEquals( 15, $objectMetadata->getLocation()->getLatitude() );
		$this->assertEquals( 28, $objectMetadata->getLocation()->getLongitude() );
	}

	public function testImportError() {
		$transformer = new ImportTransformer();

		$json = '!!';

		$this->setExpectedException( 'StructuredData\Transformation\Json\InvalidJsonException' );
		$transformer->import( $json );
	}

	/**
	 * @param MultilingualTextValue $text
	 * @param string $languageCode
	 * @returns string|null
	 * TODO upstream this?
	 */
	protected function getTextByLanguage( MultilingualTextValue $text, $languageCode ) {
		foreach ( $text->getTexts() as $monoText ) {
			if ( $monoText->getLanguageCode() === $languageCode ) {
				return $monoText->getText();
			}
		}
	}
}
