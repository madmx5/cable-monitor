<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Cable Modem Monitor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="<?php echo URL::site('assets/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo URL::site('assets/css/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">
    <style type="text/css">
      body {
        padding-bottom: 40px;
      }

      .page-header-condensed {
        margin: 8px 0 20px;
        padding-bottom: 0px;
      }

      .container .chart {
        height: 150px;
        margin: 0 0 10px;
      }
    </style>
    <link href="<?php echo URL::site('assets/css/bootstrap-responsive.css'); ?>" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!-- [if lt IE 9]>
        <script src="<?php echo URL::site('assets/js/html5shiv.js'); ?>"></script>
    <![endif]-->
</head>

<body>

    <div class="container">

        <div class="page-header page-header-condensed">
            <div class="pull-right">
                <form action="" class="form-inline" method="GET">
                    <div class="input-append date-time-picker">
                        <?php
                            echo Form::input('date[]', Arr::get($dates, 0), array(
                                    'class' => 'input-medium',
                                    'data-format' => 'yyyy-MM-dd hh:mm:ss',
                                    'placeholder' => 'From',
                                ));
                        ?>

                        <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                    </div>
                    <div class="input-append date-time-picker">
                        <?php
                            echo Form::input('date[]', Arr::get($dates, 1), array(
                                    'class' => 'input-medium',
                                    'data-format' => 'yyyy-MM-dd hh:mm:ss',
                                    'placeholder' => 'To',
                                ));
                        ?>

                        <span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>

                    <a href="<?php echo URL::site(); ?>" class="btn"><i class="icon-map-marker"></i></a>
                </form>
            </div>

            <h3 class="muted">Cable Modem Monitor</h3>
        </div>

        <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>Outage</th>
                <th>Restored</th>
                <th>Duration</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
<?php foreach ($outages as $data) : ?>
<?php
    if ((time() - $data[1]) < 120) :
        $class = 'error';
    elseif ((time() - $data[1]) < 300) :
        $class = 'warning';
    else :
        $class = '';
    endif;
?>
            <tr class="<?php echo $class; ?>">
                <td><?php echo Date::formatted_time('@' . $data[0], 'm/d/Y h:i:s a'); ?></td>
                <td><?php echo Date::formatted_time('@' . $data[1], 'm/d/Y h:i:s a'); ?></td>
                <td><?php

                    if ($data[1] === $data[0]) :
                        echo '&lt; 1 minute';
                    endif;

                    $span = Date::span($data[1], $data[0], 'minutes,seconds');
                    $sand = FALSE;

                    if (isset($span['minutes']) AND $span['minutes'] > 0) :
                        echo $span['minutes'] . ' ' . Inflector::plural('minute', $span['minutes']);

                        $sand = TRUE;
                    endif;

                    if (isset($span['seconds']) AND $span['seconds'] > 0) :
                        if ($sand === TRUE) :
                            echo ' and ';
                        endif;

                        echo $span['seconds'] . ' ' . Inflector::plural('second', $span['seconds']);
                    endif;
                                    
                ?></td>
                <td>
                    <a href="<?php echo URL::site('samples/index') . '?' . http_build_query(array(
                        'date' => array(
                            Date::formatted_time('@' . ($data[0] - 300), 'Y-m-d H:i:s'),
                            Date::formatted_time('@' . ($data[0] + 300), 'Y-m-d H:i:s')
                        ) )); ?>" class="btn btn-mini btn-inverse pull-right"><i class="icon-search icon-white"></i></a>
                </td>
            </tr>
<?php endforeach; ?>
        </tbody>
        </table>

        <br>

        <div class="accordion">
<?php
    foreach ($chart_groups as $group_name => $group) :
        $group_id = Inflector::camelize('collapse_' . $group_name);
?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a class="accordion-toggle" data-toggle="collapse" href="#<?php echo $group_id; ?>"><i class="<?php echo Arr::get($group, 'class', 'icon-th-large'); ?>"></i> <?php
                        echo Arr::get($group, 'title', Inflector::humanize($group_name)); ?></a>
                </div>
                <div class="accordion-body collapse in" id="<?php echo $group_id; ?>">
                    <div class="accordion-inner row">

<?php
        $index = 0;

        $chart_sets = Arr::get($group, 'chart', array());

        foreach ($chart_sets as $set_name => $chart_set) :
?>
                        <div class="span5<?php if ($index > 0 AND $index % 2 == 1) : echo ' offset1'; endif; ?>">
                            <h5><?php echo Inflector::humanize($set_name); ?></h5>

                            <div id="chart-<?php echo $set_name; ?>" class="chart"></div>
                        </div>
<?php
            $index += 1;
        endforeach;
?>

                    </div><!-- <div class="accordion-inner row"> -->
                </div>
            </div><!-- <div class="accordion-group"> -->

<?php
    endforeach;
?>


        </div>

    </div><!-- <div class="container"> -->

    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
    <script src="<?php echo URL::site('assets/flot/jquery.min.js'); ?>"></script>
    <script src="<?php echo URL::site('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo URL::site('assets/flot/jquery.flot.js'); ?>"></script>
    <script src="<?php echo URL::site('assets/flot/jquery.flot.time.js'); ?>"></script>
    <script src="<?php echo URL::site('assets/js/bootstrap-datetimepicker.min.js'); ?>"></script>

<script>

  function flotYTransform(v) {
    return (v == 0 ? 0 : Math.log(v));
  }

  function flotYInverseTransform(v) {
    return (v == 0 ? 0 : Math.exp(v));
  }

  $(function() {

<?php
    foreach ($chart_groups as $group_name => $group) :
?>
    /**
     * <?php echo ucwords(Inflector::humanize($group_name)); ?> Charts
     */
<?php
        $chart_sets = Arr::get($group, 'chart', array());

        foreach ($chart_sets as $set_name => $chart_set) :
            $dataset = Arr::get($chart_set, 'dataset', array());
            $options = Arr::get($chart_set, 'options', NULL);
?>

    var <?php echo Inflector::camelize('d_' . $set_name); ?> = <?php echo json_encode($dataset); ?>;

    $.plot('#chart-<?php echo $set_name; ?>', <?php echo Inflector::camelize('d_' . $set_name); ?><?php

        if (is_array($options)) :
            echo ', ', json_encode($options);
        elseif ($options !== NULL) :
            echo ', ', $options;
        endif;
?>);

<?php
        endforeach;
    endforeach;
?>

    $('.date-time-picker').datetimepicker({"lang":"en","pick12HourFormat":true});
  });
</script>

</body>
</html>

