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
$route['default_controller'] = 'Auth/index';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] =   'Dashboard/index';
$route['log-sign'] =   'Auth/index';

/* item manajemen */
$route['item'] =   'Item/index';
$route['item-add'] =   'Item/add';
$route['item-add-detail/(:any)'] =   'Item/index_material/$1';
$route['list-item-material/(:any)'] = 'Item/list_material_item/$1';
$route['item-update/(:any)'] =   'Item/update/$1';
$route['item-detail/(:any)'] =   'Item/detail/$1';

/* material manajemen */
$route['material'] =   'Material/index';
$route['material-add'] =   'Material/add';
$route['material-update/(:any)'] =   'Material/update/$1';
$route['material-detail/(:any)'] =   'Material/detail/$1';

/* request */
$route['request'] =   'Request/index';
$route['request-add'] =   'Request/add';
$route['request-update/(:any)'] =   'Request/update/$1';
$route['request-detail/(:any)'] =   'Request/detail/$1';

/* return */
$route['return'] =   'Return/index';
$route['return-add'] =   'Return/add';
$route['return-update/(:any)'] =   'Return/update/$1';
$route['return-detail/(:any)'] =   'Return/detail/$1';

/* User */
$route['user'] =   'User/index';
$route['user-add'] =   'User/add';
$route['user-update/(:any)'] =   'User/update/$1';
$route['user-detail/(:any)'] =   'User/detail/$1';

$route['settings'] =   'Setting/index';
