<?php

namespace StructuredData\Values;

/**
 * The UseRationale describes why it is legal to use the work. It could be a license, or an
 * assessment of legal status such as public domain.
 */
class UseRationale {
	/**
	 * A list of requirements the reuser most honor to be able to use the work based on this
	 * rationale.
	 * @var UsageRequirement[]
	 */
	protected $usageRequirements = array();

	/**
	 * The permission for the work (if any).
	 * @var UsagePermission|null
	 */
	protected $usagePermission;

	/**
	 * @return UsageRequirement[]
	 */
	public function getUsageRequirements() {
		return $this->usageRequirements;
	}

	/**
	 * @param UsageRequirement[] $usageRequirements
	 */
	public function setUsageRequirements( array $usageRequirements ) {
		$this->usageRequirements = $usageRequirements;
	}

	/**
	 * @param UsageRequirement $usageRequirement
	 */
	public function addUsageRequirement( UsageRequirement $usageRequirement ) {
		$this->usageRequirements[] = $usageRequirement;
	}

	/**
	 * @return UsagePermission
	 */
	public function getUsagePermission() {
		return $this->usagePermission;
	}

	/**
	 * @param UsagePermission $usagePermission
	 */
	public function setUsagePermission( $usagePermission ) {
		$this->usagePermission = $usagePermission;
	}
}
