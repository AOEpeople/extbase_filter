<?php
$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('extbase_filter');
$extensionTestPath = $extensionPath . 'Tests/';
return array(
    'tx_extbasefilter_tests_unit_fixture_fancyfilter' => $extensionTestPath . 'Unit/Fixture/FancyFilter.php',
    'tx_extbasefilter_tests_unit_fixture_fancymodel' => $extensionTestPath . 'Unit/Fixture/FancyModel.php',
);
