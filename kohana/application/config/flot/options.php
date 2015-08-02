<?php defined('SYSPATH') or die('No direct script access.');

return array
(
    'time_vs_decimal' => array(
        'xaxis' => array(
            'minTickSize' => array(20, 'minute'),
            'mode' => 'time',
            'timezone' => 'browser',
            'twelveHourClock' => true,
        ),
    ),

    'time_vs_integer' => array(
        'xaxis' => array(
            'minTickSize' => array(20, 'minute'),
            'mode' => 'time',
            'timezone' => 'browser',
            'twelveHourClock' => true,
        ),

        'yaxis' => array(
            'tickDecimals' => 0,
        ),
    ),

    'time_vs_updown' => array(
        'xaxis' => array(
            'minTickSize' => array(20, 'minute'),
            'mode' => 'time',
            'timezone' => 'browser',
            'twelveHourClock' => true,
        ),

        'yaxis' => array(
            'ticks' => array(
                array(0, ''),
                array(1, 'up'),
                array(2, ''),
            ),
        ),

        'lines' => array(
            'steps' => true,
        ),
    ),

    'time_vs_logdecimal' => '{
  "xaxis": {
    "minTickSize": [20, "minute"],
    "mode": "time",
    "timezone": "browser",
    "twelveHourClock": true
  },
  "yaxis": {
    "transform": flotYTransform,
    "inverseTransform": flotYInverseTransform
  }
}',

);

