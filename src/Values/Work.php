<?php

namespace StructuredData\Values;

use DataValues\MultilingualTextValue;

/**
 * A Work is, in the first approximation, something that can be copyrighted separately. An object
 * can contain multiple works; e.g. a photograph of a statue contains at least two works, the
 * photograph and the statue.
 *
 * To simplify things, we track as Works some things that are not copyrightable but we want to be
 * able to acknowledge them (such as an image restoration).
 */
class Work {
	/**
	 * Type(s) of the work, e.g. "painting".
	 * @var string[]
	 */
	protected $types;

	/**
	 * Title of the work.
	 * @var MultilingualTextValue|null
	 */
	protected $title;

	/**
	 * Events that are relevant for determining the copyright status of the work.
	 * @var CopyrightEvent[]
	 */
	protected $events = array();

	/**
	 * Persons who contributed to the work.
	 * @var Contributor[]
	 */
	protected $contributors = array();

	/**
	 * Use rationales (such as licenses) of the work.
	 * @var UseRationale[]
	 */
	protected $useRationales = array();

	/**
	 * @return string[]
	 */
	public function getTypes() {
		return $this->types;
	}

	/**
	 * @param string[] $types
	 */
	public function setTypes( array $types ) {
		$this->types = $types;
	}

	/**
	 * @param string $type
	 */
	public function addType( $type) {
		$this->types[] = $type;
	}

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
	 * @return CopyrightEvent[]
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * @param CopyrightEvent[] $events
	 */
	public function setEvents( array $events ) {
		$this->events = $events;
	}

	/**
	 * @param CopyrightEvent $event
	 */
	public function addEvent( CopyrightEvent $event ) {
		$this->events[] = $event;
	}

	/**
	 * @return Contributor[]
	 */
	public function getContributors() {
		return $this->contributors;
	}

	/**
	 * @param Contributor[] $contributors
	 */
	public function setContributors( array $contributors ) {
		$this->contributors = $contributors;
	}

	/**
	 * @param Contributor $contributor
	 */
	public function addContributor( Contributor $contributor ) {
		$this->contributors[] = $contributor;
	}

	/**
	 * @return UseRationale[]
	 */
	public function getUseRationales() {
		return $this->useRationales;
	}

	/**
	 * @param UseRationale[] $useRationales
	 */
	public function setUseRationales( array $useRationales ) {
		$this->useRationales = $useRationales;
	}

	/**
	 * @param UseRationale $useRationale
	 */
	public function addUseRationale( UseRationale $useRationale ) {
		$this->useRationales[] = $useRationale;
	}
}
