<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

const CORE_DIR = __DIR__ . '/../core/';
const APP_DIR = __DIR__ . '/../app/';
const ADMIN_DIR = APP_DIR . 'admin/';

spl_autoload_register(function ($class) {
    $file = CORE_DIR . $class . '.class.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

const ERROR_LOG = __DIR__ . '/../app/admin/error.log';
const ERROR_MSG = 'Ошибка. Обратитесь к админу.';

function log_error($msg, $file, $line) {
    $dt = date('d-m-Y H:i:s');
    $message = "$dt - $msg in $file:$line\n";
    error_log($message, 3, ERROR_LOG);

    global $error_displayed;
    if (empty($error_displayed)) {
        echo ERROR_MSG;
        $error_displayed = true;
    }
}

function error_handler($no, $msg, $file, $line) {
    log_error($msg, $file, $line);
}
function exception_handler($e) {
    log_error($e->getMessage(), $e->getFile(), $e->getLine());
}

set_error_handler('error_handler');
set_exception_handler('exception_handler');

const DB = [
    'HOST' => '127.0.0.1',
    'USER' => 'root',
    'PASS' => '',
    'NAME' => 'eshop',
];

if (!class_exists('Eshop')) {
    require_once CORE_DIR . 'Eshop.class.php';
}
Eshop::init(DB);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once CORE_DIR . 'Basket.class.php';
Basket::init();
?>
