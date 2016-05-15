<?php

namespace R3H6\JobqueueDatabase\Tests\Functional;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 3 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

/**
 * BasicFrontendEnvironmentTrait.
 */
trait BasicFrontendEnvironmentTrait
{
    /**
     * Minimal frontent environment to satisfy Extbase Typo3DbBackend.
     */
    protected function setUpBasicFrontendEnvironment()
    {
        $environmentServiceMock = $this->getMock('TYPO3\\CMS\\Extbase\\Service\\EnvironmentService');
        $environmentServiceMock
            ->expects($this->any())
            ->method('isEnvironmentInFrontendMode')
            ->willReturn(true);
        GeneralUtility::setSingletonInstance('TYPO3\\CMS\\Extbase\\Service\\EnvironmentService', $environmentServiceMock);

        $pageRepositoryFixture = new PageRepository();
        $frontendControllerMock = $this->getMock('TYPO3\\CMS\\Frontend\\Controller\\TypoScriptFrontendController', array(), array(), '', false);
        $frontendControllerMock->sys_page = $pageRepositoryFixture;
        $GLOBALS['TSFE'] = $frontendControllerMock;
    }
}
