<?php

namespace lib\classes;

use lib\classes\Database\DB;

class SkuController
{
    /**
     * Create new sku
     *
     * @param array $data
     * @return string
     */
    public function newSKU(array $data)
    {
        $title = $data['title'];

        $arTitle = explode(' ', $title);

        $sku_title = '';

        foreach ($arTitle as $value) {
            $countUpp = mb_strlen(preg_replace('/[^A-ZА-ЯЁ]/u', '', $value), 'UTF-8');

            if ($countUpp == 0) {
                $value = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');
            }

            $sku_title .= preg_replace('/[^0-9A-ZА-ЯЁ]/u', '', $value);
        }

        $type = $data['type'];

        $sku_first = $this->getFirstByType($type);

        $sku_type = $type;

        $SKU = $sku_first . '-' . $sku_title . '-' . $sku_type;

        return $SKU;
    }

    /**
     * Test method
     * Use this, where u have not sku table for create clever sku
     * For demo/test i not use this table and use this method
     *
     * @param $type
     * @return string
     */
    private function getFirstByType($type)
    {
        switch ($type):
            case 1:
                $random_name = ['ST', 'RTS', 'SH'];
                return $random_name[rand(0, count($random_name) - 1)];
            case 2:
                $random_name = ['RS', 'TTT', 'SH'];
                $random_size = [48, 50, 52, 54, 56];
                return $random_name[rand(0, count($random_name) - 1)] . '-' . $random_size[rand(0,
                        count($random_size) - 1)];
            case 3:
                return 'VRT';
        endswitch;
    }

}