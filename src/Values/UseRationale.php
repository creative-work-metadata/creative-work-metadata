<?php

namespace StructuredData\Values;

class UseRationale {
	/** @var UsageRequirement */
	protected $usageRequirements = array();

	/** @var UsagePermission */
	protected $usagePermission;

	/**
	 * @param \StructuredData\Values\UsagePermission $usagePermission
	 */
	public function setUsagePermission( $usagePermission ) {
		$this->usagePermission = $usagePermission;
	}

	/**
	 * @return \StructuredData\Values\UsagePermission
	 */
	public function getUsagePermission() {
		return $this->usagePermission;
	}

	/**
	 * @param \StructuredData\Values\UsageRequirement $usageRequirements
	 */
	public function setUsageRequirements( $usageRequirements ) {
		$this->usageRequirements = $usageRequirements;
	}

	/**
	 * @return \StructuredData\Values\UsageRequirement
	 */
	public function getUsageRequirements() {
		return $this->usageRequirements;
	}
}
