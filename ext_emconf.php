<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "jobfair".
 *
 * Auto generated 06-03-2017 09:21
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'Job Fair',
    'description' => 'Simple job market based on Extbase and Fluid. Basically works like dmmjobcontrol. There are list and detail views available. In addition, it is possible to set up an online application system. Furthermore, FE-Users can be enabled to add and edit jobs in the frontend, so to BE-Administration is required. Feeds (Rss091, Rss2, Atom) are also available',
    'category' => 'plugin',
    'version' => '2.0.0',
    'state' => 'stable',
    'author' => 'Dan',
    'author_email' => 'typo3dev@outlook.com',
    'author_company' => '',
    'constraints' => [
        'depends' => [
            'extbase' => '10.4.21',
            'fluid' => '10.4.21',
            'typo3' => '10.4.21',
        ],
    ],
];
