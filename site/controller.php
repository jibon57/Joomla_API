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
class hoicoiapiController extends JControllerLegacy {

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=login&username=test&pass=test
    public function login() {

        $app = JFactory::getApplication();

        $credentials = array(
            'username' => $app->input->get('username', '', 'USERNAME'),
            'password' => $app->input->get('pass', '', 'STRING')
        );

        if ($app->login($credentials)) {
            // Success
            $user = JFactory::getUser();
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
    public function registration() {

        $input = $this->input;

        $name = $input->get('name', '', 'STRING');
        $username = $input->get('username', '', 'USERNAME');
        $passwd = $input->get('passwd', '', 'STRING');
        $email = $input->get('email', '', 'STRING');

        $requestData = array(
            "name" => $name,
            "username" => $username,
            "password1" => $passwd,
            "email1" => $email,
        );

        include_once JPATH_ROOT . '/components/com_users/models/registration.php';
        JFactory::getLanguage()->load('com_users');
        $model = new UsersModelRegistration();
        $register = $model->register($requestData);

        if ($register === false) {
            $status = $model->getError();
        } else {
            $status = "Success";
        }

        $message = array(
            'message' => $status
        );

        header('Content-Type: application/json');
        echo json_encode($message);
        jexit();
    }

    //index.php?option=com_hoicoiapi&task=getEasyblog

    public function getEasyblog() {
        if (!file_exists(JPATH_ROOT . "/administrator/components/com_easyblog/includes/easyblog.php")) {
            jexit("You don't have install EasyBlog");
        }
        include_once JPATH_ROOT . "/administrator/components/com_easyblog/includes/easyblog.php";
        include_once JPATH_ROOT . "/administrator/components/com_easyblog/models/categories.php";

        $model = new EasyBlogModelCategories();
        $items = $model->getCategoriesHierarchy();
        $output = array();

        if ($items && !$this->input->get("catid") && !$this->input->get("id")) {

            foreach ($items as $item) {
                $item = get_object_vars($item);
                if ($item['avatar']) {
                    $item['avatar'] = "/images/easyblog_cavatar/" . $item['avatar'];
                }
                $output[] = $item;
            }
        } elseif ($this->input->get("catid")) {
            include_once JPATH_ROOT . '/administrator/components/com_easyblog/models/blog.php';
            $model = new EasyBlogModelBlog();
            $items = $model->getBlogsBy('', '', '', 0, EBLOG_FILTER_PUBLISHED, null, true, '', false, false, true, '', $this->input->get("catid"), null, 'listlength', '');
            foreach ($items as $item) {
                $output[] = get_object_vars($item);
            }
        } elseif ($this->input->get("id")) {
            $post = EB::post($this->input->get("id"));
            $output = get_object_vars($post->original);
            $output['intro'] = htmlspecialchars($post->getContent(), ENT_QUOTES);
            $output['image'] = $post->getImage();
            $output['videos'] = $post->videos;
            $output['author'] = $post->getAuthor()->nickname;
            $output['author_link'] = $post->getAuthor()->getPermalink();
            $output['author_avatar'] = $post->getAuthor()->avatar;
            $output['comments'] = $post->getComments();
            $output['custom_fields'] = $post->getCustomFields();

            if ($output['comments']) {
                foreach ($output['comments'] as $comment) {
                    if (empty($comment->name)) {
                        $comment->name = $comment->author->nickname;
                    }
                    unset($comment->author);
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getContents
    public function getContents() {
        $output = array();
        $db = JFactory::getDbo();
        $db->query(true);
        $query = "SELECT * FROM `#__categories` WHERE `extension`  = 'com_content'";
        $db->setQuery($query);
        $items = $db->loadAssocList();
        if ($items && !$this->input->get('catid') && !$this->input->get('id')) {
            foreach ($items as $item) {
                $output[] = $item;
            }
        } elseif ($this->input->get('catid')) {
            include_once JPATH_ROOT . '/components/com_content/models/articles.php';
            $model = new ContentModelArticles();
            $model->setState('filter.category_id', $this->input->get('catid'));
            $items = $model->getItems();
            foreach ($items as $item) {
                $output[] = $item;
            }
        } elseif ($this->input->get('id')) {
            include_once JPATH_ROOT . '/components/com_content/models/article.php';
            $model = new ContentModelArticle();
            $output = $model->getItem($this->input->get('id'));
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getkunena
    public function getkunena() {
        if (!file_exists(JPATH_ROOT . '/libraries/kunena/attachment/helper.php')) {
            jexit("You don't have install Kunena");
        }
        include_once JPATH_ROOT . '/components/com_kunena/models/category.php';
        include_once JPATH_ROOT . '/libraries/kunena/attachment/helper.php';

        $output = array();
        $model = new KunenaModelCategory();
        $items = KunenaForumCategoryHelper::getCategories();

        $input = $this->input;

        if ($items && !$input->get("catid") && !$input->get("id")) {
            foreach ($items as $item) {
                $data = get_object_vars($item);
                $output[] = $data;
            }
        } elseif ($input->get("catid")) {
            $output = array();
            $model->setState('item.id', $input->get("catid", 1));
            $items = $model->getTopics();
            foreach ($items as $item) {
                $data = get_object_vars($item);
                $output[] = $data;
            }
        } elseif ($input->get("id")) {
            $output = array();
            include_once JPATH_ROOT . '/components/com_kunena/models/topic.php';
            include_once JPATH_ROOT . '/libraries/kunena/attachment/helper.php';
            $model = new KunenaModelTopic();
            $model->setState('item.mesid', $input->get("catid", 1));
            $items = $model->getMessages();
            foreach ($items as $item) {
                $data = get_object_vars($item);
                $data['attachment'] = KunenaAttachmentHelper::getByMessage($item->id);
                $output[] = $data;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getK2
    public function getK2() {
        if (!file_exists(JPATH_ROOT . '/components/com_k2/models/itemlist.php') || !file_exists(JPATH_ROOT . '/modules/mod_k2_content/helper.php')) {
            jexit("You must need to install K2 component & module");
        }
        include_once JPATH_ROOT . '/components/com_k2/models/itemlist.php';

        $output = array();
        $model = new K2ModelItemlist();
        $db = JFactory::getDBO();
        $query = "SELECT id,parent,name,description,alias,image,language FROM #__k2_categories WHERE published=1  AND trash=0";
        $db->setQuery($query);
        $items = $db->loadObjectList();

        if ($items && !$this->input->get("catid") && !$this->input->get("id")) {
            foreach ($items as $item) {
                $item = get_object_vars($item);
                if ($item["image"]) {
                    $item["image"] = "/media/k2/categories/" . $item["image"];
                }
                $output[] = $item;
            }
        } elseif ($this->input->get("catid")) {
            $model->set("task", "category");
            $model->set("id", $this->input->get("catid"));
            $total = $model->countCategoryItems($this->input->get("catid"));

            include_once JPATH_ROOT . '/modules/mod_k2_content/helper.php';
            $module = JModuleHelper::getModule('mod_k2_content');
            $params = new JRegistry($module->params);
            $params['itemImage'] = 1;
            $params['itemCount'] = (int) $total;
            $params['itemIntroText'] = 1;
            $params['itemVideo'] = 1;
            $items = modK2ContentHelper::getItems($params);
            foreach ($items as $item) {
                $item = get_object_vars($item);
                if ($item['params'] || $item['categoryparams']) {
                    unset($item['params']);
                    unset($item['categoryparams']);
                }
                if ($item['catid'] == $this->input->get("catid")) {
                    $output[] = $item;
                }
            }
            //
        } elseif ($this->input->get("id")) {

            include_once JPATH_ROOT . '/modules/mod_k2_content/helper.php';
            $module = JModuleHelper::getModule('mod_k2_content');
            $params = new JRegistry($module->params);
            $params['itemImage'] = 1;
            $params['itemCount'] = (int) $total;
            $params['itemIntroText'] = 1;
            $params['itemVideo'] = 1;
            $params['items'] = $this->input->get("id");
            $items = modK2ContentHelper::getItems($params);

            foreach ($items as $item) {
                $item = get_object_vars($item);
                if ($item['params'] || $item['categoryparams']) {
                    unset($item['params']);
                    unset($item['categoryparams']);
                }
                if ($item['id'] == $this->input->get("id")) {
                    $output[] = $item;
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getVM&lan=en_gb
    public function getVM() {

        if (!file_exists(JPATH_ROOT . '/administrator/components/com_virtuemart/helpers/config.php')) {

            jexit("You don't have install VM");
        }
        include_once JPATH_ROOT . '/administrator/components/com_virtuemart/helpers/config.php';
        include_once JPATH_ROOT . '/administrator/components/com_virtuemart/models/category.php';
        include_once JPATH_ROOT . '/administrator/components/com_virtuemart/models/media.php';

        $output = array();
        VmConfig::$vmlang = $this->input->get("lan", "en_gb", "STRING");
        $model = new VirtueMartModelCategory();
        $items = $model->getCategories();
        $mediaModel = new VirtueMartModelMedia();

        if ($items && !$this->input->get("catid") && !$this->input->get("id")) {
            foreach ($items as $key => $item) {

                $item = get_object_vars($item);
                $item['media'] = $mediaModel->getFiles("", "", "", $item['virtuemart_category_id']);
                $output[] = $item;
            }
        } elseif ($this->input->get("catid")) {
            include_once JPATH_ROOT . '/administrator/components/com_virtuemart/models/product.php';
            $model = new VirtueMartModelProduct();
            $items = $model->getProductsInCategory($this->input->get("catid"));

            foreach ($items as $key => $item) {

                $item = get_object_vars($item);
                $item['media'] = $mediaModel->getFiles("", "", $item['virtuemart_product_id']);
                //echo $item['virtuemart_product_id'];
                $output[] = $item;
            }
        } elseif ($this->input->get("id")) {
            include_once JPATH_ROOT . '/administrator/components/com_virtuemart/models/product.php';
            $model = new VirtueMartModelProduct();
            $item = get_object_vars($model->getProduct($this->input->get("id")));
            $item['media'] = $mediaModel->getFiles("", "", $item['virtuemart_product_id']);
            $output[] = $item;
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    // http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getHika
    public function getHika() {

        if (!file_exists(JPATH_ROOT . '/administrator/components/com_hikashop/helpers/helper.php')) {
            jexit("You don't have Hikashop installed");
        }
        include_once JPATH_ROOT . '/administrator/components/com_hikashop/helpers/helper.php';
        include_once JPATH_ROOT . '/administrator/components/com_hikashop/classes/category.php';

        $output = array();
        $model = new hikashopCategoryClass();
        $items = $model->getList();
        if ($items && !$this->input->get("catid") && !$this->input->get("id")) {

            foreach ($items as $item) {
                $item = get_object_vars($item);
                $item['media'] = $this->getHikaImages($item['category_id']);
                $output[] = $item;
            }
        } elseif ($this->input->get("catid")) {
            $db = JFactory::getDbo();
            $query = "SELECT product_id FROM #__hikashop_product_category WHERE" . $db->quoteName('category_id') . " = " . $db->quote($this->input->get("catid"));
            $db->setQuery($query);
            $items = $db->loadColumn();

            include_once JPATH_ROOT . '/administrator/components/com_hikashop/classes/product.php';
            $model = new hikashopProductClass();
            if ($model->getProducts($items)) {
                $products = $model->all_products;
                foreach ($products as $product) {
                    $output[] = $product;
                }
            }
        } elseif ($this->input->get("id")) {
            include_once JPATH_ROOT . '/administrator/components/com_hikashop/classes/product.php';
            $model = new hikashopProductClass();
            $model->getProducts($this->input->get("id"));
            $product = $model->products;
            $output = $product[$this->input->get("id")];
        }
        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

    protected function getHikaImages($id) {
        include_once JPATH_ROOT . '/administrator/components/com_hikashop/helpers/helper.php';
        include_once JPATH_ROOT . '/administrator/components/com_hikashop/helpers/image.php';
        $db = JFactory::getDBO();
        $query = "SELECT file_path FROM #__hikashop_file WHERE file_ref_id={$id} ";
        $db->setQuery($query);
        $items = $db->loadAssocList();
        $output = array();
        $model = new hikashopImageHelper();
        foreach ($items as $item) {
            $output[] = get_object_vars($model->getThumbnail($item['file_path']));
        }
        return $output;
    }
    
    //http://YOURSITE.COM/index.php?option=com_hoicoiapi&task=getAdsm
    //Image path: http://YOURSITE.COM/images/com_adsmanager/contents/FILE_NAME
    public function getAdsm() {

        if (!file_exists(JPATH_ROOT . '/components/com_adsmanager/lib/core.php')) {
            jexit("You don't have AdsManager installed");
        }
        include_once JPATH_ROOT . '/components/com_adsmanager/lib/core.php';
        include_once JPATH_ROOT . '/administrator/components/com_adsmanager/models/category.php';
        include_once JPATH_ROOT . '/administrator/components/com_adsmanager/models/content.php';

        $output = array();
        $model = new AdsmanagerModelCategory();
        $items = $model->getCategories(true);
        $input = $this->input;

        if ($items && !$input->get("catid") && !$input->get("id")) {
            foreach ($items as $item) {
                $data = get_object_vars($item);
                $output[] = $data;
            }
        } elseif ($input->get("catid")) {
            $model = new AdsmanagerModelContent();
            $filters['category'] = $catid;
            $items = $model->getContents($filters);

            foreach ($items as $item) {
                $data = get_object_vars($item);
                $output[] = $data;
            }
        } elseif ($input->get("id")) {
            $model = new AdsmanagerModelContent();
            $item = $model->getContent($input->get("id"), true);
            $data = get_object_vars($item);
            $output[] = $data;
        }

        header('Content-Type: application/json');
        echo json_encode($output);
        jexit();
    }

}
