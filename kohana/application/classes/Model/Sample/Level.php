<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Sample Level model class
 *
 * @package     Application
 * @category    Model
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Model_Sample_Level extends ORM {

    /**
     * @var     array       Auto-update columns for creation
     */
    protected $_created_column = array(
            'column' => 'sampled_at',
            'format' => 'U',
        );

    /**
     * A Sample Level belongs to a Sample
     *
     * @var     array       Belongs to relationships
     */
    protected $_belongs_to = array(
            'sample' => array(),
        );

    /**
     * Obtain a data set suitable for use in Flot charting library
     *
     * @param   string      X-axis column name
     * @param   string      Y-axis column name
     * @param   callback    Callback to format x-axis value
     * @param   callback    Callback to format y-axis value
     * @return  array
     */
    public function get_chart_set($x_column, $y_column, $x_callback = NULL, $y_callback = NULL, $channel = NULL)
    {
        $result = $this->reset(FALSE)->find_all();

        $points = array();

        foreach ($result as $index => $level)
        {
            if ($channel !== NULL AND $level->channel != $channel)
            {
                continue;
            }

            $x_value = ($x_column === NULL) ? $index : $level->$x_column;
            $y_value = ($y_column === NULL) ? $index : $level->$y_column;

            if ($x_callback !== NULL)
            {
                $x_value = call_user_func($x_callback, $x_value, $level);
            }

            if ($y_callback !== NULL)
            {
                $y_value = call_user_func($y_callback, $y_value, $level);
            }

            $points[] = array($x_value, $y_value);
        }

        return $points;
    }

    public function get_level_range($min_sample_id, $max_sample_id)
    {
        $db = Database::instance();

        $result = DB::select(
                array(DB::expr('MIN(' . $db->quote_column($this->primary_key()) . ')'), 'min_sample_id'),
                array(DB::expr('MAX(' . $db->quote_column($this->primary_key()) . ')'), 'max_sample_id')
            )
            ->from($this->table_name())
            ->where('sample_id', 'IN', array($min_sample_id, $max_sample_id))
            ->execute($this->_db)
            ->as_array();

        if (is_array($result) AND isset($result[0]))
        {
            return $result[0];
        }

        return FALSE;
    }
}

