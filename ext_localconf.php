<?php

defined('TYPO3') or die('Access denied.');

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Jobfair',
    'Pi1',
    [
        \Dan\Jobfair\Controller\JobController::class => 'list, latest, show, new, create, edit, update, confirmDelete, delete, newApplication, createApplication',
    ],
    // non-cacheable actions
    [
        \Dan\Jobfair\Controller\JobController::class => 'list, latest, show, new, create, edit, update, confirmDelete, delete, newApplication, createApplication',
    ]
);

$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
    'apps-pagetree-folder-contains-jobfair',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    [
        'source' => 'EXT:jobfair/Resources/Public/Icons/folder.gif'
    ]
);
