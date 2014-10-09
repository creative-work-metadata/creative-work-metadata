<?php

namespace StructuredData\Values;

class CopyrightEvent {
	/** @var int */
	protected $type;

	/** @var \DataValues\TimeValue */
	protected $date;

	/** @var \DataValues\Geo\Values\LatLongValue[] */
	protected $locations = array();

	/**
	 * @param \DataValues\TimeValue $date
	 */
	public function setDate( $date ) {
		$this->date = $date;
	}

	/**
	 * @return \DataValues\TimeValue
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * @param \DataValues\Geo\Values\LatLongValue[] $locations
	 */
	public function setLocations( $locations ) {
		$this->locations = $locations;
	}

	/**
	 * @return \DataValues\Geo\Values\LatLongValue[]
	 */
	public function getLocations() {
		return $this->locations;
	}

	/**
	 * @param int $type
	 */
	public function setType( $type ) {
		$this->type = $type;
	}

	/**
	 * @return int
	 */
	public function getType() {
		return $this->type;
	}
}