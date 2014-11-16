<?php

namespace StructuredData\Transformation\CommonsMetadata;

use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\ByPropertyIdArray;

/**
 * Extracts the file's title.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class TitleExtractor implements CommonsMetadataExtractor {

	/**
	 * @param ByPropertyIdArray $statements
	 * @param ObjectMetadata $metadata
	 */
	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$title = $source->getMultilangValue( 'ObjectName' );

		if ( reset( $title->getTexts() ) !== null ) {
			$target->setTitle( $title );
		}
	}

}
