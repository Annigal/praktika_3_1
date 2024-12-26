<?php
if (!class_exists('Eshop')) {
    class Eshop {
        private static $db;

        public static function init($dbConfig) {
            self::$db = new PDO(
                "mysql:host={$dbConfig['HOST']};dbname={$dbConfig['NAME']}",
                $dbConfig['USER'],
                $dbConfig['PASS']
            );
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public static function createHash(string $password): string {
            return password_hash($password, PASSWORD_DEFAULT);
        }

    public static function addItemToCatalog(Book $book) {
        try {
            $stmt = self::$db->prepare("CALL spAddItemToCatalog(:title, :author, :price, :pubyear)");
            $stmt->bindParam(':title', $book->title, PDO::PARAM_STR);
            $stmt->bindParam(':author', $book->author, PDO::PARAM_STR);
            $stmt->bindParam(':price', $book->price, PDO::PARAM_INT);
            $stmt->bindParam(':pubyear', $book->pubyear, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Ошибка добавления товара: " . $e->getMessage());
            return false;
        }
    }

    public static function getItemsFromCatalog(): Iterator {
        $stmt = self::$db->query("SELECT * FROM catalog");
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Book');
        return new IteratorIterator($stmt);
    }

    public static function addItemToBasket($id) {
        Basket::add($id);
    }

    public static function saveOrder(Order $order) {
        try {
            $stmt = self::$db->prepare("INSERT INTO orders (order_id, customer, email, phone, address) VALUES (:order_id, :customer, :email, :phone, :address)");
            $orderId = uniqid();
            $stmt->execute([
                ':order_id' => $orderId,
                ':customer' => $order->customer,
                ':email' => $order->email,
                ':phone' => $order->phone,
                ':address' => $order->address
            ]);
    
            foreach ($order->items as $itemId => $quantity) {
                $stmt = self::$db->prepare("INSERT INTO ordered_items (order_id, item_id, quantity) VALUES (:order_id, :item_id, :quantity)");
                $stmt->execute([
                    ':order_id' => $orderId,
                    ':item_id' => $itemId,
                    ':quantity' => $quantity
                ]);
            }
    
            Basket::clear();
    
            return true;
        } catch (PDOException $e) {
            error_log("Ошибка в методе saveOrder: " . $e->getMessage());
            return false;
        }
    }
    

        public static function getOrders(): array {
            try {
                $stmt = self::$db->query("SELECT order_id AS id, customer, email, phone, address, datetime FROM orders");
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                error_log("Ошибка при получении покупок: " . $e->getMessage());
                return [];
            }
        }

        public static function userCheck(string $username, string $password): bool {
            $stmt = self::$db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($password, $user['password'])) {
                return true;
            }
        
            return false;
        }
        
        public static function userAdd(User $user) {
            try {
                $stmt = self::$db->prepare("INSERT INTO users (username, password, email, is_admin) VALUES (:username, :password, :email, :is_admin)");
                echo "Подготовка SQL запроса прошла успешно.<br>";
        
                $stmt->execute([
                    ':username' => $user->username,
                    ':password' => $user->passwordHash,
                    ':email' => $user->email,
                    ':is_admin' => $user->isAdmin,
                ]);
                echo "Запрос INSERT выполнен успешно.<br>";
            } catch (PDOException $e) {
                echo "Ошибка в userAdd: " . $e->getMessage() . "<br>";
            }
        }
        
        

        public static function userGet(string $username): ?User {
            $stmt = self::$db->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data) {
                return new User($data['username'], $data['password'], $data['email'], $data['is_admin']);
            }
            return null;
        }

        public static function logIn(User $user) {
            $_SESSION['admin'] = $user->username;
        }

        public static function logOut() {
            unset($_SESSION['admin']);
        }

        public static function isAdmin(): bool {
            return isset($_SESSION['admin']);
        }
    }
}

?>