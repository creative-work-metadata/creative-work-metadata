<?php

use DataValues\Geo\Values\LatLongValue;
use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use DataValues\Serializers\DataValueSerializer;
use StructuredData\Transformation\Wikibase\WikidataTransformerFactory;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Values\Source;
use StructuredData\Values\Topic;
use StructuredData\Values\Work;
use Wikibase\DataModel\SerializerFactory;

require_once( __DIR__ . '/vendor/autoload.php' );

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

$work = new Work();
$work->setTitle( $metadata->getTitle() );
$work->setTypes( array( Work::TYPE_PAINTING, Work::TYPE_GRAPHIC ) );

$source = new Source();
$source->setDataItem( 'Q777' );

$topic1 = new Topic();
$topic1->setDataItem( 'Q9998' );
$topic2 = new Topic();
$topic2->setDataItem( 'Q9999' );

$metadata->addWork( $work );
$metadata->addSource( $source );
$metadata->addTopic( $topic1 );
$metadata->addTopic( $topic2 );

$transformerFactory = new WikidataTransformerFactory();
$item = $transformerFactory->getExportTransformer()->transformToExternalModel( $metadata );

$serializerFactory = new SerializerFactory( new DataValueSerializer() );
$serializer = $serializerFactory->newEntitySerializer();

var_dump( $serializer->serialize( $item ) );
