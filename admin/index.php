<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING );
ini_set('display_errors',0);

/**
 * Константа для предотвращения прямого доступа к файлам, только вставка
 */
define('_JEXEC', 1);

# checking for minimum PHP version
if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    exit("Sorry, this code does not run on a PHP version smaller than 5.5.0 !");
}

# Подключаем основной функционал
require_once "library/autoload.php";
$app = new LandingPageAPP();

$app->basedir = __dir__;

# META
$app->meta = new stdClass();
# Название сайта
$app->meta->sitename = 'Dan\'s Food Admin';
# Заголовок
$app->meta->title = 'Dan\'s Food Admin';
# Описание
$app->meta->desc = 'Dan\'s Food Admin';
# Картинка для соц. сетей, размер: 1200x630px
$app->meta->image = $app->baseurl.'/assets/images/social.jpg';

# ----------------------- ВНИМАНИЕ ----------------------- #
/*
 * На странице работает функция, которая генерирует CSS из Less
 * Если есть необходиость править стили, то править нужно Less файл (!!!)
 * Less файл лежит тут: assets/less/style.less
 * Если у вас не обновляются стили на новом хосте, нужно 
 * удалить кеш-файл: assets/less/style.less.cache (!!!)
 * Вопросы, жалобы, пожелания писать сюда: colin990@gmail.com :)
*/

/*
 * Проверяем залогинен ли пользователь
 * Если нет, то показываем страницу для логина
*/
if ( !$app->isUserLoggedIn ) :
	$auth = new Auth();
	$auth->Login();
	
	die();
endif;

/*
 * Задаем роутинг
 * Библиотека роутера: https://github.com/daveh/php-mvc

 * Routes are added with the add method. You can add fixed URL routes, and specify the controller and action, like this:
 * $router->add('', ['controller' => 'Home', 'action' => 'index']);
 * $router->add('posts/index', ['controller' => 'Posts', 'action' => 'index']);

 * Or you can add route variables, like this:
 * $router->add('{controller}/{action}');

 * In addition to the controller and action, you can specify any parameter you like within curly braces, and also specify a custom regular expression for that parameter:
 * $router->add('{controller}/{id:\d+}/{action}');
*/

$router = new Router();

$router->add('', ['controller' => 'Index', 'action' => 'LoadView']);
$router->add('login', ['controller' => 'Auth', 'action' => 'Login']);
$router->add('logout', ['controller' => 'Auth', 'action' => 'Logout']);
$router->add('registration', ['controller' => 'Auth', 'action' => 'Registration']);
$router->add('profile', ['controller' => 'Auth', 'action' => 'EditProfile']);

$router->add('menus', ['controller' => 'Menu', 'action' => 'getList']);
$router->add('menu', ['controller' => 'Menu', 'action' => 'addItem']);
$router->add('menu/{id:\d+}', ['controller' => 'Menu', 'action' => 'addItem']);
$router->add('menu-delete/{id:\d+}', ['controller' => 'Menu', 'action' => 'delItem']);

$router->add('articles', ['controller' => 'Article', 'action' => 'getList']);
$router->add('article', ['controller' => 'Article', 'action' => 'addItem']);
$router->add('article/{id:\d+}', ['controller' => 'Article', 'action' => 'addItem']);
$router->add('article-delete/{id:\d+}', ['controller' => 'Article', 'action' => 'delItem']);

$router->add('reviews', ['controller' => 'Review', 'action' => 'getList']);
$router->add('review', ['controller' => 'Review', 'action' => 'addItem']);
$router->add('review/{id:\d+}', ['controller' => 'Review', 'action' => 'addItem']);
$router->add('review-delete/{id:\d+}', ['controller' => 'Review', 'action' => 'delItem']);

$router->add('fields', ['controller' => 'Fields', 'action' => 'getList']);
$router->add('getfield/{type:\w+}/{index:\d+}', ['controller' => 'Fields', 'action' => 'getField']);

$router->dispatch($_SERVER['QUERY_STRING']);
?>