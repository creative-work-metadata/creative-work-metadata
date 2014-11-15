<?php

namespace StructuredData\Transformation\Json;

use DataValues\Deserializers\DataValueDeserializer;
use StructuredData\Transformation\Json\Decoder\ContributorDecoder;
use StructuredData\Transformation\Json\Decoder\ObjectMetadataDecoder;
use StructuredData\Transformation\Json\Decoder\SourceDecoder;
use StructuredData\Transformation\Json\Decoder\TopicDecoder;
use StructuredData\Transformation\Json\Decoder\UseRationaleDecoder;
use StructuredData\Transformation\Json\Decoder\WorkDecoder;
use StructuredData\Values\ObjectMetadata;

class ImportTransformer {
	/**
	 * Transforms a JSON string into an ObjectMetadata object
	 * @param string $json
	 * @returns ObjectMetadata
	 * @throws InvalidJsonException
	 */
	public function import( $json ) {
		$json = json_decode( $json, true );
		if ( is_null( $json ) ) {
			throw new InvalidJsonException( json_last_error_msg(), json_last_error() );
		}

		$dataValueDeserializer = new DataValueDeserializer( array(
			'boolean' => 'DataValues\BooleanValue',
			'number' => 'DataValues\NumberValue',
			'string' => 'DataValues\StringValue',
			'unknown' => 'DataValues\UnknownValue',
			'geocoordinate' => 'DataValues\Geo\Values\LatLongValue',
			'monolingualtext' => 'DataValues\MonolingualTextValue',
			'multilingualtext' => 'DataValues\MultilingualTextValue',
		) );

		$sourceDecoder = new SourceDecoder( array(), $dataValueDeserializer );
		$topicDecoder = new TopicDecoder( array(), $dataValueDeserializer );
		$contributorDecoder = new ContributorDecoder( array(), $dataValueDeserializer );
		$useRationaleDecoder = new UseRationaleDecoder( array(), $dataValueDeserializer );

		$workDecoder = new WorkDecoder( array(
			'contributors' => $contributorDecoder,
			'useRationales' => $useRationaleDecoder,
		), $dataValueDeserializer );

		$objectMetadataDecoder = new ObjectMetadataDecoder( array(
			'sources' => $sourceDecoder,
			'works' => $workDecoder,
			'topics' => $topicDecoder,
		), $dataValueDeserializer );

		return $objectMetadataDecoder->decode( $json );
	}
}
