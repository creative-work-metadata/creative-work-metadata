<?php

namespace StructuredData\Values;

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
	 * @var \DataValues\MultilingualTextValue|null
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
	 * @param \DataValues\MultilingualTextValue|null $title
	 */
	public function setTitle( $title ) {
		$this->title = $title;
	}

	/**
	 * @return \DataValues\MultilingualTextValue|null
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
