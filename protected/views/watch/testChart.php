<?php
$pc->draw();
?>

<script>
var _basic_chart_plot_properties;
$(document).ready(function(){ 
setTimeout( function() { 
_basic_chart_plot_properties = [
  
]



$.jqplot.config.enablePlugins = 0;
$.jqplot.config.defaultHeight = 300;
$.jqplot.config.defaultWidth  = 400;
 _basic_chart= $.jqplot("basic_chart", [[11,9,5,12,14]], _basic_chart_plot_properties);

}, 200 );
});
</script>