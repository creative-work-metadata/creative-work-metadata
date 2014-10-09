<?php

namespace StructuredData\Transformation;

/**
 * Interface for factories that supply transformers for a specific target repository or format.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
interface TransformerFactory {

	/**
	 * @return ImportTransformer
	 */
	public function getImportTransformer();

	/**
	 * @return ExportTransformer
	 */
	public function getExportTransformer();

}
 