<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$fb_like_share = array(
    'tx_fb_like' => array(
        'label' => 'LLL:EXT:facebookpage/Resources/Private/Language/locallang.xlf:tx_facebookpage_domain_model_facebook.showicons',
        'exclude' => 0,
        'config' => array(
            'type' => 'check',
            'default' => '1',
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'pages',
        $fb_like_share
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'pages',
        'tx_fb_like'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'visibility', 'tx_fb_like');
