<?php

namespace StructuredData\Values;

use DataValues\MonolingualTextValue;
use DataValues\MultilingualTextValue;

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
	 * @var MonolingualTextValue
	 */
	protected $name;

	/**
	 * URI with more information about the contributor, e.g. home page, user page...
	 * @var MonolingualTextValue|null
	 */
	protected $uri;

	/**
	 * WikiData item of the contributor
	 * @var string|null
	 */
	protected $dataItem;

	/**
	 * Wiki username of the contributor
	 * @var MonolingualTextValue|null
	 */
	protected $wikiAccount;

	/**
	 * @return string[]
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param string[] $roles
	 */
	public function setRoles( array $roles ) {
		$this->roles = $roles;
	}

	/**
	 * @param string $role
	 */
	public function addRole( $role ) {
		$this->roles[] = $role;
	}

	/**
	 * @return MonolingualTextValue
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param MonolingualTextValue $name
	 */
	public function setName( MonolingualTextValue $name ) {
		$this->name = $name;
	}

	/**
	 * @return MonolingualTextValue|null
	 */
	public function getUri() {
		return $this->uri;
	}

	/**
	 * @param MonolingualTextValue|null $uri
	 */
	public function setUri( $uri ) {
		$this->uri = $uri;
	}

	/**
	 * @return string|null
	 */
	public function getDataItem() {
		return $this->dataItem;
	}

	/**
	 * @param string|null $dataItem
	 */
	public function setDataItem( $dataItem ) {
		$this->dataItem = $dataItem;
	}

	/**
	 * @return MonolingualTextValue|null
	 */
	public function getWikiAccount() {
		return $this->wikiAccount;
	}

	/**
	 * @param MonolingualTextValue|null $wikiAccount
	 */
	public function setWikiAccount( $wikiAccount ) {
		$this->wikiAccount = $wikiAccount;
	}
}
