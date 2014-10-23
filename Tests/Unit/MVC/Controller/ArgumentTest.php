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
class Tx_ExtbaseFilter_Tests_Unit_MVC_Controller_ArgumentTest extends Tx_Extbase_Tests_Unit_BaseTestCase
{
    /**
     * @var Tx_ExtbaseFilter_MVC_Controller_Argument
     */
    private $argument;

    /**
     * initialize
     */
    public function setUp()
    {
        $this->argument = new Tx_ExtbaseFilter_MVC_Controller_Argument('myArgument', 'MyFancyClass');
    }

    /**
     * @test
     */
    public function shouldUseFilterWithOneValue()
    {
        $this->argument->injectConfigurationManager($this->getMock('Tx_Extbase_Configuration_ConfigurationManager'));

        $resolver = $this->getMockBuilder('Tx_ExtbaseFilter_FilterResolver');
        $resolver->setMethods(array('resolve'));
        $mock = $resolver->getMock();
        $mock->expects($this->exactly(2))->method('resolve')->will($this->returnValue(new Tx_ExtbaseFilter_Filter_TrimFilter()));
        $this->argument->injectFilterResolver($mock);

        $reflection = $this->getMockBuilder('Tx_Extbase_Reflection_Service');
        $reflection->setMethods(array('getPropertyTagValues'));
        $mock = $reflection->getMock();
        $mock->expects($this->once())->method('getPropertyTagValues')->will($this->returnValue(array('Trim', 'Boolean')));
        $this->argument->injectReflectionService($mock);

        $this->argument->setValue(array('foo' => 'bar'));
    }

    /**
     * @test
     */
    public function shouldUseFilterWithTwoValues()
    {
        $this->argument->injectConfigurationManager($this->getMock('Tx_Extbase_Configuration_ConfigurationManager'));

        $resolver = $this->getMockBuilder('Tx_ExtbaseFilter_FilterResolver');
        $resolver->setMethods(array('resolve'));
        $mock = $resolver->getMock();
        $mock->expects($this->exactly(4))->method('resolve')->will($this->returnValue(new Tx_ExtbaseFilter_Filter_TrimFilter()));
        $this->argument->injectFilterResolver($mock);

        $reflection = $this->getMockBuilder('Tx_Extbase_Reflection_Service');
        $reflection->setMethods(array('getPropertyTagValues'));
        $mock = $reflection->getMock();
        $mock->expects($this->exactly(2))->method('getPropertyTagValues')->will($this->returnValue(array('Trim', 'Boolean')));
        $this->argument->injectReflectionService($mock);

        $this->argument->setValue(array('foo' => 'bar', 'foo1' => 'bar1'));
    }
}
