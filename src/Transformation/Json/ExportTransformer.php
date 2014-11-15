<?php

namespace StructuredData\Transformation\Json;

use DataValues\Serializers\DataValueSerializer;
use StructuredData\Transformation\Json\Encoder\ContributorEncoder;
use StructuredData\Transformation\Json\Encoder\ObjectMetadataEncoder;
use StructuredData\Transformation\Json\Encoder\SourceEncoder;
use StructuredData\Transformation\Json\Encoder\TopicEncoder;
use StructuredData\Transformation\Json\Encoder\UseRationaleEncoder;
use StructuredData\Transformation\Json\Encoder\WorkEncoder;
use StructuredData\Values\ObjectMetadata;

class ExportTransformer {
	/**
	 * Transforms a metadata object hierarchy into JSON
	 * @param ObjectMetadata $metadata
	 * @returns array JSON representation of the metadata
	 * @throws \Exception on internal error
	 */
	public function export( ObjectMetadata $metadata ) {
		$dataValueSerializer = new DataValueSerializer();

		$sourceEncoder = new SourceEncoder( array(), $dataValueSerializer );
		$topicEncoder = new TopicEncoder( array(), $dataValueSerializer );
		$contributorEncoder = new ContributorEncoder( array(), $dataValueSerializer );
		$useRationaleEncoder = new UseRationaleEncoder( array(), $dataValueSerializer );

		$workEncoder = new WorkEncoder( array(
			'contributors' => $contributorEncoder,
			'useRationales' => $useRationaleEncoder,
		), $dataValueSerializer );

		$objectMetadataEncoder = new ObjectMetadataEncoder( array(
			'sources' => $sourceEncoder,
			'works' => $workEncoder,
			'topics' => $topicEncoder,
		), $dataValueSerializer );

		$data = $objectMetadataEncoder->encode( $metadata );
		$json = json_encode( $data );
		if ( $json === FALSE ) {
			throw new \Exception( 'Internal error: ' . json_last_error_msg(), json_last_error() );
		}
		return $json;
	}
}
