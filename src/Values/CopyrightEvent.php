<?php

namespace StructuredData\Values;

/**
 * An event (point in time and space) that's relevant for determining copyright, such as first
 * publication of the work.
 */
class CopyrightEvent {
	const TYPE_CREATION = 'Q123';
	const TYPE_PUBLICATION = 'Q234';

	/**
	 * Event type, e.g. creation, first publication, registration with the copyright office.
	 * @var int
	 */
	protected $type;

	/**
	 * Date/time of the event.
	 * @var \DataValues\TimeValue
	 */
	protected $date;

	/**
	 * Location(s) of the event.
	 *
	 * Multiple locations are meaningful for events such as first publication where the
	 * Berne convention defines all publications happening within 30 days as part of the
	 * first publication.
	 *
	 * @var \DataValues\Geo\Values\LatLongValue[]
	 */
	protected $locations = array();

	/**
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * @param int $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return \DataValues\TimeValue
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param \DataValues\TimeValue $date
	 */
	public function setDate( $date ) {
		$this->date = $date;
	}

	/**
	 * @return \DataValues\Geo\Values\LatLongValue[]
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * @param \DataValues\Geo\Values\LatLongValue[] $locations
	 */
	public function setLocations( $locations ) {
		$this->locations = $locations;
	}
}
