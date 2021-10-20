<?php
namespace Dan\Jobfair\Tests\Unit\Controller;

use TYPO3\TestingFramework\Core\Unit\UnitTestCase;
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
 * Test case for class Dan\Jobfair\Controller\JobController.
 *
 * @author Dan <typo3dev@outlook.com>
 */
class JobControllerTest extends UnitTestCase {

	/**
	 * @var \Dan\Jobfair\Controller\JobController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('Dan\\Jobfair\\Controller\\JobController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllJobsFromRepositoryAndAssignsThemToView() {

		$allJobs = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('findAll'), array(), '', FALSE);
		$jobRepository->expects($this->once())->method('findAll')->will($this->returnValue($allJobs));
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('jobs', $allJobs);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenJobToView() {
		$job = new Job();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('job', $job);

		$this->subject->showAction($job);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenJobToView() {
		$job = new Job();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newJob', $job);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($job);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenJobToJobRepository() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('add'), array(), '', FALSE);
		$jobRepository->expects($this->once())->method('add')->with($job);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->createAction($job);
	}

	/**
	 * @test
	 */
	public function createActionAddsMessageToFlashMessageContainer() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);
		$this->subject->expects($this->once())->method('addFlashMessage');

		$this->subject->createAction($job);
	}

	/**
	 * @test
	 */
	public function createActionRedirectsToListAction() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('add'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->createAction($job);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenJobToView() {
		$job = new Job();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('job', $job);

		$this->subject->editAction($job);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenJobInJobRepository() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('update'), array(), '', FALSE);
		$jobRepository->expects($this->once())->method('update')->with($job);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->updateAction($job);
	}

	/**
	 * @test
	 */
	public function updateActionAddsMessageToFlashMessageContainer() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->expects($this->once())->method('addFlashMessage');
		$this->subject->updateAction($job);
	}

	/**
	 * @test
	 */
	public function updateActionRedirectsToListAction() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('update'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->updateAction($job);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenJobFromJobRepository() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('remove'), array(), '', FALSE);
		$jobRepository->expects($this->once())->method('remove')->with($job);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->deleteAction($job);
	}

	/**
	 * @test
	 */
	public function deleteActionAddsMessageToFlashMessageContainer() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);
		$this->subject->expects($this->once())->method('addFlashMessage');

		$this->subject->deleteAction($job);
	}

	/**
	 * @test
	 */
	public function deleteActionRedirectsToListAction() {
		$job = new Job();

		$jobRepository = $this->getMock('Dan\\Jobfair\\Domain\\Repository\\JobRepository', array('remove'), array(), '', FALSE);
		$this->inject($this->subject, 'jobRepository', $jobRepository);

		$this->subject->expects($this->once())->method('redirect')->with('list');
		$this->subject->deleteAction($job);
	}
}
