<?php
namespace Aoe\ExtbaseFilter\Tests\Functional\MVC\Controller;

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
class ArgumentTest extends FunctionalTestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Tx_ExtbaseFilter_MVC_Controller_Argument
     */
    protected $argument;

    /**
     * initialize
     */
    public function setUp()
    {
        parent::setUp();

        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        $this->argument = $this->objectManager->get(
            'Tx_ExtbaseFilter_MVC_Controller_Argument',
            'fancy',
            'Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel'
        );

        /* @var $propertyMappingConfiguration \TYPO3\CMS\Extbase\Property\PropertyMappingConfiguration */
        $propertyMappingConfiguration = $this->argument->getPropertyMappingConfiguration();
        $propertyMappingConfiguration->allowAllProperties();
    }

    /**
     * @test
     */
    public function filterWithIncludedFilter()
    {
        $this->argument->setValue(['trimProperty' => '   trimmed     ']);
        /** @var \Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel $value */
        $value = $this->argument->getValue();
        $this->assertSame('trimmed', $value->getTrimProperty());
    }

    /**
     * @test
     */
    public function filterWithExternalFilter()
    {
        $this->argument->setValue(['externalProperty' => 'boring value']);
        /** @var \Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel $value */
        $value = $this->argument->getValue();
        $this->assertSame('fancy value', $value->getExternalProperty());
    }

    /**
     * @test
     * @dataProvider primitiveTypes
     */
    public function doNotFilterWithPrimitiveTypes($type, $value)
    {
        $this->argument = $this->objectManager->get(
            'Tx_ExtbaseFilter_MVC_Controller_Argument',
            'fancy',
            $type
        );
        $this->argument->setValue($value);
        $this->assertSame($value, $this->argument->getValue());
    }

    /**
     * @return array
     */
    public function primitiveTypes()
    {
        return [
            'integer' => ['integer', 1],
            'int' => ['int', 2],
            'boolean' => ['boolean', true],
            'bool' => ['bool', false],
            'array' => ['array', ['foo' => 'bar']],
        ];
    }
}
