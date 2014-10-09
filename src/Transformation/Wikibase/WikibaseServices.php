<?php

namespace StructuredData\Transformation\Wikibase;
use DataValues\Deserializers\DataValueDeserializer;
use Wikibase\DataModel\DeserializerFactory;
use Wikibase\DataModel\Entity\BasicEntityIdParser;

/**
 * WikibaseServices
 *
 * @license GPL 2+
 * @author Daniel Kinzler
 */
class WikibaseServices {

	/**
	 * @return \Deserializers\DispatchableDeserializer
	 */
	public function getEntityDeserializer() {
		return $this->getDeserializerFactory()->newEntityDeserializer();
	}

	/**
	 * @return BasicEntityIdParser
	 */
	private function getEntityIdParser() {
		return new BasicEntityIdParser();
	}

	/**
	 * @return DeserializerFactory
	 */
	private function getDeserializerFactory() {
		return new DeserializerFactory(
			new DataValueDeserializer( array(
				'boolean' => 'DataValues\BooleanValue',
				'number' => 'DataValues\NumberValue',
				'string' => 'DataValues\StringValue',
				'unknown' => 'DataValues\UnknownValue',
/*				'globecoordinate' => 'DataValues\Geo\Values\GlobeCoordinateValue',
				'monolingualtext' => 'DataValues\MonolingualTextValue',
				'multilingualtext' => 'DataValues\MultilingualTextValue',
				'quantity' => 'DataValues\QuantityValue',
				'time' => 'DataValues\TimeValue',
*/				'wikibase-entityid' => 'Wikibase\DataModel\Entity\EntityIdValue',
			) ),
			$this->getEntityIdParser()
		);
	}

}
 