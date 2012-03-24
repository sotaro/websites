<h2>Latest News</h2>
    
		<?php
        	
            $db_name = "giftnzco_simn";
            
            $connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
            mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");
            
            $sql = "select count(num) as num from news";
            $rs = mysql_query($sql);
            mysql_free_result($rs);
            
            $rs = mysql_query("SELECT * FROM news ORDER BY num desc limit 1");
            
            while ($row = mysql_fetch_array($rs)) { 
        ?>
        <p id="topnews"><span class="date"><? echo $row['day']; ?>&nbsp;<? echo $row['month']; ?>&nbsp;<? echo $row['year']; ?></span><br />
        <? echo $row['news']; ?><br />
        
        <? } ?>
        <a href="news.php">more news</a></p>
<h2>Upcoming Shows</h2>
	<?php
    
        $db_name = "giftnzco_simn";
        
        $connection = mysql_connect("localhost", "giftnzco_toshi", "mysqladmin") or die("Sorry, You couldn't connect to the database.");
        mysql_select_db($db_name, $connection) or die("Sorry, You couldn't select the database.");
        
        $sql = "select count(ordercode) as num from shows";
        $rs = mysql_query($sql);
        mysql_free_result($rs);
        
        $rs = mysql_query("SELECT * FROM shows ORDER BY ordercode limit 3");
        
        while ($row = mysql_fetch_array($rs)) { 
    ?>
    <p class="itemlist"><span class="date"><? echo $row['day']; ?>&nbsp;<? echo $row['month']; ?>&nbsp;<? echo $row['year']; ?>&nbsp;(<? echo $row['theday']; ?>)&nbsp;<? echo $row['time']; ?></span><br />
    <? echo "Venue: " .$row['venue']; ?>
    <? echo "<br />Band/Artist: " .$row['band']; ?>
    <? echo "<br />Cost: " .$row['charge']; ?>
    <? echo "<br />Website: <a href=\"" .$row['url']. "\" target=\"_blank\">" .$row['url']. "</a>"; ?></p>
    
    <?php } ?>
    <p><a href="shows.php">more shows</a></p>
 