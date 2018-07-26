# Joomla API for mobile apps (Android, Iphone/Ipad & External site)

This extension will help you to retrieve data from Joomla site for mobile devices or other external website easily. You can use this API if you want to publish Joomla articles, K2 items, easyblog posts or virtuemart products in another PHP site. This component will work with Joomla 3.X.
Most of the mobile apps use JSON array to collect data from webserver. This extension will converted Joomla information into JSON format. So apps developer can collect information quickly & easily. 

**Supported Extensions/Features**
<pre>
> Joomla authentication directly using Joomla username & password
> Joomla registration
> Joomla contents, K2, easyblog, Virtuemart, Hikashop, Kunena Forum, AdsManager ....
</pre>

From version 3.2+ you will be able to use `jsonp` feature. In this case you will need to send an extra field `callback` during `GET` or `POST` request. Example in jQuery:

```javascript
jQuery("document").ready(function($){
    var url = "http://MyJoomla.com/index.php?option=com_hoicoiapi&task=getContents&token=TOKEN";
   
    $.ajax({
	
        method: "GET",
        dataType: "jsonp",
        url: url,
        
        success: function(res){
            console.log(res);
        },
        error: function(res){
            console.log(res);
        }
    })
})
```
Without jQuery:

```javascript
var url = "http://MyJoomla.com/index.php?option=com_hoicoiapi&task=getContents&token=TOKEN&callback=MYCALLBACK";
```

More: https://www.hoicoimasti.com/products/8-joomla-extension/3-joomla-api-for-mobile-apps-android,-iphone-ipad-external-site.html
