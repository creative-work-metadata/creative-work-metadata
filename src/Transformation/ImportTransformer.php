<?php

namespace StructuredData\Transformation;

use StructuredData\Values\ObjectMetadata;

/**
 * A transformation to the creative-works data model.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
interface ImportTransformer {

	/**
	 * @param mixed $mixed
	 *
	 * @return ObjectMetadata
	 */
	public function transformToObjectMetadata( $mixed );

}
