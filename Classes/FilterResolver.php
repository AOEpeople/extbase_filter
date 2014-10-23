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
 * @subpackage Filter
 * @scope singleton
 */
class Tx_ExtbaseFilter_FilterResolver implements t3lib_Singleton
{
    /**
     * @var string
     */
    const FILTER_CLASS_NAME_PATTERN = 'Tx_ExtbaseFilter_Filter_%sFilter';

    /**
     * @var Tx_Extbase_Object_ObjectManagerInterface
     * @inject
     */
    protected $objectManager;

    /**
     * @param string $filterName
     * @return Tx_ExtbaseFilter_Filter_FilterInterface
     */
    public function resolve($filterName)
    {
        if (class_exists($filterName)) {
            return $this->objectManager->create($filterName);
        } else {
            $className = sprintf(self::FILTER_CLASS_NAME_PATTERN, $filterName);
            if (class_exists($className)) {
                return $this->objectManager->create($className);
            }
        }
        throw new InvalidArgumentException('Could not resolve filter "' . $filterName . '"', 1414052577);
    }
}
