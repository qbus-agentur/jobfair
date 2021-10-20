<?php
namespace Dan\Jobfair\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
/**
 * The model for Education
 *
 * @author Dan <typo3dev@outlook.com>
 */
class Education extends AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * jobs
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Dan\Jobfair\Domain\Model\Job>
	 */
	protected $jobs = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->jobs = new ObjectStorage();
	}

	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Adds a Job
	 *
	 * @param \Dan\Jobfair\Domain\Model\Job $job
	 * @return void
	 */
	public function addJob(Job $job) {
		$this->jobs->attach($job);
	}

	/**
	 * Removes a Job
	 *
	 * @param \Dan\Jobfair\Domain\Model\Job $jobToRemove The Job to be removed
	 * @return void
	 */
	public function removeJob(Job $jobToRemove) {
		$this->jobs->detach($jobToRemove);
	}

	/**
	 * Returns the jobs
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Dan\Jobfair\Domain\Model\Job> $jobs
	 */
	public function getJobs() {
		return $this->jobs;
	}

	/**
	 * Sets the jobs
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Dan\Jobfair\Domain\Model\Job> $jobs
	 * @return void
	 */
	public function setJobs(ObjectStorage $jobs) {
		$this->jobs = $jobs;
	}

}