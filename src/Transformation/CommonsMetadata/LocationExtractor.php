<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\Geo\Parsers\GlobeCoordinateParser;
use StructuredData\Values\ObjectMetadata;

class LocationExtractor implements CommonsMetadataExtractor {

	/**
	 * @var GlobeCoordinateParser
	 */
	protected $coordinateParser;

	public function __construct( $coordinateParser ) {
		$this->coordinateParser = $coordinateParser;
	}

	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$latitude = $source->getField( 'GPSLatitude' );
		$longitude = $source->getField( 'GPSLongitude' );

		if ( isset( $latitude ) && isset ( $longitude ) ) {
			$coordinateValue = $this->coordinateParser->parse( "$latitude,$longitude" );
			$target->setLocation( $coordinateValue );
		}
	}

}
