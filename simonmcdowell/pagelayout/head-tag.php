<meta charset="UTF-8">
<link rel="stylesheet" href="../css/style.css" type="text/css" />
<link rel="stylesheet" href="../css/ui-darkness/jquery-ui-1.8.18.custom.css" type="text/css" />
<meta name="keywords" content="Drummer,Drum,Drum tutor,tutor,ドラム,ドラマー,レッスン" />
<meta name="description" content="ドラマー、サイモンのサイトです" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript">
$(function(){
	var $tabs = $('#tabs').tabs({});

	$('#back').click(function(){
		a=$('#'+$(this).attr("class")).attr("action").split('?');
		$('#'+$(this).attr("class")).attr("action",a[0]+'?mode=disp#head');
		$('#'+$(this).attr("class")).submit();
		
	});

});
</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-31463178-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
