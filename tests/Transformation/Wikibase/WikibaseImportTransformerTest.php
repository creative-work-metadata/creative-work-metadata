<?php
namespace StructuredData\Transformation\Wikibase\Tests;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\Wikibase\WikibaseImportTransformer;
use StructuredData\Transformation\Wikibase\WorkTypeExtractor;
use Wikibase\DataModel\Claim\Claim;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Snak\PropertyValueSnak;
use Wikibase\DataModel\Statement\Statement;
use Wikibase\Item;

/**
 * @covers StructuredData\Transformation\Wikibase\WikibaseImportTransformer
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WikibaseImportTransformerTest extends \PHPUnit_Framework_TestCase {

	private function getWorkTypeExtractor() {
		$workTypeNames = array(
			'Q10' => 'photograph',
			'Q20' => 'painting',
		);

		return new WorkTypeExtractor(
			new PropertyId( 'P5' ),
			$workTypeNames
		);
	}

	private function getWikibaseImportTransformer() {
		$statementInfoExtractors = array(
			$this->getWorkTypeExtractor(),
		);

		return new WikibaseImportTransformer(
			$statementInfoExtractors
		);
	}
	/**
	 * @param string $id
	 *
	 * @return Statement
	 */
	private function makeWorkTypeStatement( $id ) {
		$pid = new PropertyId( 'P5' );
		return new Statement( new Claim( new PropertyValueSnak( $pid, new EntityIdValue( new ItemId( $id ) ) ) ) );
	}

	public function testExtractStatementInfo_terms() {
		$entity = Item::newEmpty();

		$entity->setLabel( 'en', 'Bridge' );
		$entity->setLabel( 'de', 'Brücke' );

		$entity->setDescription( 'en', 'evelated structure' );
		$entity->setDescription( 'de', 'Gebäude' );

		$transformer = $this->getWikibaseImportTransformer();
		$metadata = $transformer->transformToObjectMetadata( $entity );

		$title = new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'Bridge' ),
			new MonolingualTextValue( 'de', 'Brücke' ),
		) );
		$this->assertTrue( $title->equals( $metadata->getTitle() ), 'title' );

		$description = new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'evelated structure' ),
			new MonolingualTextValue( 'de', 'Gebäude' ),
		) );
		$this->assertTrue( $description->equals( $metadata->getDescription() ), 'description' );
	}

	public function testExtractStatementInfo_types() {
		$entity = Item::newEmpty();
		$statements = $entity->getStatements();
		$statements->addStatement( $this->makeWorkTypeStatement( 'Q10' ) );
		$entity->setStatements( $statements );

		$transformer = $this->getWikibaseImportTransformer();
		$metadata = $transformer->transformToObjectMetadata( $entity );

		$types = array( 'photograph' );
		$this->assertEquals( $types, $metadata->getFinalWork()->getTypes() );
	}

}
 