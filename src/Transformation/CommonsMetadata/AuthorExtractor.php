<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\MonolingualTextValue;
use StructuredData\Values\Contributor;
use StructuredData\Values\ObjectMetadata;

class AuthorExtractor implements CommonsMetadataExtractor {
	/**
	 * Q-number identifying the 'author' role
	 * @var string
	 */
	private $authorRole;

	function __construct( $authorRole ) {
		$this->authorRole = $authorRole;
	}

	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$author = $source->getField( 'Artist' );

		if ( isset( $author ) ) {
			$contributor = new Contributor();
			$contributor->setName( new MonolingualTextValue( 'en', $author ) );
			$contributor->addRole( $this->authorRole );
			$target->getFinalWork()->addContributor( $contributor );
		}
	}
}
 