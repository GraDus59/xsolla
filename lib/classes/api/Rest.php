<?php


namespace lib\classes\api;

use lib\classes\Database\DB;
use lib\classes\SkuController;

class Rest
{
    private DB $DB;
    private SkuController $sku;

    /**
     * Rest constructor.
     */
    public function __construct()
    {
        $this->DB = new DB();
        $this->sku = new SkuController();
    }

    /**
     * Method for auth and get token
     * DEMO version
     * @param $login
     * @param $password
     */
    public function auth($login, $password)
    {
        $result = $this->DB->auth($login, $password);

        $result = json_encode($result);

        $result = ($result == 'null' ? 'Error on enter data!' : $result);

        echo $result;
    }


    /**
     * Add new row
     *
     * @param $title
     * @param $description
     * @param $type
     * @param $price
     */
    public function create($title, $description, $type, $price)
    {
        $sku = $this->sku->newSKU(['title' => $title, 'type' => $type]);

        $result = $this->DB->create($title, $description, $type, $price, $sku);

        $result = empty($result) ?
            json_encode(['error' => 'bad request']) :
            json_encode(['success' => 'ok', 'id' => $result]);

        echo $result;
    }

    /**
     * Delete product
     * @param array|null[] $array
     */
    public function delete(array $array = ["ID" => null, "SKU" => null])
    {
        if (!empty($array['SKU'])):
            $id = $this->DB->get($array['SKU'], 'sku')['id'];
        else:
            $id = $this->DB->get($array['ID'])['id'];
        endif;

        if (empty($id)) {
            $result = json_encode(['error' => 'Sorry but we cun not do this, because ID or SKU do not exist.']);
        } else {
            $result = json_encode(['success' => 'ok']);
            $this->DB->delete($id);
        }

        echo $result;
    }

    /**
     * Get one row by SKU
     * SKU->ID->Find
     *
     * @param $id
     */
    public function info($sku)
    {
        $result = array();

        $res = $this->DB->get($sku, 'sku');

        if (empty($res)) {
            $result = ['error' => 'Sorry but we cun not do this, because SKU do not exist.'];
        } else {
            $result[] = ['success' => 'ok'];
            $result[] = $res;
        }

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function read($pagination = null)
    {
        $result = array();

        if (!empty($pagination)) {
            $first = $pagination - 1;
            $last = $pagination * 10;
            $page = [(int)$first, $last];
        }

        $res = $this->DB->getAll($page);

        if (empty($res)) {
            $result = ['error' => 'Result is empty!'];
        } else {
            $result[] = ['success' => 'ok', 'count' => count($res)];
            $result[] = $res;
        }

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function update($where_find, $id, $title, $description, $type, $price)
    {
        $res = $this->DB->get($id, $where_find);

        $new_id = $res['id'];

        $sku = $this->sku->newSKU(['title' => $title, 'type' => $type]);

        if (empty($res)) {
            $result = ['error' => 'Sorry but we cun not do this, because SKU do not exist.'];
        } else {
            $result[] = ['success' => 'ok'];
            $result[] = [
                'new data' => [
                    'id' => $new_id,
                    'title' => $title,
                    'description' => $description,
                    'type' => $type,
                    'price' => $price,
                    'sku' => $sku
                ]
            ];
        }

        $this->DB->update($new_id, $title, $description, $type, $price, $sku);

        echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}