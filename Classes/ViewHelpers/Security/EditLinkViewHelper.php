<?php

namespace Dan\Jobfair\ViewHelpers\Security;

use Dan\Jobfair\Service\AccessControlService;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * View helper to create additional parameters for link to user profile
 *
 * @author Dan <typo3dev@outlook.com>
 */
class EditLinkViewHelper extends \TYPO3Fluid\Fluid\ViewHelpers\IfViewHelper
{

    /**
     * @var \Dan\Jobfair\Service\AccessControlService
     */
    protected $accessControlService;

    /**
     * View helper to display edit or delete link if logged in user is owner of the job
     *
     * @return bool
     */
    public function render()
    {
        $job = $this->arguments['job'];
        if ($this->accessControlService->isOwner($job)) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('job', 'null', '', false, 'NULL');
    }

    public function injectAccessControlService(AccessControlService $accessControlService): void
    {
        $this->accessControlService = $accessControlService;
    }
}
