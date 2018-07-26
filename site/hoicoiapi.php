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


$controller = JControllerLegacy::getInstance('hoicoiapi');

$controller->execute(JFactory::getApplication()->input->get('task', 'getContents'));

$controller->redirect();
