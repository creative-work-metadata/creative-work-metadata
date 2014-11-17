<?php

namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\Geo\Parsers\GlobeCoordinateParser;
use DataValues\Geo\Values\LatLongValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\LocationExtractor;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * @covers LocationExtractor
 */
class LocationExtractorTest extends \PHPUnit_Framework_TestCase {

	public function provideExtractMetadata() {
		return array(
			'empty' => array(
				array(),
				null,
			),
			'integer' => array(
				array(
					'GPSLatitude' => array( 'value' => '17' ),
					'GPSLongitude' => array( 'value' => '28' ),
				),
				new LatLongValue( 17, 28 ),
			),
			'float' => array(
				array(
					'GPSLatitude' => array( 'value' => '17.123' ),
					'GPSLongitude' => array( 'value' => '28.456' ),
				),
				new LatLongValue( 17.123, 28.456 ),
			),
		);
	}

	/**
	 * @param array $expectedResult
	 * @param array $data
	 * @dataProvider provideExtractMetadata
	 */
	public function testExtractMetadata( array $data, $expectedResult  ) {
		$commonsMetadata = new CommonsMetadata( $data );
		$extractor = new LocationExtractor( new GlobeCoordinateParser() );

		$metadata = new ObjectMetadata( new Work() );

		$extractor->extractMetadata( $commonsMetadata, $metadata );

		$location = $metadata->getLocation();

		if ( $expectedResult === null ) {
			$this->assertNull( $location );
		} else {
			$this->assertNotNull( $location );
			$latLong = $location->getLatLong();
			$this->assertEquals( $expectedResult, $latLong );
		}
	}

}
