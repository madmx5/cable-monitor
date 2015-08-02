<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Sample model class
 *
 * @package     Application
 * @category    Model
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Model_Sample extends ORM {

    /**
     * @var     array       Auto-update columns for creation
     */
    protected $_created_column = array(
            'column' => 'created_at',
            'format' => 'Y-m-d H:i:s',
        );

    /**
     * A Sample has many Levels
     *
     * @var     array       Has many relationships
     */
    protected $_has_many = array(
            'levels' => array(
                'model' => 'Sample_Level',
            ),
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
    public function get_chart_set($x_column, $y_column, $x_callback = NULL, $y_callback = NULL)
    {
        $result = $this->reset(FALSE)->find_all();

        $points = array();

        foreach ($result as $index => $sample)
        {
            $x_value = ($x_column === NULL) ? $index : $sample->$x_column;
            $y_value = ($y_column === NULL) ? $index : $sample->$y_column;

            if ($x_callback !== NULL)
            {
                $x_value = call_user_func($x_callback, $x_value, $sample);
            }

            if ($y_callback !== NULL)
            {
                $y_value = call_user_func($y_callback, $y_value, $sample);
            }

            $points[] = array($x_value, $y_value);
        }

        return $points;
    }

    /**
     * Find an array of outages in a given sample set
     *
     * @param   integer     Maximum number of seconds between consecutive samples required to group
     * @param   integer     Minimum number of samples to be labeled as an outage
     * @return  array
     */
    public function find_outages($max_elapsed_time, $min_sample_size)
    {
        $samples = $this->find_all();

        $start = NULL;
        $range = NULL;
        $count = 0;

        $tally = array();

        foreach ($samples as $index => $sample)
        {
            if ($start === NULL)
            {
                $start = $range = strtotime($sample->created_at);
                $count = 1;
            }
            else
            {
                $elaps = strtotime($sample->created_at) - $range;

                if ($elaps < $max_elapsed_time)
                {
                    $range = strtotime($sample->created_at);

                    $count += 1;
                }
                else
                {
                    if ($count >= $min_sample_size)
                    {
                        $tally[] = array($start, $range);
                    }

                    $start = $range = strtotime($sample->created_at);
                    $count = 1;
                }
            }
        }

        if ($start !== NULL AND $range != NULL AND $count >= $min_sample_size)
        {
            $tally[] = array($start, $range);
        }

        return $tally;
    }
}

