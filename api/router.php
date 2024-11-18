<?php
    include_once 'libs/response.php';
    include_once 'libs/router.php';
    include_once 'controllers/InstrumentosApiController.php';
    include_once 'controllers/MarcasApiController.php';
    include_once 'controllers/UserApiController.php';
    include_once 'middlewares/jwt.auth.middleware.php';

    define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

    $response = new Response();

    $router = new Router();

    // Rutas de instrumentos
    $router->addRoute('instrumentos', 'GET', 'InstrumentosController', 'getAllInstrumentos');
    $router->addRoute('instrumentos/:id', 'GET', 'InstrumentosController', 'getInstrumento');
    $router->addRoute('instrumentos', 'POST', 'InstrumentosController', 'create');
    $router->addRoute('instrumentos/:id', 'PUT', 'InstrumentosController', 'edit');
    $router->addRoute('instrumentos/:id', 'DELETE', 'InstrumentosController', 'delete');

    // Rutas de marcas
    $router->addRoute('marcas', 'GET', 'MarcasController', 'getAll');
    $router->addRoute('marcas/:id', 'GET', 'MarcasController', 'get');
    $router->addRoute('marcas', 'POST', 'MarcasController', 'create');
    $router->addRoute('marcas/:id', 'PUT', 'MarcasController', 'update');
    $router->addRoute('marcas/:id', 'DELETE', 'MarcasController', 'delete');

    // Rutas del usuario
    $router->addRoute('login', 'POST', 'UserController', 'login');
    $router->addRoute('logout', 'DELETE', 'UserController', 'logout');

    $router->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>
