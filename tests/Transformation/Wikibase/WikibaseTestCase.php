<?php

namespace StructuredData\Tests\Transformation\Wikibase;

use DataValues\DataValue;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Snak\PropertyValueSnak;
use Wikibase\DataModel\Snak\Snak;
use Wikibase\DataModel\Statement\StatementList;

class WikibaseTestCase extends \PHPUnit_Framework_TestCase {
	public function assertStatementListContainsProperty( StatementList $statementList,
			PropertyId $propertyId, $message = '' ) {

		if ( $message ) {
			$message = $message . PHP_EOL;
		}

		$propertyFound = false;
		foreach ( $statementList->getAllSnaks() as $snak ) {
			/** @var $snak Snak */
			if ( $snak->getPropertyId()->equals( $propertyId) ) {
				$propertyFound = true;
			}
		}
		$this->assertTrue( $propertyFound, 'Property ' . $propertyId->getSerialization()
			. ' not found' . $message );
	}

	public function assertStatementListContainsPropertyValue( StatementList $statementList,
			PropertyId $propertyId, DataValue $value, $message = '' ) {

		if ( $message ) {
			$message = $message . PHP_EOL;
		}

		$propertyFound = $valueFound = false;
		$values = array();
		foreach ( $statementList->getAllSnaks() as $snak ) {
			/** @var $snak Snak */
			if ( $snak->getPropertyId()->equals( $propertyId) ) {
				$propertyFound = true;
				if ( $snak->getType() == 'value' ) {
					/** @var $snak PropertyValueSnak */
					$values[] = $snak->getDataValue();
					if ( $snak->getDataValue()->equals( $value ) ) {
						$valueFound = true;
					}
				}
			}
		}
		$this->assertTrue( $propertyFound, 'Property ' . $propertyId->getSerialization()
			. ' not found' . $message );
		$this->assertNotEmpty( $values, 'Property ' . $propertyId->getSerialization()
			. ' found but does not have known value' .$message );
		$this->assertTrue( $valueFound, 'Property ' . $propertyId->getSerialization()
			. ' found but does not have the correct value. Values found:' . PHP_EOL
			. implode( PHP_EOL, array_map( function ( $v ) {
				/** @var $v DataValue */
				return print_r( $v->getArrayValue(), true );
			}, $values ) ) . $message );
	}
}