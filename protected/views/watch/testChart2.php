<div id='a'></div>
<a href="javascript:get();">get</a>
<script type="text/javascript">
function get(){
	console.log("begin");
	$.ajax({
		type:'get',
		url:'index.php?r=watch/testChart',
		data:'',
		dataType:'html',
		success:function(content){
			$("#a").html(content);
		},
		error:function(){
		
		}
	});
}
</script>
