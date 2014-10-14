<?php

namespace StructuredData\Transformation\Wikibase;

use RuntimeException;
use StructuredData\Transformation\TransformerFactory;
use StructuredData\Transformation\Wikibase\Encoder\ObjectMetadataEncoder;
use StructuredData\Transformation\Wikibase\Encoder\SourceEncoder;
use StructuredData\Transformation\Wikibase\Encoder\TopicEncoder;
use StructuredData\Transformation\Wikibase\Encoder\WorkEncoder;
use Wikibase\DataModel\Entity\PropertyId;
use StructuredData\Transformation\Wikibase\WikidataConstants;

/**
 * Factory for transformers using the Wikibase model together with
 * the vocabulary defined by wikidata.org.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WikidataTransformerFactory implements TransformerFactory {

	/**
	 * @see TransformerFactory::getImportTransformation(getImportTransformer
	 *
	 * @return WikibaseImportTransformer
	 */
	public function getImportTransformer() {
		$statementInfoExtractors = array(
			$this->getWorkTypeExtractor(),
		);

		return new WikibaseImportTransformer(
			$statementInfoExtractors
		);
	}

	/**
	 * @see TransformerFactory::getExportTransformation(getExportTransformer
	 */
	public function getExportTransformer() {
		$rootEncoder = $this->getObjectMetadataEncoder();
		$workEncoder = $this->getWorkEncoder();
		$sourceEncoder = $this->getSourceEncoder();
		$topicEncoder = $this->getTopicEncoder();

		$rootEncoder->setEncoders( array( $workEncoder, $sourceEncoder, $topicEncoder ) );

		$transformer = new WikibaseExportTransformer( $rootEncoder );
		return $transformer;
	}

	/**
	 * @return WorkTypeExtractor
	 */
	private function getWorkTypeExtractor() {
		return new WorkTypeExtractor(
			new PropertyId( WikidataConstants::PROP_WORKTYPE ),
			array(
				WikidataConstants::ITEM_PHOTOGRAPH => 'photograph',
				WikidataConstants::ITEM_GRAPHIC => 'graphic',
			)
		);
	}

	/**
	 * @return ObjectMetadataEncoder
	 */
	private function getObjectMetadataEncoder() {
		return new ObjectMetadataEncoder( array(
			ObjectMetadataEncoder::PROP_LOCATION => new PropertyId( WikidataConstants::PROP_LOCATION ),
		) );
	}

	/**
	 * @return WorkEncoder
	 */
	private function getWorkEncoder() {
		return new WorkEncoder( array(
			WorkEncoder::PROP_TYPE_OF_WORK => new PropertyId( WikidataConstants::PROP_TYPE_OF_WORK ),
		) );
	}

	/**
	 * @return SourceEncoder
	 */
	private function getSourceEncoder() {
		return new SourceEncoder( array(
			SourceEncoder::PROP_SOURCE => new PropertyId( WikidataConstants::PROP_SOURCE ),
		) );
	}

	/**
	 * @return TopicEncoder
	 */
	private function getTopicEncoder() {
		return new TopicEncoder( array(
			TopicEncoder::PROP_TOPIC => new PropertyId( WikidataConstants::PROP_TOPIC ),
		) );
	}
}
