<?php

namespace Transformation\Json\Tests;

use DataValues\Geo\Values\LatLongValue;
use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\Json\ExportTransformer;
use StructuredData\Values\ObjectMetadata;

class ExportTransformerTest extends \PHPUnit_Framework_TestCase {
	public function testBasicExport() {
		$metadata = new ObjectMetadata();

		$metadata->setTitle(new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'My hamster Berta' ),
			new MonolingualTextValue( 'de', 'Mein Hamster Berta' ),
		) ) );

		$metadata->setDescription(new MultilingualTextValue( array(
			new MonolingualTextValue( 'en', 'This is my pet hamster Berta. It has four legs.' ),
			new MonolingualTextValue( 'de', 'Dieser ist mein Hamster Berta. Er hat vier Beine.' ),
		) ) );

		$metadata->setLocation( new LatLongValue( 15, 28 ) );

		$transformer = new ExportTransformer();
		$json = $transformer->export( $metadata );

		$this->assertInternalType( 'string', $json );

		$this->assertRegExp( '/my pet hamster Berta/', $json );
		$this->assertRegExp( '/mein Hamster Berta/', $json );
		$this->assertRegExp( '/15/', $json );
		$this->assertRegExp( '/28/', $json );
	}
}
 