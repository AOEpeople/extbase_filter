<?php
namespace Aoe\ExtbaseFilter\Tests\Functional;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2018 AOE GmbH <dev@aoe.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

use Nimut\TestingFramework\TestCase\FunctionalTestCase;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * @package ExtbaseFilter
 * @subpackage Tests
 */
class FilterResolverTest extends FunctionalTestCase
{
    /**
     * @var \Tx_ExtbaseFilter_FilterResolver
     */
    protected $filterResolver;

    /**
     * initialize
     */
    public function setUp()
    {
        parent::setUp();

        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->filterResolver = $objectManager->get('Tx_ExtbaseFilter_FilterResolver');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionCode 1414052577
     */
    public function shouldThrowExceptionIfFilterCannotBeResolved()
    {
        $this->filterResolver->resolve('InvalidFilter');
    }

    /**
     * @test
     */
    public function shouldCreateFilterByName()
    {
        $this->assertInstanceOf(
            'Tx_ExtbaseFilter_Filter_TrimFilter',
            $this->filterResolver->resolve('Trim')
        );
    }

    /**
     * @test
     */
    public function shouldCreateExternalFilter()
    {
        $this->assertInstanceOf(
            'Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyFilter',
            $this->filterResolver->resolve('Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyFilter')
        );
    }
}
