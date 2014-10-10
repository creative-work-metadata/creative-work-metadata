<?php

use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadataTransformerFactory;

require_once( __DIR__ . '/vendor/autoload.php' );

if ( !isset( $argv[1] ) ) {
	die( "USGAE: commonsImportTest <itemid>\n" );
}

$item = $argv[1];
$url = "http://commons.wikimedia.org/w/api.php?action=query&titles=File:$item&prop=imageinfo&iiprop=extmetadata&format=json&iiextmetadatamultilang";

$json = file_get_contents( $url );

if ( !$json ) {
	die( "ERROR: failed to load data from $url\n" );
}

$data = json_decode( $json, JSON_OBJECT_AS_ARRAY );

if ( !$data ) {
	die( "ERROR: failed to decode JSON from $url\n" . json_last_error() . "\n" );
}

$data = reset( $data['query']['pages'] );
$data = $data['imageinfo'][0]['extmetadata'];
$commonsData = new CommonsMetadata( $data );

$transformerFactory = new CommonsMetadataTransformerFactory();
$importer = $transformerFactory->getImportTransformer();

$metadata = $importer->transformToObjectMetadata( $commonsData );

print_r( $metadata );
