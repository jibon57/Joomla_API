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


//-- Get an instance of the controller with the prefix 'hoicoiapi'
$controller = JControllerLegacy::getInstance('hoicoiapi');

//-- Execute the 'task' from the Request
$controller->execute(JFactory::getApplication()->input->get('task'));

//-- Redirect if set by the controller
$controller->redirect();
