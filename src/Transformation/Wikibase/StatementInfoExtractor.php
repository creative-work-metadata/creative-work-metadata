<?php

namespace StructuredData\Transformation\Wikibase;

use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\ByPropertyIdArray;

/**
 * Interface for extractors that operator on statement lists.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
interface StatementInfoExtractor {

	/**
	 * @param ByPropertyIdArray $statements
	 * @param ObjectMetadata $metadata
	 */
	public function extractStatementInfo( ByPropertyIdArray $statements, ObjectMetadata $metadata );
}
 