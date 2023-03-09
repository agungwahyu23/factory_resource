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
|	https://codeigniter.com/userguide3/general/routing.html
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

// frontend
$route['default_controller'] = 'frontend/Home/index';
$route['index'] = 'frontend/Home/index';
$route['about'] = 'frontend/Home/about';
$route['package'] = 'frontend/Home/package';
$route['order/(:any)'] = 'frontend/Home/order/$1';
$route['send_wa/(:any)'] = 'frontend/Home/send_wa/$1';
$route['contact'] = 'frontend/Home/contact';
$route['question'] = 'frontend/Home/send_question';
$route['detail/(:any)'] = 'frontend/Home/detail/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] =   'Dashboard/index';
$route['log-sign'] =   'Auth/index';

/* produk */
$route['user_group'] =   'UserGroup/index';
$route['user_group/add'] =   'Master/Product/add';
$route['user_group/edit/(:any)'] =   'Master/Product/edit/$1';

/* Chef */
$route['chef'] =   'Chef/index';
$route['chef-add'] =   'Chef/add';
$route['chef-update/(:any)'] =   'Chef/update/$1';

/* Promo     */
$route['promo'] =   'Promo/index';
$route['promo-add'] =   'Promo/add';
$route['promo-update/(:any)'] =   'Promo/update/$1';
$route['promo-detail/(:any)'] =   'Promo/detail/$1';

/* Package */
$route['admin-package'] =   'Package/index';
$route['package-add'] =   'Package/add';
$route['package-update/(:any)'] =   'Package/update/$1';
$route['package-detail/(:any)'] =   'Package/detail/$1';
$route['package-image/(:any)'] =   'Package/image/$1';
$route['package-listimage/(:any)'] =   'Package/ajax_image/$1';
$route['package-schedule/(:any)'] =   'Package/schedule/$1';
$route['package-listschedule/(:any)'] =   'Package/ajax_schedule/$1';

/* Order */
$route['order'] =   'Order/index';
$route['order-add'] =   'Order/add';
$route['order-detail/(:any)'] =   'Order/detail/$1';

/* User */
$route['user'] =   'User/index';
$route['user-add'] =   'User/add';
$route['user-update/(:any)'] =   'User/update/$1';
$route['user-detail/(:any)'] =   'User/detail/$1';

$route['settings'] =   'Setting/index';
