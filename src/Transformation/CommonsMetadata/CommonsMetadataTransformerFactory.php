<?php

namespace StructuredData\Transformation\CommonsMetadata;

use RuntimeException;
use StructuredData\Transformation\TransformerFactory;
use StructuredData\Values\PublicDomain;

/**
 * Factory for transformers using the model defined by the CommonsMetadata extension.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class CommonsMetadataTransformerFactory implements TransformerFactory {

	/**
	 * @see TransformerFactory::getImportTransformation(getImportTransformer
	 *
	 * @return CommonsMetadataImportTransformer
	 */
	public function getImportTransformer() {
		$extractors = array(
			new TitleExtractor(),
			new DescriptionExtractor(),
			$this->getLicenseExtractor(),
		);

		return new CommonsMetadataImportTransformer( $extractors );
	}

	/**
	 * @see TransformerFactory::getExportTransformation(getExportTransformer
	 */
	public function getExportTransformer() {
		throw new RuntimeException( 'not yet implemented' );
	}

	/**
	 * @return CommonsMetadataExtractor
	 */
	private function getLicenseExtractor() {
		return new LicenseExtractor(
			array(
				'Public domain' => new PublicDomain(),
			)
		);
	}
}
 