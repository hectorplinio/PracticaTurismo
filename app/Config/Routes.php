<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(false);

if(!defined('REST_NAMESPACE'))define ('REST_NAMESPACE', 'App\Controllers\Rest');
if(!defined('COMMAND_NAMESPACE'))define ('COMMAND_NAMESPACE', 'App\Controllers\Command');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group('rest', function ($routes){
    //--RESTAURANTS--//
    $routes->get('restaurants', 'RestaurantsController::restaurantsRest' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('restaurants/(:any)', 'RestaurantsController::restaurantsRest/$1' , ['namespace' => REST_NAMESPACE ]);
   
    //--GASSTATIONS--//
    $routes->get('gasStations', 'GasStationsController::gasStationsRest' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('gasStations/(:any)', 'GasStationsController::gasStationsRest/$1' , ['namespace' => REST_NAMESPACE ]);
    
    //--WEATHER--//
    $routes->get('weather', 'WeatherController::weatherRest' , ['namespace' => REST_NAMESPACE ]);
    // $routes->get('weather/(:any)', 'WeatherController::weatherRest/$1' , ['namespace' => REST_NAMESPACE ]);
    
    //--NEWS--//
    $routes->get('news', 'NewsController::newsRest' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('news/(:any)', 'NewsController::newsRest/$1' , ['namespace' => REST_NAMESPACE ]);

    //--VIDEOS--//
    $routes->get('videos', 'VideosController::videosRest' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('videos/(:any)', 'VideosController::videosRest/$1' , ['namespace' => REST_NAMESPACE ]);
    //--REVIEWS--//
    $routes->get('reviewsRestaurant/', 'ReviewsController::reviewsRest/' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('reviewsRestaurant/(:any)', 'ReviewsController::reviewsRest/$1' , ['namespace' => REST_NAMESPACE ]);
    $routes->post('reviewsRestaurant/', 'ReviewsController::reviewsUpdateRest/' , ['namespace' => REST_NAMESPACE ]);
    $routes->delete('reviewsRestaurant/', 'ReviewsController::reviewsDeleteRest/' , ['namespace' => REST_NAMESPACE ]);

    $routes->get('reviewsId/', 'ReviewsController::reviewsIdRest/' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('reviewsId/(:any)', 'ReviewsController::reviewsIdRest/$1' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('reviewsRestaurantEmail/', 'ReviewsController::reviewsRestaurantEmailRest/' , ['namespace' => REST_NAMESPACE ]);
    $routes->get('reviewsRestaurantEmail/(:any)/(:any)', 'ReviewsController::reviewsRestaurantEmailRest/$1/$2' , ['namespace' => REST_NAMESPACE ]);
});
    //--COMMANDS--//
    $routes->group('commands', function ($routes){
        $routes->cli('commandGas', 'GasStationsCommand::gasStations' , ['namespace' => COMMAND_NAMESPACE ]);
        $routes->cli('commandWeather', 'WeatherCommand::weatherCommand' , ['namespace' => COMMAND_NAMESPACE ]);
        $routes->cli('commandNews', 'NewsCommand::newsCommand' , ['namespace' => COMMAND_NAMESPACE ]);
        $routes->cli('commandVideos', 'VideosCommand::videosCommand' , ['namespace' => COMMAND_NAMESPACE ]);

    // $routes->delete('categories', 'CategoriesController::categoriesDeleteRest' , ['namespace' => REST_NAMESPACE ]);
    // $routes->post('categories', 'CategoriesController::categoriesUpdateRest' , ['namespace' => REST_NAMESPACE ]);    
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
