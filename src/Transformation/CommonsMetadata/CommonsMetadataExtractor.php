<?php

namespace StructuredData\Transformation\CommonsMetadata;

use StructuredData\Values\ObjectMetadata;

/**
 * Interface for extractors that operator on the output of the CommonsMetadata extension.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
interface CommonsMetadataExtractor {

	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target );
}
