<?php
namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\MonolingualTextValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\TitleExtractor;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * @covers StructuredData\Transformation\CommonsMetadata\TitleExtractor
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class TitleExtractorTest extends \PHPUnit_Framework_TestCase {

	public function provideExtractMetadata() {
		return array(
			'empty' => array(
				array(),
				array()
			),

			'string' => array(
				array(
					'ObjectName' => array(
						'value' => 'Foo'
					)
				),
				array(
					'en' => new MonolingualTextValue( 'en', 'Foo' ),
				)
			),

			'map' => array(
				array(
					'ObjectName' => array(
						'value' => array(
							'en' => 'Foo',
							'de' => 'Bar',
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
		$extractor = new TitleExtractor();

		$metadata = new ObjectMetadata();
		$metadata->setWorks( array( new Work() ) );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$title = $metadata->getTitle();
		$this->assertNotNull( $title );
		$this->assertEquals( $expectedTexts, $title->getTexts() );
	}

}
 