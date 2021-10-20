<?php

namespace Dan\Jobfair\Tests\Unit\Domain\Model;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
use Dan\Jobfair\Domain\Model\Discipline;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use Dan\Jobfair\Domain\Model\Job;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Dan <typo3dev@outlook.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
/**
 * Test case for class \Dan\Jobfair\Domain\Model\Discipline.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Dan <typo3dev@outlook.com>
 */
class DisciplineTest extends UnitTestCase {
	/**
	 * @var \Dan\Jobfair\Domain\Model\Discipline
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new Discipline();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getJobsReturnsInitialValueForJob() {
		$newObjectStorage = new ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getJobs()
		);
	}

	/**
	 * @test
	 */
	public function setJobsForObjectStorageContainingJobSetsJobs() {
		$job = new Job();
		$objectStorageHoldingExactlyOneJobs = new ObjectStorage();
		$objectStorageHoldingExactlyOneJobs->attach($job);
		$this->subject->setJobs($objectStorageHoldingExactlyOneJobs);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneJobs,
			'jobs',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addJobToObjectStorageHoldingJobs() {
		$job = new Job();
		$jobsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$jobsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($job));
		$this->inject($this->subject, 'jobs', $jobsObjectStorageMock);

		$this->subject->addJob($job);
	}

	/**
	 * @test
	 */
	public function removeJobFromObjectStorageHoldingJobs() {
		$job = new Job();
		$jobsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$jobsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($job));
		$this->inject($this->subject, 'jobs', $jobsObjectStorageMock);

		$this->subject->removeJob($job);

	}
}
