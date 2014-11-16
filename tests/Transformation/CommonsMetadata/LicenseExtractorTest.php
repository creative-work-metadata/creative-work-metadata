<?php
namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\LicenseExtractor;
use StructuredData\Values\License;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\Work;

/**
 * @covers StructuredData\Transformation\CommonsMetadata\LicenseExtractor
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class LicenseExtractorTest extends \PHPUnit_Framework_TestCase {

	private function getLicenseExtractor() {
		return new LicenseExtractor( array(
			'Public domain' => new PublicDomain(),
		) );
 	}

	public function provideExtractMetadata() {
		$publicDomain = new PublicDomain();
		$ccBySa = new License();

		$ccBySa->setShortName( new MultilingualTextValue( array( 'en' => new MonolingualTextValue( 'en', 'CC-BY-SA' ) ) ) );
		$ccBySa->setLongName( new MultilingualTextValue( array( 'en' => new MonolingualTextValue( 'en', 'Creative Commons Attribution Share-Alike' ) ) ) );

		return array(
			'empty' => array(
				array(),
				array()
			),

			'well known short name' => array(
				array(
					'LicenseShortName' => array(
						'value' => 'Public domain'
					)
				),
				array( $publicDomain )
			),

			'unknown license' => array(
				array(
					'LicenseShortName' => array(
						'value' => 'CC-BY-SA'
					),
					'UsageTerms' => array(
						'value' => 'Creative Commons Attribution Share-Alike'
					)
				),
				array( $ccBySa )
			),
		);
	}

	/**
	 * @dataProvider provideExtractMetadata()
	 */
	public function testExtractMetadata( array $data, array $expected ) {
		$commonsMetadata = new CommonsMetadata( $data );
		$extractor = $this->getLicenseExtractor();

		$metadata = new ObjectMetadata();
		$metadata->setWorks( array( new Work() ) );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$rationales = $metadata->getFinalWork()->getUseRationales();
		$this->assertEquals( $expected, $rationales );
	}

}
