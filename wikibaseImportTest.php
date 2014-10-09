<?php

use StructuredData\Transformation\Wikibase\WikibaseServices;
use StructuredData\Transformation\Wikibase\WikidataTransformerFactory;

require_once( __DIR__ . '/vendor/autoload.php' );

if ( !isset( $argv[1] ) ) {
	die( "USGAE: wikibaseImportTest <itemid>\n" );
}

$item = $argv[1];
$url = "http://test.wikidata.org/wiki/Special:EntityData/$item.json";

$json = file_get_contents( $url );

if ( !$json ) {
	die( "ERROR: failed to load data from $url\n" );
}

$data = json_decode( $json, JSON_OBJECT_AS_ARRAY );

if ( !$data ) {
	die( "ERROR: failed to decode JSON from $url\n" );
}

$wikibaseServices = new WikibaseServices();
$entityDeserializer = $wikibaseServices->getEntityDeserializer();

$itemData = reset( $data['entities'] );
$item = $entityDeserializer->deserialize( $itemData );

$transformerFactory = new WikidataTransformerFactory();
$importer = $transformerFactory->getImportTransformer();

$metadata = $importer->transformToObjectMetadata( $item );

print_r( $metadata );
