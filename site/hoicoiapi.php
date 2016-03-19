<?php

/**
 * @package    hoicoiapi
 * @subpackage Base
 * @author     Jibon Lawrence Costa {@link http://www.hoicoimasti.com}
 * @author     Created on 14-Sep-2014
 * @license    GNU/GPL
 */
//-- No direct access
defined('_JEXEC') || die('=;)');


$params = JComponentHelper::getParams('com_hoicoiapi');
$token = trim($params->get('token'));
$get = trim(JFactory::getApplication()->input->get('token', '0', 'STRING'));

if (!$token || !strcmp($token, $get) == 0) {
    jexit('Please use correct token with URL');
}


$controller = JControllerLegacy::getInstance('hoicoiapi');

$controller->execute(JFactory::getApplication()->input->get('task', 'getContents'));

$controller->redirect();
