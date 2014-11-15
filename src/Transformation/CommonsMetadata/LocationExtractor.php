<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\Geo\Values\LatLongValue;
use StructuredData\Values\ObjectMetadata;

class LocationExtractor implements CommonsMetadataExtractor {
	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$latitude = $source->getField( 'GPSLatitude' );
		$longitude = $source->getField( 'GPSLongitude' );

		if ( isset( $latitude ) && isset ( $longitude ) ) {
			$target->setLocation( new LatLongValue( (float)$latitude, (float)$longitude ) );
		}
	}

}
 