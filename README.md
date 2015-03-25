# Joomla API for mobile apps (Android, Iphone/Ipad & External site)

With this component you can easily retrieve data from Joomla site for mobile devices or other external website. You can use this API if you want to published Joomla contnent articles, K2 items, easyblog posts or virtuemart products in another PHP site. This component will work both for Joomla 2.5 & 3.X.
Most of the mobile apps use JSON array to collect data from webserver. This extension will converted Joomla information into JSON format . So apps developer can collect information quickly & easily. 

What can you do with this ?
> Can get categories, articles of Joomla content.
> Can get Virtuemart products & categories with images,price etc.
> Can make authentication directly using Joomla username & password
> Can make user registration.
> Support for K2 & easyblog.

 
Services 	URL
Login 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=login&username=USERNAME&pass=PASSWORD
Registration 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=registration&name=NAME&username=USERNAME&passwd=PASSWORD&email=EMAIL
Article Categories 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=art_categories
Article of a Category 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=articles&catid=2
Single Article 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=single_article&id=1
Virtuemart Categories 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=vmcategories&lan=en_gb
Virtuemart Products in a Category 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=vmproducts&lan=en_gb&catid=6
Virtuemart Single Product 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=vmsingle_product&lan=en_gb&id=62
K2 Categories 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=k2_categories
K2 Items in a category 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=k2_items&catid=1
K2 Single Items 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=k2_single_item&id=2
Easyblog Categories 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=easyblog_categories
Easyblog Posts in a category 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=easyblog_posts&catid=1
Easyblog Single Post 	http://YOURDOMIN_NAME/index.php?option=com_hoicoiapi&task=easyblog_single_post&id=1

More: https://extensions.hoicoimasti.com/products/8-joomla-extension/3-joomla-api-for-mobile-apps-android,-iphone-ipad-external-site.html
