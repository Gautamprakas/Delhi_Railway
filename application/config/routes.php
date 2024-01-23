<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/



$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/*GET*/
$route['api/categories/get_all_categories']['GET'] = 'api/categories_controller/get_all_categories';
$route['api/products/get_products']['GET'] = 'api/products_controller/get_products_by_categories';
$route['api/cart/get']['GET'] = 'api/cart_controller/get';
$route['api/filter/get']['GET'] = 'api/attributes_controller/get_attributes';
$route['api/location/get']['GET'] = 'api/attributes_controller/get_location';
$route['api/prodtype/get']['GET'] = 'api/attributes_controller/get_prodtype';
$route['api/sorting/get']['GET'] = 'api/products_controller/get_sorting';
$route['api/products/get_product_detail']['GET'] = 'api/products_controller/get_product_detail';
$route['api/review/get_review']['GET'] = 'api/review_controller/get_review';
$route['api/order/history']['GET'] = 'api/order_controller/history';
/*GET*/


/*POST*/
$route['api/cart/add']['POST'] = 'api/cart_controller/add';
$route['api/cart/delete']['POST'] = 'api/cart_controller/delete';
$route['api/auth/signup']['POST'] = 'api/auth_controller/signup';
$route['api/auth/login']['POST'] = 'api/auth_controller/login';
$route['api/order/now']['POST'] = 'api/order_controller/now';
$route['api/order/trans_verify']['POST'] = 'api/order_controller/trans_verify';
$route['api/review/add']['POST'] = 'api/review_controller/add';
/*POST*/

/*Web*/
$route['home']['GET'] = 'web/home_controller/home';
$route['important_links']['GET'] = 'web/home_controller/important_links';
$route['product/list']['GET'] = 'web/product_controller/listing';
$route['product/detail']['GET'] = 'web/product_controller/detail';
$route['cart/view']['GET'] = 'web/cart_controller/view';
$route['policy/term']['GET'] = 'web/policy_controller/term';
$route['policy/privacy']['GET'] = 'web/policy_controller/privacy';
$route['online_payment/pay']['GET'] = 'web/razorpay_controller/pay';
$route['online_payment/verify']['GET'] = 'web/razorpay_controller/verify';
/**/

$route['welcome']['GET'] = 'welcome/index';
$route['welcome/import_csv']['GET'] = 'welcome/import_csv';
$route['migrate']['GET'] = 'Migrate';
$route['migrate/create_db']['GET'] = 'Migrate/create_db';
$route['(.*)'] = function(){
	return 'api/my_error/route_404';
};
