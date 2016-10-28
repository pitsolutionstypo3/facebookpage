<?php

namespace Pits\Facebookpage\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016
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
 * FacebookController.
 * 
 *This class contains function for render facebook page and icons.
 * 
 * @author Aswathy S <aswathy.sh@pitsolutions.com>
 */
class FacebookController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * action configure.
     *
     * @param \Pits\Facebookpage\Domain\Model\Facebook $facebook
     * @return void
     */
    public function configureAction() {
        $page = $GLOBALS['TSFE']->page;
        if ($page['tx_fb_like'] == 1) {
            $html = $this->renderFbicons();
        }
        $settings = $this->settings;
        $friends = ($settings['friends'] == 1) ? 'true' : 'false';
        $this->view->assignMultiple(
            array(
                'title' => $settings['title'],
                'url' => $settings['pageurl'],
                'width' => $settings['width'],
                'height' => $settings['height'],
                'friends' => $friends,
                'tabs' => $settings['tabs'],
                'html' => $html
            )
        );
    }
    
    /**
     * Render facebook like and share icons.
     * @return $render
     */
    public function renderFbicons() {
        $curpageurl = $this->uriBuilder->getRequest()->getRequestUri();
        $renderer = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $renderer->setControllerContext($this->controllerContext);
        $renderer->setFormat('html');
        $conf = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $extpath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('facebookpage');
        $renderer->setTemplatePathAndFilename($extpath.'Resources/Private/Templates/Facebook/fbicons.html');
        $renderer->assign('url', $curpageurl);
        return $renderer->render();
    }
}
