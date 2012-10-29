<?php
require_once("../conf.php");
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>phpChart - Bar Line Pie Stack Demo</title>
</head>
    <body>
        <div><span> </span><span id="info1b"></span></div>

<?php
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 1
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $l1 = array(2, 3, 1, 4, 3);
    $l2 = array(1, 4, 3, 2, 5);

    $pc = new C_PhpChartX(array($l1,$l2),'chart1');
    $pc->add_plugins(array('canvasTextRenderer'));
	$pc->set_animate(true);
	$pc->set_title(array('text'=>'Stacked Filled Line Plot with Transparency (transparency not supported in IE6)'));
    $pc->set_stack_series(true);
    $pc->set_grid(array('background'=>'#fefbf3','borderWidth'=>'2.5'));
    $pc->set_series_default(array('fill'=> true, 'showMarker'=> false, 'shadow'=> false));
    $pc->set_xaxes(array(
         'xaxis'=>array('pad'=>1.0, 'numberTicks'=>5, 'autoscale'=>false)
    ));

    $pc->add_series(array('color'=>'rgba(68, 124, 147, 0.7)'));
    $pc->add_series(array('color'=>'rgba(150, 35, 90, 0.7)'));
    $pc->draw(600,310);

/*
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 2
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $l1 = array(array('2008-09-30', 4), array('2008-10-30', 6.5), array('2008-11-30', 5.7), array('2008-12-30', 9), array('2009-01-30', 8.2));

    $pc = new C_PhpChartX(array($l1),'chart2');
    $pc->add_plugins(array('canvasTextRenderer'));
	$pc->set_animate(true);
	$pc->set_title(array('text'=>'Rotated Axis Text'));
    //$pc->set_stack_series(true);
    $pc->set_grid(array('background'=>'#fefbf3','borderWidth'=>'2.5'));
    //$pc->set_series_default(array('fill'=> true, 'showMarker'=> false, 'shadow'=> false));
    $pc->set_xaxes(array(
         'xaxis'=>array(
             'renderer'=>'plugin::DateAxisRenderer',
             'min'=>'August 30, 2008',
             'tickInterval'=>'1 month',
             'rendererOptions'=>array(array('tickRenderer'=>'plugin::CanvasAxisTickRenderer')),
             'tickOptions'=>array('formatString'=>'%b %#d, %Y', 'fontSize'=>'10pt', 'fontFamily'=>'Tahoma', 'angle'=>'-40', 'fontWeight'=>'normal', 'fontStretch'=>1)
           )
    ));

    $pc->add_series(array('lineWidth'=>4,'markerOptions'=>array('style'=>'square')));
    $pc->draw(600,310);



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 3
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $line1 = array(array(4,1), array(4,2), array(3,3), array(16,4));
    $line2 = array(array(3,1), array(7,2), array(4,3), array(3.125,4));

    $pc = new C_PhpChartX(array($line1,$line2),'chart3');
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->set_title(array('text'=>'Unit Sales: Acme Decoy Division'));
	$pc->set_animate(true);
	$pc->set_stack_series(true);
    $pc->set_legend(array('show'=>true,'location'=>'se'));
    $pc->set_series_default(array('renderer'=> 'plugin::BarRenderer', 'rendererOptions'=> array('barDirection'=>'horizontal','barPadding'=>6,'barMargin'=>40)));
    $pc->add_series(array('label'=>'1st Qtr'));
    $pc->add_series(array('label'=>'2nd Qtr'));
    $pc->set_yaxes(array(
         'yaxis'=>array(
             'renderer'=>'plugin::CategoryAxisRenderer',
             'ticks'=> array('Q1', 'Q2', 'Q3', 'Q4')
             )
    ));

    $pc->draw(600,310);



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 3b
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $line1 = array(4, 2, 9, 16);
    $line2 = array(3, 7, 6.25, 3.125);
    //line1 = [4, 2, 9, 16];
    //line2 = [3, 7, 6.25, 3.125];

    $pc = new C_PhpChartX(array($line1,$line2),'chart3b');
    
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->set_title(array('text'=>'Unit Sales: Acme Decoy Division'));
    $pc->set_stack_series(true);
	$pc->set_animate(true);
    $pc->set_legend(array('show'=>true,'location'=>'nw'));
    $pc->set_series_default(array('renderer'=> 'plugin::BarRenderer', 'rendererOptions'=> array('barPadding'=>6,'barMargin'=>40)));
    $pc->add_series(array('label'=>'1st Qtr'));
    $pc->add_series(array('label'=>'2nd Qtr'));
    $pc->set_xaxes(array(
         'xaxis'=>array(
             'renderer'=>'plugin::CategoryAxisRenderer',
             'ticks'=> array('Q1', 'Q2', 'Q3', 'Q4')
             )
    ));

    $pc->draw(600,310);


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 3c
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $line1 = array(4, 2, 9, 16);
    $line2 = array(3, 7, 6.25, 3.125);
    //line1 = [4, 2, 9, 16];
    //line2 = [3, 7, 6.25, 3.125];

    $pc = new C_PhpChartX(array($line1,$line2),'chart3c');
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->set_title(array('text'=>'Unit Sales: Acme Decoy Division'));
	$pc->set_animate(true);
    $pc->set_legend(array('show'=>true,'location'=>'nw'));
    $pc->set_series_default(array('renderer'=> 'plugin::BarRenderer', 'rendererOptions'=> array('barPadding'=>6,'barMargin'=>40)));
    $pc->add_series(array('label'=>'1st Qtr'));
    $pc->add_series(array('label'=>'2nd Qtr'));

    $pc->set_xaxes(array(
         'xaxis'=>array(
             'renderer'=>'plugin::CategoryAxisRenderer',
             'ticks'=> array('Q1', 'Q2', 'Q3', 'Q4')
             )
    ));

    $pc->draw(600,310);


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 4
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $line1 = array(array('frogs', 3), array('buzzards', 7), array('deer', 2.5), array('turkeys', 6),array('moles', 5),array('ground hogs', 4));
    $line2 = array(3, 7, 2.5, 6, 5, 4);
    //line1 = [['frogs', 3], ['buzzards', 7], ['deer', 2.5], ['turkeys', 6], ['moles', 5], ['ground hogs', 4]];
    //line2 = [3, 7, 2.5, 6, 5, 4];

    $pc = new C_PhpChartX(array($line1),'plot4');
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->set_title(array('text'=>'Pie Chart with Legend and sliceMargin'));
    //$pc->set_stack_series(true);
	$pc->set_animate(true);
    $pc->set_legend(array('show'=>true));
    $pc->set_series_default(array('renderer'=> 'plugin::PieRenderer', 'rendererOptions'=> array('sliceMargin'=>8)));

    $pc->draw(600,310);

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 5
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $line1 = array(2.2, 3, .6, 4.8, 3);
    $line2 = array(1, 4, 3, 2, 5.7);
    //l1 = [2.2, 3, .6, 4.8, 3];
    //l2 = [1, 4, 3, 2, 5.7];

    $pc = new C_PhpChartX(array($line1,$line2),'plot5');
    
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->draw(600,310);

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Bar line pei example 6
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $pc = new C_PhpChartX(array(array(3,7,3,2,9,11,8)),'plot6');
    $pc->add_plugins(array('canvasTextRenderer'));
    $pc->set_animate(true);$pc->draw(600,310);

*/
?>

    </body>
</html>
