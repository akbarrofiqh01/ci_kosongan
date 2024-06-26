<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['login']                         = 'authentication/login';
$route['signup']                        = 'authentication/register';
$route['logout']                        = 'authentication/logout';
$route['signup/(:any)/(:any)']          = 'authentication/register/$1/$2';
$route['forgot-password']               = 'authentication/forgotPassword';
$route['forgot-password/(:any)']        = 'authentication/forgotPassword/$1';
$route['reset-password/(:any)']         = 'authentication/forgotPassword/$1';

$route['dashboard']                     = 'dashboard/view_page/dashboard';
$route['landingpage']                   = 'frontpage/index';
// $route['information/(:any)']            = 'dashboard/view_info/$1';
$route['information/(:any)']            = 'dashboard/view_produk/$1';
$route['generation/(:any)']             = 'dashboard/view_gen/$1';
$route['admin/add-news']                = 'administrator/index/add-news';
$route['admin/edit-news/(:any)']        = 'administrator/editnews/$1';
$route['admin-invoice/(:any)']          = 'administrator/index/$1';
$route['admin-withdraw/(:any)']         = 'administrator/index/$1';
$route['admin/data-keberangkatan/(:any)']  = 'administrator/berangkat/$1';
$route['admin/(:any)']                  = 'administrator/index/$1';
$route['(:any)']                        = 'dashboard/view_page/$1';


$route['default_controller']            = 'authentication/login';
$route['404_override']                  = '';
$route['translate_uri_dashes']          = FALSE;
