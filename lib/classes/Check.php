<?php

namespace lib\classes;

class Check
{
    /**
     * Check string on regular
     * @param $title
     * @param string $name_get_param
     * @return string
     */
    public function isString($title, $name_get_param = 'parameter')
    {
        $title = trim($title);

        $preg = "/[a-zA-Zа-яА-ЯёЁ0-9\s\-]{1,190}+/ui";

        preg_match_all($preg, $title, $out);

        if ($out[0][0] == $title):
            return $title;
        else:
            echo json_encode(
                [
                    'error' => 'String ' . $name_get_param . ' is not a format.'
                ]
            );
            die();
        endif;
    }

    /**
     * Check param where param should b integer
     *
     * @param $string
     * @param string $name_get_param
     * @return string
     */
    public function isNum($string, $name_get_param = 'parameter')
    {
        $string = trim($string);

        $preg = "/[0-9]{1,190}+/ui";

        preg_match_all($preg, $string, $out);

        if ($out[0][0] == $string):
            return $string;
        else:
            echo json_encode(
                [
                    'error' => 'Number ' . $name_get_param . ' is not a format.'
                ]
            );
            die();
        endif;
    }

    /**
     * @param $get
     * @param $name
     * @return mixed
     */
    public function required($get, $name)
    {
        if (is_array($get)) {
            foreach ($get as $item) {
                if (empty($item)) {
                    $arHelp[] = 'yes';
                } else {
                    $arHelp[] = 'not';
                    $result = $item;
                }
            }
            in_array('not', $arHelp) ? '' : die($name . ' is required.');
            in_array('yes', $arHelp) ? '' : die('Use only ' . $name);

            return $result;
        }

        return empty($get) ?
            die($name . ' is required.') :
            $get;
    }

}