<?php
namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\MonolingualTextValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\DescriptionExtractor;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * @covers StructuredData\Transformation\CommonsMetadata\DescriptionExtractor
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class DescriptionExtractorTest extends \PHPUnit_Framework_TestCase {

	public function testExtractMetadataWithMissingValue() {
		$commonsMetadata = new CommonsMetadata( array() );
		$extractor = new DescriptionExtractor();

		$metadata = new ObjectMetadata();
		$metadata->setWorks( array( new Work() ) );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$description = $metadata->getDescription();
		$this->assertNull( $description );
	}

	public function provideExtractMetadata() {
		return array(
			'string' => array(
				array(
					'ImageDescription' => array(
						'value' => 'Foo'
					)
				),
				array(
					'en' => new MonolingualTextValue( 'en', 'Foo' ),
				)
			),

			'map' => array(
				array(
					'ImageDescription' => array(
						'value' => array(
							'en' => 'Foo',
							'de' => 'Bar',
							'_type' => 'lang',
						),
					)
				),
				array(
					'en' => new MonolingualTextValue( 'en', 'Foo' ),
					'de' => new MonolingualTextValue( 'de', 'Bar' ),
				)
			),
		);
	}

	/**
	 * @dataProvider provideExtractMetadata()
	 */
	public function testExtractMetadata( array $data, array $expectedTexts ) {
		$commonsMetadata = new CommonsMetadata( $data );
		$extractor = new DescriptionExtractor();

		$metadata = new ObjectMetadata();
		$metadata->setWorks( array( new Work() ) );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$description = $metadata->getDescription();
		$this->assertNotNull( $description );
		$this->assertEquals( $expectedTexts, $description->getTexts() );
	}

}
