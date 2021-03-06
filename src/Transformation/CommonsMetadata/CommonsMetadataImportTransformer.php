<?php

namespace StructuredData\Transformation\CommonsMetadata;

use InvalidArgumentException;
use StructuredData\Transformation\ImportTransformer;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;

/**
 * Import transformer for data structures generated by the CommonsMetadata extension.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class CommonsMetadataImportTransformer implements ImportTransformer {

	/**
	 * @var CommonsMetadataExtractor[]
	 */
	private $extractors;

	/**
	 * @param CommonsMetadataExtractor[] $extractors
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( array $extractors ) {
		foreach ( $extractors as $extractor ) {
			if ( !( $extractor instanceof CommonsMetadataExtractor ) ) {
				throw new InvalidArgumentException( '$extractors must contain CommonsMetadataExtractor objects only' );
			}
		}

		$this->extractors = $extractors;
	}

	/**
	 * @param CommonsMetadata $commonsMetadata
	 *
	 * @throws InvalidArgumentException
	 * @return ObjectMetadata
	 */
	public function transformToObjectMetadata( $commonsMetadata ) {
		if ( !( $commonsMetadata instanceof CommonsMetadata ) ) {
			throw new \InvalidArgumentException( '$entity must be an CommonsMetadata' );
		}

		$target = new ObjectMetadata();
		$target->setWorks( array( new Work() ) );

		$this->extractMetadata( $commonsMetadata, $target );

		return $target;
	}

	/**
	 * @param CommonsMetadata $commonsMetadata
	 * @param ObjectMetadata $metadata
	 */
	private function extractMetadata( CommonsMetadata $commonsMetadata, ObjectMetadata $metadata ) {
		foreach ( $this->extractors as $extractor ) {
			$extractor->extractMetadata( $commonsMetadata, $metadata );
		}
	}

}
 