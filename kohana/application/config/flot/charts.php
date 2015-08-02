<?php defined('SYSPATH') or die('No direct script access.');

return array
(
    'samples' => array
        (
            'title' => 'Connection Overview',
            'class' => 'icon-hdd',
            'chart' => array
                (
                    'packet_loss' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'packet_loss', array('Chart', 'strtotime'), array('Chart', 'percent') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),

                    'latency' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'latency', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),

                    'connected' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'connected', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'modem_status' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'modem_status', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_ds_scan' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_ds_scan', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_ranging' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_ranging', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_dhcp' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_dhcp', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_tftp' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_tftp', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_data_reg' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_data_reg', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),

                    'docsis_privacy' => array
                        (
                            'dataset' => array
                                (
                                    array( 'created_at', 'docsis_privacy', array('Chart', 'strtotime') ),
                                ),

                            'options' => 'time_vs_updown',
                        ),
                ),
        ),

    'levels' => array
        (
            'title' => 'Up / Down Streams',
            'class' => 'icon-download-alt',
            'chart' => array
                (
                    'downstream_channel_1' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 1 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_2' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 2 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_3' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 3 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_4' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 4 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_5' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 5 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_6' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 6 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_7' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 7 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'downstream_channel_8' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'channel', '=', 8 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                    array( 'sampled_at', 'ratio', array('Chart', 'unix_time'), array('Chart', 'deci_doubleval') ),
                                ),

                            'options' => 'time_vs_logdecimal',
                        ),

                    'upstream_channel_1' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'u' ),
                                    array( 'channel', '=', 1 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),

                    'upstream_channel_2' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'u' ),
                                    array( 'channel', '=', 2 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),

                    'upstream_channel_3' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'u' ),
                                    array( 'channel', '=', 3 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),

                    'upstream_channel_4' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'u' ),
                                    array( 'channel', '=', 4 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'level', array('Chart', 'unix_time'), array('Chart', 'doubleval') ),
                                ),

                            'options' => 'time_vs_decimal',
                        ),
                ),
        ),

    'frequencies' => array
        (
            'title' => 'Channel Frequencies',
            'class' => 'icon-signal',
            'chart' => array
                (
                    'downstream_frequencies' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'd' ),
                                    array( 'frequency', '>', 0 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 1 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 2 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 3 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 4 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 5 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 6 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 7 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 8 ),
                                ),

                            'options' => 'time_vs_integer',
                        ),

                    'upstream_frequencies' => array
                        (
                            'where' => array
                                (
                                    array( 'stream', '=', 'u' ),
                                    array( 'frequency', '>', 0 ),
                                ),

                            'dataset' => array
                                (
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 1 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 2 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 3 ),
                                    array( 'sampled_at', 'frequency', array('Chart', 'unix_time'), array('Chart', 'intval'), 4 ),
                                ),

                            'options' => 'time_vs_integer',
                        ),
                ),
        ),
);

