<?php defined('SYSPATH') or die('No direct script access.');

use Symfony\Component\DomCrawler\Crawler;

/**
 * Sample cable model status task
 *
 * @package     Application
 * @category    Task
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Task_Sample extends Minion_Task {

    /**
     * @const   string      Url of the cable model login page
     */
    const LOGIN_PAGE_URL = 'http://192.168.1.1/goform/home_loggedout';

    /**
     * @const   string      Url of the cable model status page
     */
    const STATUS_PAGE_URL = 'http://192.168.1.1/vendor_network.asp';

    /**
     * @const   string      Hostname to collect ICMP ping sample from
     */
    const PING_SAMPLE_HOST = '8.8.8.8';

    /**
     * @var     array       Request client params
     */
    protected static $_request_client_params = array(
            'options' => array(
                    CURLOPT_CONNECTTIMEOUT => 5,
                    CURLOPT_TIMEOUT => 30,
                ),
            );

    /**
     * @var     array       Sample property map
     */
    protected static $_sample_properties = array(
            'modem_status'    => array(
                    'filter'  => '//*[@id="content"]/div[2]/div[1]/span[2]',
                    'search'  => 'active',
                ),

            'docsis_hardware'  => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[1]/span[2]',
                    'search'  => 'complete',
                ),

            'docsis_ds_scan'  => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[2]/span[2]',
                    'search'  => 'complete',
                ),

            'docsis_ranging'  => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[3]/span[2]',
                    'search'  => 'complete',
                ),

            'docsis_dhcp'     => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[4]/span[2]',
                    'search'  => 'complete',
                ),

            'docsis_tftp'     => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[6]/span[2]',
                    'search'  => 'complete',
                ),

            'docsis_data_reg' => array(
                    'filter'  => '//*[@id="content"]/div[3]/div[7]/span[2]',
                    'search'  => 'complete',
                ),
        );

    /**
     * @var     array       Sample Level property map
     */
    protected static $_level_properties = array(
            'd' => array(
                '1' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[1]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[1]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[1]',
                ),

                '2' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[2]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[2]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[2]',
                ),

                '3' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[3]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[3]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[3]',
                ),

                '4' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[4]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[4]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[4]',
                ),

                '5' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[5]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[5]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[5]',
                ),

                '6' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[6]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[6]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[6]',
                ),

                '7' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[7]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[7]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[7]',
                ),

                '8' => array(
                    'frequency_filter' => '//*[@id="content"]/div[5]/table/tr[3]/td[8]',
                    'level_filter'     => '//*[@id="content"]/div[5]/table/tr[5]/td[8]',
                    'ratio_filter'     => '//*[@id="content"]/div[5]/table/tr[4]/td[8]',
                ),
            ),

            'u' => array(
                '1' => array(
                    'frequency_filter' => '//*[@id="content"]/div[6]/table/tr[3]/td[1]',
                    'level_filter'     => '//*[@id="content"]/div[6]/table/tr[5]/td[1]',
                ),

                '2' => array(
                    'frequency_filter' => '//*[@id="content"]/div[6]/table/tr[3]/td[2]',
                    'level_filter'     => '//*[@id="content"]/div[6]/table/tr[5]/td[2]',
                ),

                '3' => array(
                    'frequency_filter' => '//*[@id="content"]/div[6]/table/tr[3]/td[3]',
                    'level_filter'     => '//*[@id="content"]/div[6]/table/tr[5]/td[3]',
                ),

                '4' => array(
                    'frequency_filter' => '//*[@id="content"]/div[6]/table/tr[3]/td[4]',
                    'level_filter'     => '//*[@id="content"]/div[6]/table/tr[5]/td[4]',
                ),
            ),
        );

    /**
     * Execute the sample task with the specified options
     *
     * @param   array       Parameters
     * @return  void
     */
    protected function _execute(array $params)
    {
        // Begin by fetching a ping sample
        $ping = $this->get_ping_sample(self::PING_SAMPLE_HOST);

        $request = Request::factory(self::LOGIN_PAGE_URL, self::$_request_client_params)
            ->method(Request::POST)
            ->post(array(
                'loginUsername' => 'admin',
                'loginPassword' => 'sh33py0u2',
            ));

        try
        {
            $login = $request->execute();
        }
        catch (Exception $e)
        {
            Kohana::$log->add(Log::ERROR, "Could not obtain model login page: :message", array(
                    ':message' => $e->getMessage()) );

            Kohana::$log->write();

            return;
        }

        // Next fetch the status page content
        $request = Request::factory(self::STATUS_PAGE_URL, self::$_request_client_params);

        try
        {
            $status = $request->execute();
        }
        catch (Exception $e)
        {
            $status = NULL;

            Kohana::$log->add(Log::ERROR, "Could not obtain sample status: :message", array(
                    ':message' => $e->getMessage()) );

            Kohana::$log->write();
        }

        // Create a new DomCrawler with the response
        $crawler = new Crawler($status->body());

        // Create a new status sample object
        $sample = Model::factory('Sample');

        // Save the ping sample statistics if present
        if (is_array($ping))
        {
            $sample->packet_loss = Arr::get($ping, 'packet_loss', NULL);
            $sample->latency = Arr::get(Arr::get($ping, 'rtt', array()), 'avg', NULL);

            $packets_received = Arr::get($ping, 'packets_received', NULL);
            $sample->connected = ($packets_received > 0);
        }

        foreach (self::$_sample_properties as $property => $config)
        {
            $dom_node = $crawler->filterXPath($config['filter']);

            if ( ! ($dom_node instanceof Crawler) OR ! $dom_node->count())
            {
                continue;
            }

            $value = stripos($dom_node->text(), $config['search']) !== FALSE ? 1 : 0;

            $sample->$property = $value;
        }

        // Save the sample object
        $sample->save();

        foreach (self::$_level_properties as $stream => $channels)
        {
            foreach ($channels as $channel => $config)
            {
                $level = Model::factory('Sample_Level');

                foreach ($config as $key => $filter)
                {
                    if ( ! preg_match('/^(.+)_filter$/', $key, $matches))
                    {
                        continue;
                    }

                    $property = $matches[1];

                    $dom_node = $crawler->filterXPath($filter);

                    if ($dom_node instanceof Crawler AND $dom_node->count() > 0)
                    {
                        $level->$property = preg_replace('/^\s*([0-9\.]+)\s+.*$/', '\1', $dom_node->text());
                    }
                }

                $level->sample  = $sample;
                $level->stream  = $stream;
                $level->channel = $channel;

                // Save the sample level object
                $level->save();
            }
        }

        Minion_CLI::write("Sampled modem status and " . $sample->levels->count_all() . " power levels.");
    }

    /**
     * Retreive an ICMP ECHO (ping) sample
     *
     *     array(
     *       'packets_transmitted' => 10,
     *       'packets_received' => 7,
     *       'packet_loss' => 0.3,
     *       'rtt' => array('
     *          'min' => 0.23,
     *          'avg' => 0.24,
     *          'max' => 0.32,
     *          'mdev' => 0.26,
     *        ),
     *     );
     *
     * @param   string      Hostname to sample
     * @return  array
     */
    protected function get_ping_sample($hostname)
    {
        $command = sprintf('/bin/ping -w 10 %s', escapeshellarg($hostname));

        $outputs = array();
        $results = array();

        exec($command, $outputs);

        /** 10 packets transmitted, 0 received, 100% packet loss, time 9000ms **/
        /** 11 packets transmitted, 11 received, 0% packet loss, time 9998ms
         ** rtt min/avg/max/mdev = 0.292/0.342/0.556/0.073 ms **/

        foreach ($outputs as $output)
        {
            if (preg_match('/(\d+)\s+packets\s+transmitted/', $output, $matches))
            {
                $results['packets_transmitted'] = (int) $matches[1];
            }

            if (preg_match('/(\d+)\s+received/', $output, $matches))
            {
                $results['packets_received'] = (int) $matches[1];
            }

            if (preg_match('/(\d+)%\s+packet\s+loss/', $output, $matches))
            {
                $results['packet_loss'] = (int) $matches[1] / 100.0;
            }

            if (preg_match('@rtt\s+min/avg/max/mdev\s+=\s+([^\s]+)@', $output, $matches))
            {
                $rtt = explode('/', $matches[1]);
                
                $results['rtt'] = array_combine(array('min', 'avg', 'max', 'mdev'), $rtt);
            }
        }

        return $results;
    }
}

