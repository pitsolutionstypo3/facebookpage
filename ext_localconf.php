<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Pits.' . $_EXTKEY,
	'Facebookpage',
	array(
		'Facebook' => 'configure',
		
	),
	// non-cacheable actions
	array(
		'Facebook' => 'configure',
		
	)
);
