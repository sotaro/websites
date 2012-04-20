<?php

Class myDB{

	var $table;
	var $conf;
	var $dbh;

	function __construct($t){

		$this->table=$t;
		$this->conf=unserialize(file_get_contents("../simon.conf"));
		$db=$this->conf['db'];

		if(!$this->dbh=mysql_connect($db['host'],$db['user'],$db['pass'])){
			error_log("mysql_connect() failed.");
			return FALSE;
		}
		if(!mysql_select_db($db['name'],$this->dbh)){
			mysql_close($this->dbh);
			error_log("mysql_select_db() failed.");
			return FALSE;
		}
	}

	function __destruct(){
		mysql_close($this->dbh);
	}

  function add($keys,$vals){
		$q="insert into ".$this->table." (";
		foreach($keys as $key){
			$q.=$key.",";
		}
		$q[strlen($q)-1]=")";
		$q.=" values(";
		foreach($vals as $val){
			$q.='"'.$val.'",';
		}
		$q[strlen($q)-1]=")";
		error_log($q);
		if(!mysql_query($q)){
			error_log(mysql_error());
			return FALSE;
		}
		return TRUE;
	}

  function del($num){
		$q="delete from ".$this->table." where num=".$num;
		error_log($q);
		if(!mysql_query($q)) return FALSE;
		return TRUE;
	}

  function mod($kvs,$num){
		$q="update ".$this->table." set ";
		foreach($kvs as $k => $v){
			$q.=$k."='".$v."',";
		}
		$q[strlen($q)-1]=" ";
		$q.=" where num=".$num;
		error_log($q);
		if(!mysql_query($q)) return FALSE;
		return TRUE;
	}

	function count(){
		if(!$r=mysql_query("select count(num) as num from ".$this->table)) return 0;
		$row=mysql_fetch_array($r);
		return $row['num'];
	}

	function get($num="",$order="",$from=NULL){

		$q="select * from ".$this->table;
		if($num) $q.=" where num=".$num;
		if($order) $q.=" order by ".$order." limit ".$from.",20";
		error_log($q);
		if(!$r=mysql_query($q)) return FALSE;
		$rows=array();
		while ($row = mysql_fetch_array($r))
			array_push($rows,$row);	
		mysql_free_result($r);
		return $rows;
	}
}

Class myList{

	var $type;
	var $mode;

	function __construct($t){
		$this->type=$t;
		$this->mode=@$_GET['mode'];
	}

	function getType(){
		return $this->type;
	}

	function getMode(){
		return $this->mode;
	}

	function getFunc(){

		$func="";
		switch ($this->mode){
			case "new":
				$func="create";
				break;
			case "del":
				$func="del";
				break;
			case "add":
			case "mod":
				$func="update";
				break;
			case "get":
				if(array_key_exists('num',$_GET)) $func="getOne";
				else $func="get";
				break;
			default:
				$func="show";
		}
		error_log("func : ".$func);
		return $func;
	}

	function show(){

		include("header.html");
		$p=(int)(@$_GET['page']);
		if($p<=0) $p=1;
		echo '<div id="tabs">';
		echo '<ul>';
		echo '<li><a href="'.$this->type.'.php?mode=get&page='.$p.'">View</a></li>';
		echo '<li><a href="'.$this->type.'.php?mode=new">Write</a></li>';
		echo '</ul>';
		echo '</div>';
		echo '</div></div></body></html>';

	}

	function create($part){

			$u=hash("crc32",rand());
			$_SESSION['unique']=$u;
			echo '<form id="upd" name="form" action="'.$this->type.'.php?mode=add&unique='.$u.'" method="post">';
			echo '<div class="form_container"><h3>Date</h3>';
			echo '<select id="day" name="day">';
			$d=(int)date('j');
			$max=(int)date('t',time());
			for($i=1;$i<=$max;$i++){
				if($i!==$d) echo '<option value="'.sprintf("%02d",$i).'">'.sprintf("%02d",$i).'</option>';
				else echo '<option value="'.sprintf("%02d",$d).'" selected>'.sprintf("%02d",$d).'</option>';
			}
			echo '</select>&nbsp;&nbsp;<select id="mon" name="month">';
			$m=(int)date('n'); 
			for($i=1;$i<=12;$i++){
				if($i!==$m) echo '<option value="'.sprintf("%02d",$i).'">'.sprintf("%02d",$i).'</option>';
				else echo '<option value="'.sprintf("%02d",$m).'" selected>'.sprintf("%02d",$m).'</option>';
			}
			echo '</select>&nbsp;&nbsp;<select id="year" name="year">';
			$y=date('Y'); 
			echo '<option value="'.$y.'" selected>'.$y.'</option>';
			echo '<option value="'.($y+1).'">'.($y+1).'</option>';
			echo '</select></div>';
			echo $part;
			echo '<div class="form_container"><input id="clear" type="reset" value="Clear" /></a> ';
			echo '<input id="proceed" type="submit" value="Register" /></div>';
			echo '</form>';
			echo '</div></div></body></html>';
	}

	function del(){
			error_log("num:".$_GET['num']);
			error_log(print_r($_COOKIE,TRUE));
			$db=new myDB($this->type);
			$db->del($_GET['num']);
			echo '{"url":"'.$this->type.'.php?.rand='.crc32(rand()).'"}';
			return;
	}

	function update(){
 		parent::update();
	}

	function getOne(){

		$db=new myDB($this->type);
		$num=(int)$_GET['num'];
		if($num<=0) $num=1;
		return $db->get($num);

	}

	function get(){

		$db=new myDB($this->type);
		$max=20;
		$p=(int)@$_GET['page'];
		$p=($p>0)?$p:1;
		$from=($p-1)*$max;
		$rows=$db->get(NULL,"num desc",$from);
		$maxPage=(int)ceil($db->count()/$max);
		$prev=$next="";
		if($p===1) $prev = "&lt;&nbsp;Prev&nbsp;".$max;
		else $prev = "<a href=\"news.php?page=".($p - 1)."\">&lt;&nbsp;Prev&nbsp;".$max."</a>";
		if($p===$maxPage) $next = "Next&nbsp;".$max."&nbsp;&gt;";
		else $next = "<a href=\"news.php?page=".($p + 1)."\">Next&nbsp;".$max."&nbsp;&gt;</a>";

		return array($rows,$from,$p,$maxPage,$prev,$next);
	}
}
?>
