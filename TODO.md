* document that most functions return references, not copies
* fix multilang text functions to use empty multilang value instead of null
* use guid generator <-- it's in the Wikibase MW extension which is not a dependency so fars
  * move guid generation to the wikibase repo?
* move helper methods in Encoder to a dedicated helper class
  * move MultilingualTextValue <-> Terms transform into Wikibase?
* move extractors into subdirs
* rename encoder to ??? (composer? inserter?)
* rename StructuredData to CreativeWorkMetadata(?)

* add JSON export/import
* template writer
* MW API module
* (LATER) split repo into data model and wikibase/template transformer
* fix namespace for tests
* use wmde/Serializer
