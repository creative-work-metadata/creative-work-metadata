<?php

namespace StructuredData\Values;

/**
 * A Contributor is a person (or maybe institution) who participated in creating the work in a way
 * that's important enough to be credited in some form.
 */
class Contributor {
	/**
	 * Contributor role, such as author, photographer, uploader...
	 * @var int
	 */
	protected $role;

	/**
	 * Name of the contributor (in the form in which it is supposed to appear in the attribution).
	 * @var string
	 */
	protected $name;

	/**
	 * URI with more information about the contributor, e.g. home page, user page...
	 * @var string|null
	 */
	protected $uri;

	/**
	 * WikiData item of the contributor
	 * @var string|null
	 */
	protected $dataItem;

	/**
	 * Wiki username of the contributor
	 * @var string|null
	 */
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
