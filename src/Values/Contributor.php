<?php

namespace StructuredData\Values;

/**
 * A Contributor is a person (or maybe institution) who participated in creating the work in a way
 * that's important enough to be credited in some form.
 */
class Contributor {
	const ROLE_AUTHOR = 'Q123';
	const ROLE_UPLOADER = 'Q456';

	/**
	 * Contributor role, such as author, photographer, uploader...
	 * See the ROLE_* constants for "standard" roles
	 * @var string[]
	 */
	protected $roles;

	/**
	 * Name of the contributor (in the form in which it is supposed to appear in the attribution).
	 * @var \DataValues\MonolingualTextValue
	 */
	protected $name;

	/**
	 * URI with more information about the contributor, e.g. home page, user page...
	 * @var \DataValues\MonolingualTextValue|null
	 */
	protected $uri;

	/**
	 * WikiData item of the contributor
	 * @var string|null
	 */
	protected $dataItem;

	/**
	 * Wiki username of the contributor
	 * @var \DataValues\MonolingualTextValue|null
	 */
	protected $wikiAccount;

	/**
	 * @param string|null $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}

	/**
	 * @return string|null
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param \DataValues\MonolingualTextValue $name
	 */
	public function setName( $name ) {
		$this->name = $name;
	}

	/**
	 * @return \DataValues\MonolingualTextValue
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string[] $roles
	 */
	public function setRoles( $roles ) {
		$this->roles = $roles;
	}

	/**
	 * @return string[]
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param \DataValues\MonolingualTextValue|null $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}

	/**
	 * @return \DataValues\MonolingualTextValue|null
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param \DataValues\MonolingualTextValue|null $wikiAccount
	 */
	public function setWikiAccount( $wikiAccount ) {
		$this->wikiAccount = $wikiAccount;
	}

	/**
	 * @return \DataValues\MonolingualTextValue|null
	 */
	public function getWikiAccount() {
		return $this->wikiAccount;
	}
}
