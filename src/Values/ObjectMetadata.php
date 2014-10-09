<?php

namespace StructuredData\Values;

/**
 * Main metadata class representing a creative work.
 */
class ObjectMetadata {
	/**
	 * Name of the work.
	 * @var \DataValues\MultilingualTextValue|null
	 */
	protected $title;

	/**
	 * Description of the object.
	 * Can be long, can contain HTML (or wikitext), including block-level formatting.
	 * @var \DataValues\MultilingualTextValue|null
	 */
	protected $description;

	/**
	 * List of sources of the object.
	 * @var Source[]
	 */
	protected $sources = array();

	/**
	 * The list of works contained in the object. This includes the work which is the object itself
	 * and all originals. For example, a photograph of a sculpture contains two works, the
	 * photograph itself and the sculpture.
	 * @var Work[]
	 */
	protected $works = array();

	/**
	 * List of usage restrictions for this object.
	 * @var UsageRestriction[]
	 */
	protected $usageRestrictions = array();

	/**
	 * Location of the object.
	 * @var \DataValues\Geo\Values\LatLongValue
	 */
	protected $location;

	/**
	 * Topics represented in the object (e.g. "cat" for an image showing a cat).
	 * @var Topic[]
	 */
	protected $topics = array();

	/**
	 * @return \DataValues\MultilingualTextValue|null
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param \DataValues\MultilingualTextValue|null $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return \DataValues\MultilingualTextValue|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param \DataValues\MultilingualTextValue|null $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return \StructuredData\Values\Source[]
	 */
	public function getSources() {
		return $this->sources;
	}

	/**
	 * @param \StructuredData\Values\Source[] $sources
	 */
	public function setSources( $sources ) {
		$this->sources = $sources;
	}

	/**
	 * @return \StructuredData\Values\Work[]
	 */
	public function getWorks() {
		return $this->works;
	}

	/**
	 * @param \StructuredData\Values\Work[] $works
	 */
	public function setWorks( $works ) {
		$this->works = $works;
	}

	/**
	 * @return \StructuredData\Values\UsageRestriction[]
	 */
	public function getUsageRestrictions() {
		return $this->usageRestrictions;
	}

	/**
	 * @param \StructuredData\Values\UsageRestriction[] $usageRestrictions
	 */
	public function setUsageRestrictions( $usageRestrictions ) {
		$this->usageRestrictions = $usageRestrictions;
	}

	/**
	 * @return \DataValues\Geo\Values\LatLongValue
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param \DataValues\Geo\Values\LatLongValue $location
	 */
	public function setLocation( $location ) {
		$this->location = $location;
	}

	/**
	 * @return \StructuredData\Values\Topic[]
	 */
	public function getTopics() {
		return $this->topics;
	}

	/**
	 * @param \StructuredData\Values\Topic[] $topics
	 */
	public function setTopics( $topics ) {
		$this->topics = $topics;
	}

	// -----------------------------------------------------------------------

	/**
	 * @return Work
	 */
	public function getFinalWork() {
		return $this->works[0];
	}

	/**
	 * @return Contributor[]
	 */
	public function getPrincipalContributors() {
		return array();
	}
}
