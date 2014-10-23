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
 */
class Tx_ExtbaseFilter_MVC_Controller_Argument extends Tx_Extbase_MVC_Controller_Argument
{
    /**
     * @var Tx_ExtbaseFilter_FilterResolver
     */
    private $filterResolver;

    /**
     * @param Tx_ExtbaseFilter_FilterResolver $filterResolver
     */
    public function injectFilterResolver(Tx_ExtbaseFilter_FilterResolver $filterResolver)
    {
        $this->filterResolver = $filterResolver;
    }

    /**
     * @param mixed $rawValue
     * @return Tx_ExtbaseFilter_MVC_Controller_Argument
     *
     * @see Tx_Extbase_MVC_Controller_Argument::setValue
     */
    public function setValue($rawValue)
    {
        if (is_array($rawValue)) {
            foreach ($rawValue as $property => $value) {
                $filters = $this->reflectionService->getPropertyTagValues($this->dataType, $property, 'filter');
                foreach ($filters as $filter) {
                    $rawValue[$property] = $this->filterResolver->resolve($filter)->filter($value);
                }
            }
        }
        return parent::setValue($rawValue);
    }
}
