<?php

namespace StructuredData\Transformation;

use StructuredData\Values\ObjectMetadata;

/**
 * A transformation of the creative-works data model to another model.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
interface ExportTransformer {

	/**
	 * @param ObjectMetadata $metadata
	 *
	 * @return mixed
	 */
	public function transformToExternalModel( ObjectMetadata $metadata );

}
