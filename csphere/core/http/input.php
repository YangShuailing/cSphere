<?php

/**
 * Provides the possibility to work with input types
 *
 * PHP Version 5
 *
 * @category  Core
 * @package   HTTP
 * @author    Hans-Joachim Piepereit <contact@csphere.eu>
 * @copyright 2013 cSphere Team
 * @license   http://opensource.org/licenses/bsd-license Simplified BSD License
 * @link      http://www.csphere.eu
 **/

namespace csphere\core\http;

/**
 * Provides the possibility to work with input types
 *
 * @category  Core
 * @package   HTTP
 * @author    Hans-Joachim Piepereit <contact@csphere.eu>
 * @copyright 2013 cSphere Team
 * @license   http://opensource.org/licenses/bsd-license Simplified BSD License
 * @link      http://www.csphere.eu
 **/

abstract class Input
{
    /**
     * Array with aliased input names
     **/
    private static $_inputNames = array(
        'get' => INPUT_GET,
        'post' => INPUT_POST,
        'cookie' => INPUT_COOKIE,
        'server' => INPUT_SERVER,
        'env' => INPUT_ENV
    );

    /**
     * Array with registered GET data
     **/
    private static $_inputGet = array();

    /**
     * Prepares the input data for usage
     *
     * @return boolean
     **/

    public static function prepare()
    {
        if (self::$_inputGet == array()) {

            // Get http-request data to merge it with GET var
            $request = \csphere\core\http\Request::get();

            self::$_inputGet = array_merge($_GET, $request['data']);

            // Remove REQUEST vars (be carefull with jit options)
            unset($_REQUEST);
        }

        return true;
    }

    /**
     * Gets the value for a key of an input type
     *
     * @param string $type Input type, e.g. for $_GET use 'get' without the quotes
     * @param string $key  The array key to fetch the value from
     *
     * @return mixed
     **/

    public static function get($type, $key)
    {
        $data = '';

        // Special case 'get' should use its own filter
        if (isset(self::$_inputNames[$type]) AND $type == 'get') {

            if (isset(self::$_inputGet[$key])) {

                $data = filter_var(self::$_inputGet[$key]);
                $data = rawurldecode($data);
            }

        } elseif (isset(self::$_inputNames[$type])) {

            if (filter_has_var(self::$_inputNames[$type], $key)) {

                $data = filter_input(self::$_inputNames[$type], $key);
            }
        }

        return $data;
    }

    /**
     * Gets an input type as an array
     *
     * @param string $type Input type, e.g. for $_GET use 'get' without the quotes
     *
     * @return array
     **/

    public static function getAll($type)
    {
        $data = array();

        // Special case 'get' should use its own filter
        if (isset(self::$_inputNames[$type]) AND $type == 'get') {

            $data = filter_var_array(self::$_inputGet);

        } elseif (isset(self::$_inputNames[$type])) {

            $data = filter_input_array(self::$_inputNames[$type]);
        }

        return $data;
    }
}