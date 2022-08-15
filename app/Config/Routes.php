<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/masuk', 'Auth::masuk');
$routes->get('/daftar', 'Auth::daftar');
$routes->post('/login', 'Auth::login');
$routes->post('/register', 'Auth::register');

$routes->group('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'Admin::index');

    $routes->group('product', function ($routes) {
        $routes->get('/', 'Product::index');
        $routes->get('add', 'Product::add');
        $routes->get('update', 'Product::update');

        $routes->post('post', 'Product::post');
        $routes->post('put', 'Product::put');
        $routes->get('delete', 'Product::delete');
    });
});

$routes->group('user', ['namespace' => 'App\Controllers\User'], function ($routes) {
    $routes->get('/', 'User::index');

    $routes->group('product', function ($routes) {
        $routes->get('/', 'Product::index');
        $routes->get('add', 'Product::add');
        $routes->get('update', 'Product::update');

        $routes->post('post', 'Product::post');
        $routes->post('put', 'Product::put');
        $routes->get('delete', 'Product::delete');
    });

    $routes->group('cart', function ($routes) {
        $routes->get('/', 'Cart::index');
        $routes->get('add/(:num)', 'Cart::add/$1');
        $routes->get('remove/(:num)', 'Cart::remove/$1');
    });
});

$routes->group('mazer', ['namespace' => 'App\Controllers\Mazer'], function ($routes) {
    $routes->get('/', 'Mazer::index');
    $routes->get('table', 'Table::index');
    $routes->get('datatable', 'Table::datatable');

    $routes->group('components', function ($routes) {
        $routes->get('alert', 'Component::alert');
        $routes->get('badge', 'Component::badge');
        $routes->get('breadcrumb', 'Component::breadcrumb');
        $routes->get('button', 'Component::button');
        $routes->get('card', 'Component::card');
        $routes->get('carousel', 'Component::carousel');
        $routes->get('dropdown', 'Component::dropdown');
        $routes->get('list-group', 'Component::listGroup');
        $routes->get('modal', 'Component::modal');
        $routes->get('navs', 'Component::navs');
        $routes->get('pagination', 'Component::pagination');
        $routes->get('progress', 'Component::progress');
        $routes->get('spinner', 'Component::spinner');
        $routes->get('tooltip', 'Component::tooltip');
    });

    $routes->group('extra', function ($routes) {
        $routes->group('components', function ($routes) {
            $routes->get('avatar', 'Component::extra_avatar');
            $routes->get('sweet-alert', 'Component::extra_sweetAlert');
            $routes->get('toastify', 'Component::extra_toastify');
            $routes->get('rating', 'Component::extra_rating');
            $routes->get('divider', 'Component::extra_divider');
        });
    });

    $routes->group('layouts', function ($routes) {
        $routes->get('default', 'Layout::default');
        $routes->get('1-column', 'Layout::oneColumn');
        $routes->get('vertical-navbar', 'Layout::verticalNavbar');
        $routes->get('horizontal', 'Layout::horizontal');
    });

    $routes->group('forms', function ($routes) {
        $routes->get('input', 'Form::input');
        $routes->get('input-group', 'Form::inputGroup');
        $routes->get('select', 'Form::select');
        $routes->get('radio', 'Form::radio');
        $routes->get('checkbox', 'Form::checkbox');
        $routes->get('textarea', 'Form::textarea');
        $routes->get('layout', 'Form::layout');

        $routes->group('editor', function ($routes) {
            $routes->get('quill', 'Form::editor_quill');
            $routes->get('ckeditor', 'Form::editor_ckeditor');
            $routes->get('summernote', 'Form::editor_summernote');
            $routes->get('tinymce', 'Form::editor_tinymce');
        });
    });

    $routes->group('ui', function ($routes) {
        $routes->get('file-uploader', 'Widget::fileUploader');

        $routes->group('widgets', function ($routes) {
            $routes->get('chatbox', 'Widget::chatbox');
            $routes->get('pricing', 'Widget::pricing');
            $routes->get('to-do-list', 'Widget::toDoList');
        });

        $routes->group('icons', function ($routes) {
            $routes->get('bootstrap-icons', 'Icon::bootstrapIcons');
            $routes->get('fontawesome', 'Icon::fontawesome');
            $routes->get('dripicons', 'Icon::dripicons');
        });

        $routes->group('charts', function ($routes) {
            $routes->get('chartjs', 'Chart::chartJs');
            $routes->get('apexcharts', 'Chart::apexCharts');
        });

        $routes->group('maps', function ($routes) {
            $routes->get('google-map', 'Map::googleMap');
            $routes->get('jsvector-map', 'Map::jsVectorMap');
        });
    });

    $routes->group('applications', function ($routes) {
        $routes->get('email', 'Application::email');
        $routes->get('chat', 'Application::chat');
        $routes->get('gallery', 'Application::gallery');
        $routes->get('checkout', 'Application::checkout');

        $routes->group('auth', function ($routes) {
            $routes->get('login', 'Application::auth_login');
            $routes->get('register', 'Application::auth_register');
            $routes->get('forgot-password', 'Application::auth_forgotPassword');
        });

        $routes->group('errors', function ($routes) {
            $routes->get('403', 'Application::error_403');
            $routes->get('404', 'Application::error_404');
            $routes->get('500', 'Application::error_500');
        });
    });
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
