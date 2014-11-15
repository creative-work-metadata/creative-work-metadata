<?php

use StructuredData\Transformation\CommonsMetadata\CommonsMetadata;
use StructuredData\Transformation\CommonsMetadata\CommonsMetadataTransformerFactory;
use StructuredData\Transformation\Json\ExportTransformer;

require_once( __DIR__ . '/../../vendor/autoload.php' );

$filename = $argv[1];
if ( substr( $filename, 0, 5 ) === 'File:' )  {
	$filename = substr( $filename, 5 );
}

$cmdApiUrl = 'https://commons.wikimedia.org/w/api.php?' . http_build_query( array(
	'action' => 'query',
	'titles' => 'File:' . urlencode( utf8_encode( $filename ) ),
	'prop' => 'imageinfo',
	'iiprop' => 'extmetadata',
	'iiextmetadatafilter' => implode( '|', array(
		'ImageDescription',
		'Artist',
		'Credit',
		'ObjectName',
		'GPSLatitude',
		'GPSLongitude',
		'LicenseShortName',
		'LicenseLongName',
		'LicenseUrl',
	) ),
	'format' => 'json',
) );

$curl = curl_init();
curl_setopt_array( $curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $cmdApiUrl,
) );
$result = curl_exec( $curl );
if ( !$result ) {
	die( 'CURL error: ' . curl_error( $curl ) );
}
curl_close( $curl );

$data = json_decode( $result, true );
if ( !$data ) {
	die ( 'JSON decode errror: ' . json_last_error_msg() );
}

if ( !empty( $data['errors'] ) ) {
	print_r( $data['errors'] );
	die;
}

if ( empty( $data['query']['pages'] ) ) {
	print_r( $data );
	die( 'API request error' );
}
$page = reset( $data['query']['pages'] );

if ( empty( $page['imageinfo']['0']['extmetadata'] ) ) {
	print_r( $page );
	die( 'API request error' );
}
$extmetadata = new CommonsMetadata( $page['imageinfo']['0']['extmetadata'] );

$importerFactory = new CommonsMetadataTransformerFactory();
$importer = $importerFactory->getImportTransformer();
$metadata = $importer->transformToObjectMetadata( $extmetadata );

$jsonExportTransformer = new ExportTransformer();
$json = $jsonExportTransformer->export( $metadata );

print_r( $json );
echo PHP_EOL;
