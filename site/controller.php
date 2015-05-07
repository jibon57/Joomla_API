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


/**
 * hoicoiapi Controller.
 *
 * @package    hoicoiapi
 * @subpackage Controllers
 */
class hoicoiapiController extends JControllerLegacy
{

	
	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=vmcategories&lan=en_gb
	public function vmcategories()
	{
		$return_arr = array();
		$jinput = JFactory::getApplication()->input;
		$lan = $jinput->get('lan','en_gb','STRING');

		$query= "SELECT a.virtuemart_category_id, a.category_name, a.category_description, b.virtuemart_category_id, c.virtuemart_media_id, c.file_url FROM #__virtuemart_categories_{$lan} a INNER JOIN #__virtuemart_category_medias b ON (a.virtuemart_category_id = b.virtuemart_category_id) INNER JOIN #__virtuemart_medias c ON (c.virtuemart_media_id=b.virtuemart_media_id AND a.virtuemart_category_id IS NOT NULL AND a.virtuemart_category_id <> '')";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach($row as $val) {
		  $row_array['virtuemart_category_id'] = $val[0];
		  $row_array['category_name'] = $val[1];
		  $row_array['category_description'] =htmlspecialchars($val[2],ENT_QUOTES);
		  $row_array['file_url'] = $val[5];

		  array_push($return_arr,$row_array);
		}
		
		header('Content-Type: application/json');	
		echo json_encode($return_arr);
		jexit();
	}


	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=vmproducts&lan=en_gb&catid=6
	public function vmproducts()
	{
		$jinput = JFactory::getApplication()->input;
		$id = $jinput->get('catid',6); //category id
		$lan = $jinput->get('lan','en_gb','STRING');
		$return_arr = array();
		$query= "SELECT a.virtuemart_category_id,a.virtuemart_product_id,b.product_name,b.product_desc, c.product_price,d.virtuemart_media_id,e.file_url,f.shopper_group_name,c.virtuemart_shoppergroup_id FROM #__virtuemart_product_categories a LEFT JOIN #__virtuemart_products_{$lan} b ON a.virtuemart_product_id=b.virtuemart_product_id LEFT JOIN  #__virtuemart_product_prices c ON b.virtuemart_product_id=c.virtuemart_product_id LEFT JOIN 
		#__virtuemart_product_medias d ON b.virtuemart_product_id=d.virtuemart_product_id LEFT JOIN
		#__virtuemart_medias e ON d.virtuemart_media_id=e.virtuemart_media_id LEFT JOIN #__virtuemart_shoppergroups f ON c.virtuemart_shoppergroup_id=f.virtuemart_shoppergroup_id WHERE b.product_name IS NOT NULL AND a.virtuemart_category_id= $id ";

		$db = &JFactory::getDBO(); // get database objec
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach($row as $val) {

			if ($val[7] == null){
				$val[7] = "default";
			}
		      
		    $row_array['virtuemart_product_id'] = $val[1];
			$row_array['product_name'] = $val[2];
			$row_array['product_desc'] =htmlspecialchars($val[3],ENT_QUOTES);
			$row_array['product_price'] = $val[4];
			$row_array['shopper_group_name'] = $val[7];
			$row_array['shopper_group_id'] = $val[8];
			$row_array['file_url'] = $val[6];
			
		  array_push($return_arr,$row_array);
		}

		header('Content-Type: application/json');		 
		echo json_encode($return_arr);
		jexit();
	}

	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=vmsingle_product&lan=en_gb&id=62
	public function vmsingle_product()
	{
		$jinput = JFactory::getApplication()->input;
		$prodid = $jinput->get('id',66);
		$lan = $jinput->get('lan','en_gb','STRING');
		$return_arr = array();

		$query= "SELECT a.virtuemart_product_id,b.product_name,b.product_desc,c.product_price,f.shopper_group_name,d.virtuemart_media_id,e.file_url,c.virtuemart_shoppergroup_id FROM #__virtuemart_product_categories a LEFT JOIN #__virtuemart_products_{$lan} b ON a.virtuemart_product_id=b.virtuemart_product_id LEFT JOIN  #__virtuemart_product_prices c ON b.virtuemart_product_id=c.virtuemart_product_id LEFT JOIN 
		#__virtuemart_product_medias d ON b.virtuemart_product_id=d.virtuemart_product_id LEFT JOIN
		#__virtuemart_medias e ON d.virtuemart_media_id=e.virtuemart_media_id LEFT JOIN #__virtuemart_shoppergroups f ON c.virtuemart_shoppergroup_id=f.virtuemart_shoppergroup_id WHERE a.virtuemart_product_id = $prodid";

		$db = &JFactory::getDBO(); // get database objec
		$db->setQuery($query);
		$row = $db->loadRowList();
		
		foreach($row as $val){
			if ($val[4] == null){
				$val[4] = "default";
			}

			$row_array['product_name'] = $val[1];
			$row_array['product_desc'] =htmlspecialchars($val[2],ENT_QUOTES);
			$row_array['product_price'] = $val[3];
			$row_array['shopper_group_name'] = $val[4];
			$row_array['shopper_group_id'] = $val[7];
			$row_array['file_url'] = $val[6];
			
		  array_push($return_arr,$row_array);
		}

		header('Content-Type: application/json');		 
		echo json_encode($return_arr);
		jexit();
	}

		//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=login&username=test&pass=test
	public function login()
	{
		$app = JFactory::getApplication();
		$credentials = array();
		$credentials['username'] = $app->input->get('username','','USERNAME');
		$credentials['password'] = $app->input->get('pass','','STRING');

		if (true === $app->login($credentials, $options)) {
			// Success
			$user =& JFactory::getUser();
			$data = array(
					'message' => 'success',
					'id' => $user->id,
					'username' => $user->username,
					'name' => $user->name,
					'email' => $user->email,
					'group' => $user->groups
				);			
			
		} else {
			// login failed
			$data = array(
					'message' => 'login failed'
				);
						
		}
		header('Content-Type: application/json');
		echo json_encode($data);
		jexit();
	}
	
	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=registration&name=NAME&username=USERNAME&passwd=PASSWORD&email=EMAIL
	public function registration()
	{
		$jinput = JFactory::getApplication()->input;
		$name = $jinput->get('name');
		$username = $jinput->get('username','','USERNAME');
		$passwd = $jinput->get('passwd','','STRING');
		$email = $jinput->get('email','','STRING');
		$data = array(
			  "name"=>$name,
			  "username"=>$username,
			  "password"=>$passwd,
			  "password2"=>$passwd,
			  "email"=>$email,
			  "block"=>0,
			  "groups"=>array("2")
	  		);
	    
	        $user = new JUser;
	        //Write to database
	        if(!$user->bind($data)) {
	        	$status = "Could not bind data. Error: " . $user->getError();
        	  }
		if (!$user->save()) {
			 $status = "Could not save user. Error: " . $user->getError();
	    	}
	     	else {
		  $status = "Success";
	    	}
	
		 $message = array(
	        	'message' => $status
		 );
	
		 header('Content-Type: application/json');
		 echo json_encode ($message);
		 jexit();
    }

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=art_categories
    public function art_categories()
    {
    	$return_arr = array();

		$query = "SELECT id,parent_id,path,extension,title,description,language FROM #__categories WHERE extension='com_content' AND published='1'";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach($row as $val) {
		  $row_array['article_category_id'] = $val[0];
		  $row_array['parent_id'] = $val[1];
		  $row_array['path'] = $val[2];
		  $row_array['category_name'] = $val[4];
		  $row_array['category_description'] =htmlspecialchars($val[5],ENT_QUOTES);
		  $row_array['language'] =$val[6];

		  array_push($return_arr,$row_array);
		}
		  
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=articles&catid=2
	public function articles()
	{
		$jinput = JFactory::getApplication()->input;
		$cat_id= $jinput->get('catid',2);
		$return_arr = array();

		$query= "SELECT * FROM #__content WHERE catid=$cat_id AND state='1'";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadAssocList();

		foreach($row as $val) {
		  $row_array['article_id'] = $val['id'];
		  $row_array['title'] = $val['title'];
		  $row_array['introtext'] = htmlspecialchars($val['introtext'],ENT_QUOTES);
		  $row_array['fulltext'] = htmlspecialchars($val['fulltext'],ENT_QUOTES);
		  $row_array['language'] =$val['language'];
		  $row_array['featured'] =$val['featured'];
		  $row_array['hits'] =$val['hits'];

		  array_push($return_arr,$row_array);
		}
	  
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=single_article&id=1
	public function single_article()
	{
		$jinput = JFactory::getApplication()->input;
		$id = $jinput->get('id',1);
		$return_arr = array();

		$query= "SELECT * FROM `#__content` WHERE `id` = $id ";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadAssocList();

		foreach($row as $val) {
		  $row_array['article_id'] = $val['id'];
		  $row_array['title'] = $val['title'];
		  $row_array['introtext'] = htmlspecialchars($val['introtext'],ENT_QUOTES);
		  $row_array['fulltext'] = htmlspecialchars($val['fulltext'],ENT_QUOTES);
		  $row_array['language'] =$val['language'];
		  $row_array['featured'] =$val['featured'];
		  $row_array['hits'] =$val['hits'];

		  array_push($return_arr,$row_array);
		}
		  
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=k2_categories
	public function k2_categories(){
		
		$return_arr = array();
		$query = "SELECT id,name,description,image,language,parent FROM `#__k2_categories` WHERE `published` = 1 ";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['name'] = $value[1];
			$row_array['description'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['image'] = "/media/k2/categories/".$value[3];
			$row_array['language'] = $value[4];
			$row_array['parent'] = $value[5];

			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=k2_items&catid=1
	public function k2_items(){
		
		$return_arr = array();
		$jinput = JFactory::getApplication()->input;
		$catid = $jinput->get('catid',1);
		$query = "SELECT id,title,introtext,language,featured FROM `#__k2_items` WHERE `published` = 1 AND `catid` = $catid";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();
		//print_r($row);
		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['title'] = $value[1];
			$row_array['introtext'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['image'] = "media/k2/items/cache/".md5("Image".$value[0])."_XL.jpg";
			$row_array['featured'] = $value[4];
			$row_array['language'] = $value[3];
			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=k2_single_item&id=2
	public function k2_single_item(){
		
		$return_arr = array();
		$jinput = JFactory::getApplication()->input;
		$id = $jinput->get('id',1);
		$query = "SELECT id,title,introtext,language,featured FROM `#__k2_items` WHERE `published` = 1 AND `id` = $id";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();
		//print_r($row);
		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['title'] = $value[1];
			$row_array['introtext'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['image'] = "media/k2/items/cache/".md5("Image".$value[0])."_XL.jpg";
			$row_array['featured'] = $value[4];
			$row_array['language'] = $value[3];
			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=easyblog_categories
	public function easyblog_categories(){
		
		$return_arr = array();
		$query = "SELECT id,title,description,avatar,parent_id,private FROM `#__easyblog_category` WHERE `published` = 1 ";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['title'] = $value[1];
			$row_array['description'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['avatar'] = "/images/easyblog_cavatar/".$value[3];
			$row_array['parent_id'] = $value[4];
			$row_array['private'] = $value[5];

			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=easyblog_posts&catid=1
	public function easyblog_posts(){
		
		$jinput = JFactory::getApplication()->input;
		$cat_id = $jinput->get('catid',1);
		$return_arr = array();
		$query = "SELECT id,title,intro,content,image,frontpage,private,vote,hits,language FROM `#__easyblog_post` WHERE `published` = 2  AND `category_id` = $cat_id";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['title'] = $value[1];
			$row_array['intro'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['content'] = htmlspecialchars($value[3],ENT_QUOTES);
			$row_array['media'] = $value[4];
			$row_array['frontpage'] = $value[5];
			$row_array['private'] = $value[6];
			$row_array['vote'] = $value[7];
			$row_array['hits'] = $value[8];
			$row_array['language'] = $value[9];

			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

	//index.php?option=com_hoicoiapi&task=easyblog_single_post&id=1
	public function easyblog_single_post(){
		
		$jinput = JFactory::getApplication()->input;
		$id = $jinput->get('id',1);
		$return_arr = array();
		$query = "SELECT id,title,intro,content,image,frontpage,private,vote,hits,language FROM `#__easyblog_post` WHERE `published` = 2  AND `id` = $id";

		$db = &JFactory::getDBO(); 
		$db->setQuery($query);
		$row = $db->loadRowList();

		foreach ($row as $key => $value) {
			$row_array['id'] = $value[0];
			$row_array['title'] = $value[1];
			$row_array['intro'] = htmlspecialchars($value[2],ENT_QUOTES);
			$row_array['content'] = htmlspecialchars($value[3],ENT_QUOTES);
			$row_array['media'] = $value[4];
			$row_array['frontpage'] = $value[5];
			$row_array['private'] = $value[6];
			$row_array['vote'] = $value[7];
			$row_array['hits'] = $value[8];
			$row_array['language'] = $value[9];

			array_push($return_arr, $row_array);
		} 
		header('Content-Type: application/json');
		echo json_encode($return_arr);
		jexit();
	}

}
