<?php
namespace Pits\Facebookpage\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Aswathy.S <aswathy.sh@pitsolutions.com>, Pit Solutions
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
 * Test case for class Pits\Facebookpage\Controller\FacebookController.
 *
 * @author Aswathy.S <aswathy.sh@pitsolutions.com>
 */
class FacebookControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{

	/**
	 * @var \Pits\Facebookpage\Controller\FacebookController
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = $this->getMock('Pits\\Facebookpage\\Controller\\FacebookController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllFacebooksFromRepositoryAndAssignsThemToView()
	{

		$allFacebooks = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$facebookRepository = $this->getMock('Pits\\Facebookpage\\Domain\\Repository\\FacebookRepository', array('findAll'), array(), '', FALSE);
		$facebookRepository->expects($this->once())->method('findAll')->will($this->returnValue($allFacebooks));
		$this->inject($this->subject, 'facebookRepository', $facebookRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('facebooks', $allFacebooks);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenFacebookToView()
	{
		$facebook = new \Pits\Facebookpage\Domain\Model\Facebook();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('facebook', $facebook);

		$this->subject->showAction($facebook);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenFacebookToFacebookRepository()
	{
		$facebook = new \Pits\Facebookpage\Domain\Model\Facebook();

		$facebookRepository = $this->getMock('Pits\\Facebookpage\\Domain\\Repository\\FacebookRepository', array('add'), array(), '', FALSE);
		$facebookRepository->expects($this->once())->method('add')->with($facebook);
		$this->inject($this->subject, 'facebookRepository', $facebookRepository);

		$this->subject->createAction($facebook);
	}
}
