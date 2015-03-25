<?php
/**
 * @version 1
 * @package    joomla
 * @subpackage Hoicoiapi
 * @author	   	
 *  @copyright  	Copyright (C) 2014, . All rights reserved.
 *  @license 
 */

//--No direct access
defined('_JEXEC') or die('Resrtricted Access');
?>
<h2>Here are some examples</h2>
<table>
	<tr>
		<td><b>Service</b></td>
		<td><b>URL</b></td>
	</tr>
	<tr>
		<td>Login</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=login&username=test&pass=test" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=login&username=test&pass=test</a></td>
	</tr>
	<tr>
		<td>Registration</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=registration&name=NAME&username=USERNAME&passwd=PASSWORD&email=EMAIL" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=registration&name=NAME&username=USERNAME&passwd=PASSWORD&email=EMAIL</a></td>
	</tr>
	<tr>
		<td>Article Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=art_categories" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=art_categories</a></td>
	</tr>
	<tr>
		<td>Article of a Category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=articles&catid=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=articles&catid=2</a></td>
	</tr>
	<tr>
		<td>Single Article</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=single_article&id=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=single_article&id=1</a></td>
	</tr>
	<tr>
		<td>Virtuemart Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmcategories&lan=en_gb" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmcategories&lan=en_gb</a></td>
	</tr>
	<tr>
		<td>Virtuemart Products in a Category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmproducts&lan=en_gb&catid=6" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmproducts&lan=en_gb&catid=6</a></td>
	</tr>
	<tr>
		<td>Virtuemart Single Product</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmsingle_product&lan=en_gb&id=62" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=vmsingle_product&lan=en_gb&id=62</a></td>
	</tr>
	<tr>
		<td>K2 Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_categories" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_categories</a></td>
	</tr>
	<tr>
		<td>K2 Items in a category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_items&catid=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_items&catid=1</a></td>
	</tr>
	<tr>
		<td>K2 Single Items</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_single_item&id=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=k2_single_item&id=2</a></td>
	</tr>
	<tr>
		<td>Easyblog Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_categories" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_categories</a></td>
	</tr>
	<tr>
		<td>Easyblog Posts in a category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_posts&catid=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_posts&catid=1</a></td>
	</tr>
	<tr>
		<td>Easyblog Single Post</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_single_post&id=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=easyblog_single_post&id=1</a></td>
	</tr>
</table>	

