<?php

$path = parse_url($_SERVER['REQUEST_URI'])['path'];

$basePath = '/bookstore-php/eshop';

$path = str_replace($basePath, '', $path);

switch (rtrim($path, '/')):
    case '':
    case '/index.php':
        header('Location: /bookstore-php/eshop/catalog');
        break;

	case '/catalog':
		require_once __DIR__ . '/../app/catalog.php';
		break;

    case '/basket':
        require_once 'basket.php';
        break;

    case '/admin':
        require_once 'admin.php';
        break;

    case '/admin/add_item_to_catalog':
        require_once __DIR__ . '/../app/admin/add_item_to_catalog.php';
        break;

	case '/admin/save_item_to_catalog':
		require_once __DIR__ . '/../app/admin/save_item_to_catalog.php';
		break;
	case '/add_item_to_basket':
		require_once __DIR__ . '/../app/add_item_to_basket.php';
		break;
	case '/remove_item_from_basket':
		require_once __DIR__ . '/../app/remove_item_from_basket.php';
		break;
		

    case '/create_order':
        require_once __DIR__ . '/../app/create_order.php';
        break;

    case '/save_order':
        require_once __DIR__ . '/../app/save_order.php';
        break;

    case '/admin/orders':
        require_once 'orders.php';
        break;

    case '/admin/create_user':
        require_once __DIR__ . '/../app/admin/create_user.php';
        break;

    case '/admin/save_user':
        require_once __DIR__ . '/../app/admin/save_user.php';
        break;

    case '/admin/logout':
        require_once __DIR__ . '/../app/admin/logout.php';
        break;

    case '/admin/login':
        require_once __DIR__ . '/../app/admin/login.php';
        break;
    
    default:
        echo "Маршрут не найден! Путь: $path <br>";
        require_once '404.php';
endswitch;
?>
