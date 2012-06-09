<?php
$r=$_SERVER['REQUEST_URI'];
if($p=strpos($r,"?")) $r=substr($r,0,$p);
error_log($r);
if($r==="/" || $r==="/index.php"){
	echo '<div class="left-panel" style="width:40%">';
	echo '<div class="simon-image">';
	echo '<img src="images/layout/simon-image.png" width="587" height="439" />';
	echo '</div>';
}
else{
	echo '<div class="left-panel" style="width:20%">';
	echo '<br /><br /><br /><br /><br />';
}
?>
    <div class="social-icon">
    <img src="images/layout/facebook.gif" width="40" height="40" class="icon" />
    <a class="css3button" href="http://www.facebook.com/simonmcdowelldrummer" ><span class="inner-text">Simon's facebook</span></a>
    </div><br />
    <div  class="social-icon">
    <img src="images/layout/youtube.gif" width="40" height="40" class="icon" />
    <a class="css3button" href="http://www.youtube.com/user/themoaspecial" ><span class="inner-text">Simon's youtube</span></a>
    </div><br />
    <div  class="social-icon">
    <img src="images/layout/myspace.gif" width="40" height="40" class="icon" />
    <a class="css3button" href="http://www.myspace.com/simonmcdowelldrums" ><span class="inner-text">Simon's myspace</span></a>
		</div><br />
		<hr width="160" align="left" />
    <div class="social-icon">
    <img src="images/layout/facebook.gif" width="40" height="40" class="icon" />
    <a class="css3button" href="http://www.facebook.com/favoriteunderdog" ><span class="inner-text">Favorite Underdog</span></a>
    </div>
</div>
