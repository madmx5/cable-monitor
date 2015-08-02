<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Samples controller class
 *
 * @package     Application
 * @category    Controller
 * @author      Todd Wirth
 * @copyright   (c) 2013
 */
class Controller_Samples extends Controller_Template {

    public function action_index()
    {
        $date = $this->request->query('date');

        if ( ! is_array($date) OR empty($date))
        {
            $date = array(
                date('Y-m-d H:i:s', strtotime('2 hours ago'))
            );
        }

        $samples_set = Model::factory('Sample')
            ->order_by('created_at', 'DESC');

        $outages = Model::factory('Sample')
            ->where('packet_loss', '>', 0.2);

        if (isset($date[0]) AND ! empty($date[0]))
        {
            $date[0] = date('Y-m-d H:i:s', strtotime($date[0]));

            $samples_set->where('created_at', '>=', $date[0]);

            $outages->where('created_at', '>=', $date[0]);

            $limit = FALSE;
        }

        if (isset($date[1]) AND ! empty($date[1]))
        {
            $date[1] = date('Y-m-d H:i:s', strtotime($date[1]));

            $samples_set->where('created_at', '<=', $date[1]);

            $outages->where('created_at', '<=', $date[1]);

            $limit = FALSE;
        }

        if ($limit === TRUE)
        {
            $samples_set->limit(120);
        }

        $this->template->dates = $date;

        $outages = $outages->order_by('created_at', 'ASC')
            ->find_outages(75, 1);

        $this->template->outages = array_reverse($outages);

        $samples_arr = array();

        foreach ($samples_set->reset(FALSE)->find_all() as $sample)
        {
            $samples_arr[] = $sample->id;
        }

        if ( ! empty($samples_arr))
        {
            $min_id = min($samples_arr);
            $max_id = max($samples_arr);

            $level_range = Model::factory('Sample_Level')->get_level_range($min_id, $max_id);
        }
        else
        {
            $level_range = array(-1, -1);
        }

        $levels_set = Model::factory('Sample_Level')
            ->where('id', '>=', $level_range['min_sample_id'])
            ->where('id', '<=', $level_range['max_sample_id'])
            ->order_by('sampled_at', 'DESC');

        $this->template->chart_groups = array(
                'samples' => Chart::build('samples', $samples_set),
                'levels'  => Chart::build('levels', $levels_set),
                'frequencies' => Chart::build('frequencies', $levels_set),
            );
    }
}

