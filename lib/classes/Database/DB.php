<?php

namespace lib\classes\Database;

class DB
{
    // DB settings
    private const DB_USER = 'prbasqrn4_api';
    private const DB_PASSWORD = 'Bz*V0qG3';
    private const DB_NAME = 'prbasqrn4_api';
    private const DB_HOST = 'localhost';
    // DB settings

    /**
     * Private function
     * Get connect to MYSQL
     * PHP PDO
     * @return \PDO
     */
    private function connect()
    {
        try {
            return new \PDO(
                'mysql:dbname=' . self::DB_NAME . ';
                host=' . self::DB_HOST,
                self::DB_USER,
                self::DB_PASSWORD
            );
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * Demo auth method
     *
     * @param $login
     * @param $password
     * @return array
     */
    public function auth($login, $password)
    {
        $db = $this->connect();

        $sth = $db->prepare("SELECT `password` FROM `auth` WHERE `login` = ?");
        $sth->execute(array($login));
        $row = $sth->fetch(\PDO::FETCH_COLUMN);

        if ($row == $password) {
            $result = array(
                "token" => md5(time() . 'token' . $password),
                "login" => $login,
                "info" => "Token is demo version, not use."
            );
        }

        return $result;
    }

    /**
     *
     * Add new row in table
     * Default table - products
     * @param $title
     * @param $description
     * @param $type
     * @param $price
     * @return string
     */
    public function create(
        $title,
        $description,
        $type,
        $price,
        $sku
    ) {
        $db = $this->connect();

        $create =
            $db->prepare("
                INSERT 
                INTO `products` 
                SET 
                `title` = :title,
                `description` = :description,
                `type` = :type,
                `sku` = :sku,
                `price` = :price,
                `created_at` = :created_at
            ");

        $create->execute(
            array(
                'title' => $title,
                'description' => $description,
                'type' => $type,
                'sku' => $sku,
                'price' => $price,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        // Получаем id вставленной записи
        $insert_id = $db->lastInsertId();

        return $insert_id;
    }

    /**
     * Delete Row by ID
     *
     * @param $id
     */
    public function delete($id)
    {
        $db = $this->connect();

        $db->exec("DELETE FROM `products` WHERE `id` = $id");

    }

    /**
     * Get Row by default ID
     * mb set any param for delete
     *
     * @param $id
     * @param string $where
     * @return mixed
     */
    public function get($id, $where = 'id')
    {
        $db = $this->connect();

        $sth = $db->prepare("SELECT * FROM `products` WHERE `{$where}` = ?");
        $sth->execute(array($id));

        $result = $sth->fetch(\PDO::FETCH_ASSOC);

        return $result;

    }

    /**
     * Get all rows
     * method have pagination
     *
     * @param array $limit
     * @return array
     */
    public function getAll($limit = [])
    {
        $db = $this->connect();

        $limitString = '';

        if (count($limit) > 0) {
            $limitString = " LIMIT {$limit[0]} , {$limit[1]}";
        }

        $sql = "SELECT * FROM `products` ORDER BY `id`" . $limitString;

        $sth = $db->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * Update row
     *
     * @param $id
     * @param $title
     * @param $description
     * @param $type
     * @param $price
     * @param $sku
     */
    public function update($id, $title, $description, $type, $price, $sku)
    {
        $db = $this->connect();

        $sth = $db->prepare("
            UPDATE `products` 
            SET 
                `title` = :title,
                `description` = :description,
                `type` = :type,
                `sku` = :sku,
                `price` = :price,
                `updated_at` = :updated_at
            WHERE `id` = :id
        ");
        $sth->execute(array(
            'title' => $title,
            'description' => $description,
            'type' => $type,
            'sku' => $sku,
            'price' => $price,
            'updated_at' => date('Y-m-d H:i:s'),
            'id' => $id
        ));
    }
}