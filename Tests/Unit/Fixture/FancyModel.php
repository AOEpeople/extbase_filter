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
class Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyModel
{
    /**
     * @var string
     * @filter Trim
     */
    private $trimProperty;

    /**
     * @var integer
     * @filter Integer
     */
    private $integerProperty;

    /**
     * @var boolean
     * @filter Boolean
     */
    private $booleanProperty;

    /**
     * @var string
     * @filter Tx_ExtbaseFilter_Tests_Unit_Fixture_FancyFilter
     */
    private $externalProperty;

    /**
     * @return boolean
     */
    public function getBooleanProperty()
    {
        return $this->booleanProperty;
    }

    /**
     * @param boolean $booleanProperty
     */
    public function setBooleanProperty($booleanProperty)
    {
        $this->booleanProperty = $booleanProperty;
    }

    /**
     * @return int
     */
    public function getIntegerProperty()
    {
        return $this->integerProperty;
    }

    /**
     * @param int $integerProperty
     */
    public function setIntegerProperty($integerProperty)
    {
        $this->integerProperty = $integerProperty;
    }

    /**
     * @return string
     */
    public function getTrimProperty()
    {
        return $this->trimProperty;
    }

    /**
     * @param string $trimProperty
     */
    public function setTrimProperty($trimProperty)
    {
        $this->trimProperty = $trimProperty;
    }

    /**
     * @return string
     */
    public function getExternalProperty()
    {
        return $this->externalProperty;
    }

    /**
     * @param string $externalProperty
     */
    public function setExternalProperty($externalProperty)
    {
        $this->externalProperty = $externalProperty;
    }
}
