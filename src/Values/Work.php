<?php

namespace StructuredData\Values;

class Work {
	/** @var string */
	protected $type;

	/** @var string */
	protected $title;

	/** @var string */
	protected $description;

	/** @var CopyrightEvent[] */
	protected $events = array();

	/** @var Contributor[] */
	protected $contributors = array();

	/** @var UseRationale[] */
	protected $useRationales = array();

	/**
	 * @param \StructuredData\Values\Contributor[] $contributors
	 */
	public function setContributors( $contributors ) {
		$this->contributors = $contributors;
	}

	/**
	 * @return \StructuredData\Values\Contributor[]
	 */
	public function getContributors() {
		return $this->contributors;
	}

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
	 * @param \StructuredData\Values\CopyrightEvent[] $events
	 */
	public function setEvents( $events ) {
		$this->events = $events;
	}

	/**
	 * @return \StructuredData\Values\CopyrightEvent[]
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * @param string $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param \StructuredData\Values\UseRationale[] $useRationales
	 */
	public function setUseRationales( $useRationales ) {
		$this->useRationales = $useRationales;
	}

	/**
	 * @return \StructuredData\Values\UseRationale[]
	 */
	public function getUseRationales() {
		return $this->useRationales;
	}
}
