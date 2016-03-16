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
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents</a></td>
	</tr>
	<tr>
		<td>Article of a Category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents&catid=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents&catid=2</a></td>
	</tr>
	<tr>
		<td>Single Article</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents&id=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getContents&id=1</a></td>
	</tr>
	<tr>
		<td>Virtuemart Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb</a></td>
	</tr>
	<tr>
		<td>Virtuemart Products in a Category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb&catid=6" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb&catid=6</a></td>
	</tr>
	<tr>
		<td>Virtuemart Single Product</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb&id=62" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getVM&lan=en_gb&id=62</a></td>
	</tr>
	<tr>
		<td>K2 Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2</a></td>
	</tr>
	<tr>
		<td>K2 Items in a category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2&catid=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2&catid=1</a></td>
	</tr>
	<tr>
		<td>K2 Single Items</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2&id=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getK2&id=2</a></td>
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
	<tr>
		<td>Kunena Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana</a></td>
	</tr>
	<tr>
		<td>Kunena Items in a category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana&catid=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana&catid=1</a></td>
	</tr>
	<tr>
		<td>Kunena Single Items</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana&id=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getKunana&id=2</a></td>
	</tr>
	<tr>
		<td>HikaShop Categories</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika</a></td>
	</tr>
	<tr>
		<td>HikaShop Items in a category</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika&catid=1" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika&catid=1</a></td>
	</tr>
	<tr>
		<td>HikaShop Single Items</td>
		<td><a href="<?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika&id=2" target="_blank"><?php echo JURI::root(); ?>index.php?option=com_hoicoiapi&task=getHika&id=2</a></td>
	</tr>
</table>	

