<?php

namespace StructuredData\Transformation\Wikibase;

use StructuredData\Transformation\ExportTransformer;
use StructuredData\Transformation\Wikibase\Encoder\ObjectMetadataEncoder;
use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\Entity\Item;
use Wikibase\DataModel\Entity\ItemId;

class WikibaseExportTransformer implements ExportTransformer {
	/** @var ObjectMetadataEncoder */
	protected $objectMetadataEncoder;

	/**
	 * @param ObjectMetadataEncoder $objectMetadataEncoder
	 */
	public function __construct( $objectMetadataEncoder ) {
		$this->objectMetadataEncoder = $objectMetadataEncoder;
	}

	/**
	 * @param ObjectMetadata $metadata
	 *
	 * @return Item
	 */
	public function transformToExternalModel( ObjectMetadata $metadata ) {
		$item = Item::newEmpty();
		$item->setId( new ItemId( 'Q1' ) );
		$this->objectMetadataEncoder->encode( $metadata, $item );
		return $item;
	}
}