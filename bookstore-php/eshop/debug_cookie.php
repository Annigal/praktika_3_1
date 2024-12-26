<?php
if (isset($_COOKIE['basket'])) {
    echo "Содержимое куки basket: " . $_COOKIE['basket'] . "<br>";
    $decoded = json_decode($_COOKIE['basket'], true);
    echo "Декодированное содержимое: ";
    print_r($decoded);
} else {
    echo "Куки basket отсутствует.<br>";
}
?>
