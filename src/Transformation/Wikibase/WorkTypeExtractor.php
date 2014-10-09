<?php

namespace StructuredData\Transformation\Wikibase;

use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Work;
use Wikibase\DataModel\ByPropertyIdArray;
use Wikibase\DataModel\Entity\EntityId;
use Wikibase\DataModel\Entity\EntityIdValue;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Snak\PropertyValueSnak;
use Wikibase\DataModel\Statement\Statement;

/**
 * Extracts the work type from a list of statements.
 *
 * Well known work types will be mapped to human readable names,
 * unknown work types will be represented using their entity ID.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WorkTypeExtractor implements StatementInfoExtractor {

	/**
	 * @var PropertyId
	 */
	private $workTypePropertyId;

	/**
	 * @var string[]
	 */
	private $workTypeNames;

	/**
	 * @param PropertyId $workTypePropertyId
	 * @param string[] $workTypeNames Maps entity IDs to the names of well known work types.
	 */
	public function __construct( PropertyId $workTypePropertyId, $workTypeNames = array() ) {
		$this->workTypePropertyId = $workTypePropertyId;
		$this->workTypeNames = $workTypeNames;
	}

	/**
	 * @param ByPropertyIdArray $statements
	 * @param ObjectMetadata $metadata
	 */
	public function extractStatementInfo( ByPropertyIdArray $statements, ObjectMetadata $metadata ) {
		try {
			$workTypeStatements = $statements->getByPropertyId( $this->workTypePropertyId );

			$work = $metadata->getFinalWork();

			/** @var Statement $statement */
			foreach ( $workTypeStatements as $statement ) {
				$this->extractWorkType( $statement, $work );
			}
		} catch ( \OutOfBoundsException $ex ) {
			// no work type set, nothing to do
		}
	}

	/**
	 * @param Statement $statement
	 * @param Work $work
	 *
	 * @return bool true if a type was extracted
	 */
	private function extractWorkType( Statement $statement, Work $work ) {
		$mainSnak = $statement->getMainSnak();

		if ( !( $mainSnak instanceof PropertyValueSnak ) ) {
			return false;
		}

		$value = $mainSnak->getDataValue();
		if ( !( $value instanceof EntityIdValue ) ) {
			return false;
		}

		$workType = $this->getWorkTypeName( $value->getEntityId() );
		$work->addType( $workType );

		return true;
	}

	private function getWorkTypeName( EntityId $entityId ) {
		$name = $entityId->getSerialization();

		if ( isset( $this->workTypeNames[$name] ) ) {
			$name = $this->workTypeNames[$name];
		}

		return $name;
	}

}
 