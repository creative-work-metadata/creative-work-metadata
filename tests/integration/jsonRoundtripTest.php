<?php

use DataValues\Geo\Values\LatLongValue;
use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;
use StructuredData\Values\Contributor;
use StructuredData\Values\License;
use StructuredData\Values\ObjectMetadata;
use StructuredData\Transformation\Json\ImportTransformer;
use StructuredData\Transformation\Json\ExportTransformer;
use StructuredData\Values\PublicDomain;
use StructuredData\Values\Source;
use StructuredData\Values\Topic;
use StructuredData\Values\Work;

require_once( __DIR__ . '/../../vendor/autoload.php' );

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

$contributor1 = new Contributor();
$contributor1->setDataItem( 'Q123456' );
$contributor1->setName( new MonolingualTextValue( 'en', 'E. Elmer' ) );
$contributor1->setRoles( array( 'Q123' ) );
$work->addContributor( $contributor1 );

$contributor2 = new Contributor();
$contributor2->setWikiAccount( new MonolingualTextValue( 'en', 'Foo' ) );
$contributor2->setName( new MonolingualTextValue( 'en', 'E. Elmer' ) );
$contributor2->setRoles( array( 'Q456' ) );
$work->addContributor( $contributor2 );

$rationale1 = new License();
$rationale1->setDataItem( 'Q159' );
$rationale1->setShortName( new MultilingualTextValue( array(
	new MonolingualTextValue( 'en', 'CC-BY-SA-3.0' ),
) ) );
$rationale1->setLongName( new MultilingualTextValue( array(
	new MonolingualTextValue( 'en', 'Creative Commons Attribution-ShareAlike 3.0' ),
) ) );
$rationale1->setUri( new MonolingualTextValue( 'en', 'https://creativecommons.org/licenses/by-sa/3.0/' ) );
$work->addUseRationale( $rationale1 );

$rationale2 = new PublicDomain();
$rationale2->setType( 'PD-USGov-NASA' );
$rationale2->setDataItem( 'Q765' );
$rationale2->setName( new MultilingualTextValue( array(
	new MonolingualTextValue( 'en', 'Public domain work by NASA' ),
	new MonolingualTextValue( 'hu', 'közkincs-NASA' ),
) ) );
$rationale2->setDescription( new MultilingualTextValue( array(
	new MonolingualTextValue( 'en', 'This work has been created by NASA. All works by US government are in the public domain.' ),
) ) );
$work->addUseRationale( $rationale2 );

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


$jsonExportTransformer = new ExportTransformer();
$jsonImportTransformer = new ImportTransformer();

$json = $jsonExportTransformer->export( $metadata );

print_r( json_decode( $json, true ) );

$roundtrippedMetadata = $jsonImportTransformer->import( $json );

// from php.net comments
function arrayRecursiveDiff($aArray1, $aArray2) {
	$aReturn = array();

	foreach ($aArray1 as $mKey => $mValue) {
		if (array_key_exists($mKey, $aArray2)) {
			if (is_array($mValue)) {
				$aRecursiveDiff = arrayRecursiveDiff($mValue, $aArray2[$mKey]);
				if (count($aRecursiveDiff)) { $aReturn[$mKey] = $aRecursiveDiff; }
			} else {
				if ($mValue != $aArray2[$mKey]) {
					$aReturn[$mKey] = $mValue;
				}
			}
		} else {
			$aReturn[$mKey] = $mValue;
		}
	}
	return $aReturn;
}

print_r( arrayRecursiveDiff( $metadata, $roundtrippedMetadata ) );
print_r( arrayRecursiveDiff( $roundtrippedMetadata, $metadata ) );
