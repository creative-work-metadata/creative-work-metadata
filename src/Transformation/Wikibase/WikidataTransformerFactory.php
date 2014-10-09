<?php

namespace StructuredData\Transformation\Wikibase;

use RuntimeException;
use StructuredData\Transformation\TransformerFactory;
use Wikibase\DataModel\Entity\PropertyId;

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
		throw new RuntimeException( 'not yet implemented' );
	}

	/**
	 * @return WorkTypeExtractor
	 */
	private function getWorkTypeExtractor() {
		return new WorkTypeExtractor(
			new PropertyId( 'P290' ),
			array(
				'Q805' => 'photograph',
				'Q815' => 'graphic',
			)
		);
	}
}
 