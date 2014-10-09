<?php

namespace StructuredData\Transformation\Wikibase;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use InvalidArgumentException;
use StructuredData\Transformation\ImportTransformer;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;
use Wikibase\DataModel\ByPropertyIdArray;
use Wikibase\DataModel\Entity\Entity;
use Wikibase\DataModel\Term\Fingerprint;
use Wikibase\DataModel\Term\Term;
use Wikibase\DataModel\Term\TermList;
use Wikibase\Item;

/**
 * WikibaseImportTransformer
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WikibaseImportTransformer implements ImportTransformer {

	/**
	 * @var StatementInfoExtractor[]
	 */
	private $statementInfoExtractors;

	/**
	 * @param StatementInfoExtractor[] $statementInfoExtractors
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( array $statementInfoExtractors ) {
		foreach ( $statementInfoExtractors as $extractor ) {
			if ( !( $extractor instanceof StatementInfoExtractor ) ) {
				throw new InvalidArgumentException( '$statementInfoExtractors must contain StatementInfoExtractor objects only' );
			}
		}

		$this->statementInfoExtractors = $statementInfoExtractors;
	}

	/**
	 * @param Entity $entity
	 *
	 * @throws InvalidArgumentException
	 * @return ObjectMetadata
	 */
	public function transformToObjectMetadata( $entity ) {
		//FIXME: Use the MediaInfo class here instead of Item, one MediaInfo exists!
		if ( !( $entity instanceof Item ) ) {
			throw new \InvalidArgumentException( '$entity must be an Item' );
		}

		$metadata = new ObjectMetadata();
		$metadata->setWorks( array( new Work() ) );

		$this->extractLexicalInfo( $entity->getFingerprint(), $metadata );

		$statements = $entity->getStatements()->getBestStatementPerProperty();

		$statementsByProperty = new ByPropertyIdArray( $statements->toArray() );
		$statementsByProperty->buildIndex();

		$this->extractStatementInfo( $statementsByProperty, $metadata );

		return $metadata;
	}

	/**
	 * @param Fingerprint $fingerprint
	 * @param ObjectMetadata $metadata
	 */
	private function extractLexicalInfo( Fingerprint $fingerprint, ObjectMetadata $metadata ) {
		$title = $this->termListToValue( $fingerprint->getLabels() );
		$description = $this->termListToValue( $fingerprint->getDescriptions() );

		$metadata->setTitle( $title );
		$metadata->setDescription( $description );
	}

	/**
	 * @param TermList $terms
	 *
	 * @return MultilingualtextValue
	 */
	private function termListToValue( TermList $terms ) {
		$monolangValues = array();

		/** @var Term $term */
		foreach ( $terms as $term ) {
			$lang = $term->getLanguageCode();
			$text = $term->getText();
			$monolangValues[$lang] = new MonolingualTextValue( $lang, $text );
		}

		return new MultilingualTextValue( $monolangValues );
	}

	/**
	 * @param ByPropertyIdArray $statements
	 * @param ObjectMetadata $metadata
	 */
	private function extractStatementInfo( ByPropertyIdArray $statements, ObjectMetadata $metadata ) {
		foreach ( $this->statementInfoExtractors as $extractor ) {
			$extractor->extractStatementInfo( $statements, $metadata );
		}
	}
}
 