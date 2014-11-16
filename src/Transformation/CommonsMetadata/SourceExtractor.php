<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Source;

class SourceExtractor implements CommonsMetadataExtractor {

	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$sourceName = $source->getField( 'Credit' );

		if ( $sourceName !== null ) {
			$sourceField = new Source();
			$sourceField->setName( new MultilingualTextValue( array(
				new MonolingualTextValue( 'en', $sourceName ),
			) ) );
			$target->addSource( $sourceField );
		}
	}

}
