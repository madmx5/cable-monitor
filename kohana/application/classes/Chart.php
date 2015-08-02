<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Chart helper object
 *
 * @package     Application
 * @category    Helper
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Chart {

    /**
     * Converts a scalar value to a double
     *
     * @param   mixed       Scalar value to convert
     * @param   object      Object being formatted
     * @return  double
     */
    public static function doubleval($double, ORM $object = NULL)
    {
        return doubleval($double);
    }

    /**
     * Converts a scalar value to an integer
     *
     * @param   mixed       Scalar value to convert
     * @param   object      Object being formatted
     * @return  integer
     */
    public static function intval($integer, ORM $object = NULL)
    {
        return intval($integer);
    }

    /**
     * Converts a scalar value to a deci-double (double / 10.0)
     *
     * @param   mixed       Scalar value to convert
     * @param   object      Object being formatted
     * @return  double
     */
    public static function deci_doubleval($double, ORM $object = NULL)
    {
        return doubleval($double) / 10.0;
    }

    /**
     * Converts a decimal to a percentage
     *
     * @param   double      Percentage as decimal number
     * @param   object      Object being formatted
     * @return  double
     */
    public static function percent($decimal, ORM $object = NULL)
    {
        return (double) $decimal * 100.0;
    }

    /**
     * Convert a date string to a UNIX timestamp Flot can understand
     *
     * @param   string      Date and time string
     * @param   object      Object being formatted
     * @return  integer
     */
    public static function strtotime($timestamp, ORM $object = NULL)
    {
        return strtotime($timestamp) * 1000;
    }

    /**
     * Convert a UNIX timestamp to one Flot can understand
     *
     * @param   integer     Timestamp
     * @param   object      Object being formatted
     * @return  integer
     */
    public static function unix_time($timestamp, ORM $object = NULL)
    {
        return (int) $timestamp * 1000;
    }

    /**
     * Obtain chart options based on chart name, merging with defaults
     *
     * @param   string      Chart name
     * @return  array
     */
    public static function options($name)
    {
        $options = Kohana::$config->load('flot/options.' . $name) ? : array();

        return $options;
    }

    /**
     * Build a chart data set based on name and ORM search object
     *
     * @param   string      Chart name
     * @param   object      ORM object to build
     * @return  array
     */
    public static function build($name, ORM $object)
    {
        $config = Kohana::$config->load('flot/charts.' . $name);

        if ( ! isset($config['chart']))
        {
            return $config;
        }

        foreach ($config['chart'] as $name => $data)
        {
            $config['chart'][$name] = Chart::_build_chart($data, $object);
        }

        return $config;
    }

    /**
     * Query and construct the chart configuration array for a single chart
     *
     * @param   array       Chart options
     * @param   object      ORM object to build
     * @return  array
     */
    protected static function _build_chart($config, ORM $object)
    {
        $dataset = Arr::get($config, 'dataset', array());
        $options = Arr::get($config, 'options', NULL);

        if (isset($config['where']))
        {
            $object = clone($object);

            foreach ($config['where'] as $where)
            {
                call_user_func_array(array($object, 'where'), $where);
            }
        }

        $results = array();

        foreach ($dataset as $key => $set)
        {
            $results[$key] = call_user_func_array(array($object, 'get_chart_set'), $set);
        }

        $config['dataset'] = $results;

        if (is_string($options))
        {
            $config['options'] = Chart::options($options);
        }

        return $config;
    }
}

