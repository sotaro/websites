<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" href="../css/ui-darkness/jquery-ui-1.8.18.custom.css" type="text/css" />
<meta name="keywords" content="Drummer,Drum,Drum tutor,tutor,Simon,Simon McDowell" />
<meta name="description" content="" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	var $tabs = $('#tabs').tabs({});

	$('#back').click(function(){
		a=$('#'+$(this).attr("class")).attr("action").split('?');
		$('#'+$(this).attr("class")).attr("action",a[0]+'?mode=disp');
		$('#'+$(this).attr("class")).submit();
		
	});

});
</script>
