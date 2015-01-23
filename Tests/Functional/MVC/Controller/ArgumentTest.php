<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 AOE GmbH <dev@aoe.com>
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

/**
 * @package ExtbaseFilter
 * @subpackage Tests
 */
class Tx_ExtbaseFilter_Tests_Functional_MVC_Controller_ArgumentTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var Tx_ExtbaseFilter_MVC_Controller_Argument
     */
    protected $argument;

    /**
     * initialize
     */
    public function setUp()
    {
        $this->objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
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
        $this->argument->setValue(array('trimProperty' => '   trimmed     '));
        /** @var Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel $value */
        $value = $this->argument->getValue();
        $this->assertSame('trimmed', $value->getTrimProperty());
    }

    /**
     * @test
     */
    public function filterWithExternalFilter()
    {
        $this->argument->setValue(array('externalProperty' => 'boring value'));
        /** @var Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel $value */
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
        return array(
            'integer' => array('integer', 1),
            'int' => array('int', 2),
            'boolean' => array('boolean', true),
            'bool' => array('bool', false),
            'array' => array('array', array('foo' => 'bar')),
        );
    }
}
