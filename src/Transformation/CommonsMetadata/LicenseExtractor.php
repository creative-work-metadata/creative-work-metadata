<?php

namespace StructuredData\Transformation\CommonsMetadata;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use InvalidArgumentException;
use StructuredData\Values\License;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\UseRationale;

/**
 * Extracts the file's description.
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class LicenseExtractor implements CommonsMetadataExtractor {

	/**
	 * Rationales by license short name.
	 * @var UseRationale[]
	 */
	private $useRationales;

	/**
	 * @param UseRationale[] $useRationales Rationales by license short name.
	 *
	 * @throws InvalidArgumentException
	 */
	public function __construct( array $useRationales ) {
		foreach ( $useRationales as $rationale ) {
			if ( !( $rationale instanceof UseRationale ) ) {
				throw new InvalidArgumentException( '$useRationales must contain UseRationale objects only' );
			}
		}

		$this->useRationales = $useRationales;
	}

	/**
	 * @param CommonsMetadata $source
	 * @param ObjectMetadata $target
	 */
	public function extractMetadata( CommonsMetadata $source, ObjectMetadata $target ) {
		$shortNames = $source->getList( 'LicenseShortName' );
		$longNames = $source->getList( 'UsageTerms' );

		$work = $target->getFinalWork();

		foreach ( $shortNames as $i => $shortName ) {
			$longName = isset( $longNames[$i] ) ? $longNames[$i] : null;
			$useRationale = $this->getUseRationale( $shortName, $longName );

			if ( $useRationale ) {
				$work->addUseRationale( $useRationale );
			}
		}
	}

	/**
	 * @param string $shortName
	 * @param string|null $longName
	 *
	 * @return UseRationale
	 */
	private function getUseRationale( $shortName, $longName ) {
		if ( isset( $this->useRationales[$shortName] ) ) {
			return $this->useRationales[$shortName];
		}

		$license = new License();
		$license->setShortName( $this->fakeMultilingualText( 'en', $shortName ) );

		if ( $longName !== null && $longName !== $shortName ) {
			$license->setLongName( $this->fakeMultilingualText( 'en', $longName ) );
		}

		return $license;
	}

	private function fakeMultilingualText( $lang, $text ) {
		return new MultilingualTextValue( array(
			$lang => new MonolingualTextValue( $lang, $text ),
		) );
	}

}
 