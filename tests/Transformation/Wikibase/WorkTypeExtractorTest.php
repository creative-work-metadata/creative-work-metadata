<?php
namespace StructuredData\Transformation\Wikibase\Tests;

use StructuredData\Transformation\Wikibase\WorkTypeExtractor;
use StructuredData\Values\ObjectMetadata;
use Wikibase\DataModel\ByPropertyIdArray;
use Wikibase\DataModel\Claim\Claim;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\ItemId;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Snak\PropertyValueSnak;
use Wikibase\DataModel\Statement\Statement;

/**
 * @covers StructuredData\Transformation\Wikibase\WorkTypeExtractor
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WorkTypeExtractorTest extends \PHPUnit_Framework_TestCase {

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

	/**
	 * @param string $id
	 *
	 * @return Statement
	 */
	private function makeWorkTypeStatement( $id ) {
		$pid = new PropertyId( 'P5' );
		return new Statement( new Claim( new PropertyValueSnak( $pid, new EntityIdValue( new ItemId( $id ) ) ) ) );
	}

	public function provideExtractStatementInfo() {
		return array(
			'empty' => array(
				array(),
				array()
			),
			'photograph' => array(
				array( $this->makeWorkTypeStatement( 'Q10' ) ),
				array( 'photograph' )
			),
			'multi' => array(
				array( $this->makeWorkTypeStatement( 'Q20' ), $this->makeWorkTypeStatement( 'Q23' ) ),
				array( 'painting', 'Q23' )
			),
		);
	}

	/**
	 * @dataProvider provideExtractStatementInfo()
	 */
	public function testExtractStatementInfo( array $statements, array $expected ) {
		$extractor = $this->getWorkTypeExtractor();

		$statementArray = new ByPropertyIdArray( $statements );
		$statementArray->buildIndex();

		$metadata = new ObjectMetadata();
		$extractor->extractStatementInfo( $statementArray, $metadata );

		$types = $metadata->getFinalWork()->getTypes();
		$this->assertEquals( $expected, $types );
	}

}
 