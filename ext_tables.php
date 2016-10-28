<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Pits.'.$_EXTKEY,
    'Facebookpage',
    'FacebookPage'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Facebook Page');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_facebookpage_domain_model_facebook', 'EXT:facebookpage/Resources/Private/Language/locallang_csh_tx_facebookpage_domain_model_facebook.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_facebookpage_domain_model_facebook');

//pi flexform configuration
$pluginSignature = 'facebookpage_facebookpage';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'recursive,select_key,pages';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:facebookpage/Configuration/FlexForms/flexform_facebookpage.xml');

//add static template
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile('facebookpage', 'Configuration/TypoScript/Facebookwidget', 'Facebook Widget');
