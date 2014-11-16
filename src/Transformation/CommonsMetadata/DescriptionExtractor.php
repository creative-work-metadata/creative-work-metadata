<?php

namespace StructuredData\Transformation\CommonsMetadata;

use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\ByPropertyIdArray;

/**
 * Extracts the file's description.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class DescriptionExtractor implements CommonsMetadataExtractor {

	/**
	 * @param ByPropertyIdArray $statements
	 * @param ObjectMetadata $metadata
	 */
	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$description = $source->getMultilangValue( 'ImageDescription' );

		if ( reset( $description->getTexts() ) !== null ) {
			$target->setDescription( $description );
		}
	}

}
