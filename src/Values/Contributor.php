<?php

namespace StructuredData\Values;

class Contributor {
	/** @var int */
	protected $role;

	/** @var string */
	protected $name;

	/** @var string */
	protected $uri;

	/** @var string */
	protected $dataItem;

	/** @var string */
	protected $wikiAccount;

	/**
	 * @param string $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}

	/**
	 * @return string
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param string $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param int $role
	 */
	public function setRole( $role ) {
		$this->role = $role;
	}

	/**
	 * @return int
	 */
	public function getRole() {
		return $this->role;
	}

	/**
	 * @param string $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}

	/**
	 * @return string
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param string $wikiAccount
	 */
	public function setWikiAccount( $wikiAccount ) {
		$this->wikiAccount = $wikiAccount;
	}

	/**
	 * @return string
	 */
	public function getWikiAccount() {
		return $this->wikiAccount;
	}
}
