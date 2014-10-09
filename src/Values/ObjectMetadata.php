<?php

namespace StructuredData\Values;

class ObjectMetadata {
	/** @var string */
	protected $description;

	/** @var Source[] */
	protected $sources = array();

	/** @var Work[] */
	protected $works = array();

	/** @var UsageRestriction[] */
	protected $usageRestrictions = array();

	/** @var \DataValues\Geo\Values\LatLongValue */
	protected $location;

	/** @var Topic[] */
	protected $topics = array();

	/**
	 * @param string $description
	 */
	public function setDescription( $description ) {
		$this->description = $description;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param \DataValues\Geo\Values\LatLongValue $location
	 */
	public function setLocation( $location ) {
		$this->location = $location;
	}

	/**
	 * @return \DataValues\Geo\Values\LatLongValue
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param \StructuredData\Values\Source[] $sources
	 */
	public function setSources( $sources ) {
		$this->sources = $sources;
	}

	/**
	 * @return \StructuredData\Values\Source[]
	 */
	public function getSources() {
		return $this->sources;
	}

	/**
	 * @param \StructuredData\Values\Topic[] $topics
	 */
	public function setTopics( $topics ) {
		$this->topics = $topics;
	}

	/**
	 * @return \StructuredData\Values\Topic[]
	 */
	public function getTopics() {
		return $this->topics;
	}

	/**
	 * @param \StructuredData\Values\UsageRestriction[] $usageRestrictions
	 */
	public function setUsageRestrictions( $usageRestrictions ) {
		$this->usageRestrictions = $usageRestrictions;
	}

	/**
	 * @return \StructuredData\Values\UsageRestriction[]
	 */
	public function getUsageRestrictions() {
		return $this->usageRestrictions;
	}

	/**
	 * @param \StructuredData\Values\Work[] $works
	 */
	public function setWorks( $works ) {
		$this->works = $works;
	}

	/**
	 * @return \StructuredData\Values\Work[]
	 */
	public function getWorks() {
		return $this->works;
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
