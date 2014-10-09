<?php

namespace StructuredData\Values;

use DataValues\MultilingualTextValue;
use DataValues\Geo\Values\LatLongValue;

/**
 * Main metadata class representing a creative work.
 */
class ObjectMetadata {
	/**
	 * Name of the work.
	 * @var MultilingualTextValue|null
	 */
	protected $title;

	/**
	 * Description of the object.
	 * Can be long, can contain HTML (or wikitext), including block-level formatting.
	 * @var MultilingualTextValue|null
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
	 * @var LatLongValue
	 */
	protected $location;

	/**
	 * Topics represented in the object (e.g. "cat" for an image showing a cat).
	 * @var Topic[]
	 */
	protected $topics = array();

	/**
	 * @return MultilingualTextValue|null
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param MultilingualTextValue|null $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return MultilingualTextValue|null
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param MultilingualTextValue|null $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return Source[]
	 */
	public function getSources() {
		return $this->sources;
	}

	/**
	 * @param Source[] $sources
	 */
	public function setSources( array $sources ) {
		$this->sources = $sources;
	}

	/**
	 * @param Source $source
	 */
	public function addSource( Source $source ) {
		$this->sources[] = $source;
	}

	/**
	 * @return Work[]
	 */
	public function getWorks() {
		return $this->works;
	}

	/**
	 * @param Work[] $works
	 */
	public function setWorks( array $works ) {
		$this->works = $works;
	}

	public function addWork( Work $work ) {
		$this->works[] = $work;
	}

	/**
	 * @return UsageRestriction[]
	 */
	public function getUsageRestrictions() {
		return $this->usageRestrictions;
	}

	/**
	 * @param UsageRestriction[] $usageRestrictions
	 */
	public function setUsageRestrictions( array $usageRestrictions ) {
		$this->usageRestrictions = $usageRestrictions;
	}

	public function addUsageRestriction( UsageRestriction $usageRestriction ) {
		$this->usageRestrictions[] = $usageRestriction;
	}

	/**
	 * @return LatLongValue
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param LatLongValue $location
	 */
	public function setLocation( $location ) {
		$this->location = $location;
	}

	/**
	 * @return Topic[]
	 */
	public function getTopics() {
		return $this->topics;
	}

	/**
	 * @param Topic[] $topics
	 */
	public function setTopics( array $topics ) {
		$this->topics = $topics;
	}

	/**
	 * @param Topic $topic
	 */
	public function addTopic( Topic $topic ) {
		$this->topics[] = $topic;
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
