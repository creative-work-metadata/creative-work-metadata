<?php
namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadataImportTransformer;
use StructuredData\Transformation\CommonsMetadata\TitleExtractor;

/**
 * @covers StructuredData\Transformation\CommonsMetadata\CommonsMetadataImportTransformer
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class CommonsMetadataImportTransformerTest extends \PHPUnit_Framework_TestCase {

	private function getCommonsMetadataImportTransformer() {
		return new CommonsMetadataImportTransformer( array(
			new TitleExtractor()
		) );
	}

	public function testExtractStatementInfo( ) {
		$data = array(
			'ObjectName' => array(
				'value' => 'Test Image'
			)
		);

		$commonsMetadata = new CommonsMetadata( $data );

		$transformer = $this->getCommonsMetadataImportTransformer();
		$metadata = $transformer->transformToObjectMetadata( $commonsMetadata );

		$title = new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'Test Image' ),
		) );

		$this->assertTrue( $title->equals( $metadata->getTitle() ), 'title' );
	}

}
 