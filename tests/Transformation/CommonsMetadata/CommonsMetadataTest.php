<?php
namespace StructuredData\Transformation\CommonsMetadata\Tests;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\TitleExtractor;

/**
 * @covers StructuredData\Transformation\CommonsMetadata\CommonsMetadata
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class CommonsMetadataTest extends \PHPUnit_Framework_TestCase {

	private function getCommonsMetadata( $field, $value ) {
		return new CommonsMetadata( array(
			$field => array(
				'value' => $value
			)
		) );
	}

	public function testNotSet() {
		$metadata = new CommonsMetadata( array() );

		$this->assertFalse( $metadata->hasField( 'Foo' ) );
		$this->assertNull( $metadata->getField( 'Foo' ) );
		$this->assertEmpty( $metadata->getList( 'Foo' ) );
		$this->assertNull( $metadata->getMultilangValue( 'Foo' ) );
	}

	public function provideGetRaw() {
		return array(
			'null' => array(
				null,
				null
			),

			'string' => array(
				'foo',
				'foo',
			),

			'array' => array(
				array( 'foo', 'bar' ),
				array( 'foo', 'bar' ),
			),

			'html' => array(
				'<p>foo</p>',
				'<p>foo</p>',
			),
		);
	}

	/**
	 * @dataProvider provideGetRaw
	 */
	public function testGetRaw( $value, $expected ) {
		$metadata = $this->getCommonsMetadata( 'Foo', $value );

		$this->assertEquals( $expected, $metadata->getField( 'Foo' ) );
	}

	public function provideGetList() {
		return array(
			'null' => array(
				null,
				array()
			),

			'string' => array(
				'foo',
				array( 'foo' ),
			),

			'array' => array(
				array( 'foo', 'bar' ),
				array( 'foo', 'bar' ),
			),

			'list' => array(
				'foo|bar',
				array( 'foo', 'bar' ),
			),

			'html' => array(
				'<p>foo</p>',
				array( 'foo' ),
			),
		);
	}

	/**
	 * @dataProvider provideGetList
	 */
	public function testList( $value, $expected ) {
		$metadata = $this->getCommonsMetadata( 'Foo', $value );

		$this->assertEquals( $expected, $metadata->getList( 'Foo' ) );
	}

	public function provideGetMultilangValue() {
		return array(
			'string' => array(
				'foo',
				array( 'en' =>  new MonolingualTextValue( 'en', 'foo' ) ),
			),

			'map' => array(
				array( 'en' => 'foo', 'de' => 'bar', '_type' => 'lang' ),
				array(
					'en' =>  new MonolingualTextValue( 'en', 'foo' ),
					'de' =>  new MonolingualTextValue( 'de', 'bar' )
				),
			),

			'html' => array(
				'<p>foo</p>',
				array( 'en' =>  new MonolingualTextValue( 'en', 'foo' ) ),
			),
		);
	}

	/**
	 * @dataProvider provideGetMultilangValue
	 */
	public function testGetMultilangValue( $value, $expectedTexts ) {
		$metadata = $this->getCommonsMetadata( 'Foo', $value );

		$values = $metadata->getMultilangValue( 'Foo' );

		$this->assertNotNull( $values );
		$this->assertEquals( $expectedTexts, $values->getTexts() );
	}

	/**
	 * @expectedException \Exception
	 */
	public function testGetMultilangValueWithInvalidValue() {
		$metadata = $this->getCommonsMetadata( 'Foo', array( 'foo', 'bar', 'baz', '_type' => 'ul' ) );
		$metadata->getMultilangValue( 'Foo' );
	}

}
