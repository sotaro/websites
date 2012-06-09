<?php

include("myCookie.php");
include("myList.php");
session_start();

Class shows extends myList{

	function __construct(){
		parent::__construct("shows");
	}

	function exec(){
		$func=parent::getFunc();
		$this->$func();
	}

	function create(){
		$part= '<div class="form_container">' .
					 '<h3>Venue</h3><input type="text" id="venue" name="venue" size="50">' .
					 '<h3>Band</h3><input type="text" id="band" name="band" size="50">' .
					 '<h3>Charge</h3><input type="text" id="charge" name="charge" size="50">' .
					 '<h3>Site</h3><input type="text" id="site" name="site" size="50">' .
					 '</div>';
		parent::create($part);
	}

	function update(){

		$y=@$_POST['year'];
		$m=@$_POST['month'];
		$d=@$_POST['day'];
		$v=@$_POST['venue'];
		$b=@$_POST['band'];
		$c=@$_POST['charge'];
		$s=@$_POST['site'];
		$u=@$_GET['unique'];
		$num=@$_GET['num'];
		$mode=parent::getMode();

		if(empty($y)||empty($m)||empty($d)||empty($v)||empty($b)||empty($c)||
			 empty($u)||$u!==$_SESSION['unique']||($mode==="mod"&&empty($num))){
		  echo "Oops, something wrong.";
			return;
		}

		$v=str_replace("'","\'",$v);
		$b=str_replace("'","\'",$b);
		$c=str_replace("'","\'",$c);
		$s=str_replace("'","\'",$s);

		$db=new myDB("shows");
		if($mode==="add"){
			$keys=array("date","venue","band","charge","site");
			$vals=array($y."-".$m."-".$d,$v,$b,$c,$s);
			if($db->add($keys,$vals)){
				header("location: http://".$_SERVER['HTTP_HOST']."/admin/shows.php");
				return;
			}
		}
		else if($mode==="mod"){
			$kvs=array();
			$kvs["date"]=$y."-".$m."-".$d;
			$kvs["venue"]=$v;
			$kvs["band"]=$b;
			$kvs["charge"]=$c;
			$kvs["site"]=$s;
			if($db->mod($kvs,$num)){
				header("location: http://".$_SERVER['HTTP_HOST']."/admin/shows.php");
				return;
			}
		}
		echo "Oops, error occured.";
	}

	function getOne(){
		$row=parent::getOne();
		if(count($row)===0){
			echo '{"v":"not found","b":"no band","c":"no charge","s":"no site","y":"","m":"","d":""}';
			return;
		}
		list($y,$m,$d)=explode('-',$row[0]['date']);
		$v=str_replace('"','\"',$row[0]['venue']);
		$b=str_replace('"','\"',$row[0]['band']);
		$c=str_replace('"','\"',$row[0]['charge']);
		$s=str_replace('"','\"',$row[0]['site']);
		echo '{"v":"'.$v.'","b":"'.$b.'","c":"'.$c.'",'.'"s":"'.$s.'","y":"'.$y.'","m":"'.$m.'","d":"'.$d.'"}';
		return;
	}

	function get(){

		list($rows,$from,$p,$maxPage,$prev,$next)=parent::get();
		
		echo "Page ".$p." / ".$maxPage."<br />".$prev." / ".$next;
		echo '<table border="0" cellspacing="3">';
		echo '<tr><th>#</th><th /><th /><th style=text-aling:left>&nbsp;Date</th>';
		echo '<th>&nbsp;Venue</th><th>&nbsp;Band</th><th>&nbsp;Charge</th><th>&nbsp;Site</th></tr>';
		$i=1;
		foreach($rows as $row){
			echo '<tr><td>'.sprintf("%02d",($from+$i)).'</td>&nbsp;';
			echo '<td><div id="modify" class="shows/'.$row['num'].'">';
			echo '<img src="../images/layout/edit.png" width="24" height="24" /></div></td>';
			echo '<td><div id="delete" class="shows/'.$row['num'].'">';
			echo '<img src="../images/layout/dump.png" width="24" height="24" /></div></td>';
			echo '<td>&nbsp;'.$row['date'].'&nbsp;</td><td>'.$row['venue'].'</td>';
			echo '<td>'.$row['band'].'</td><td>'.$row['charge'].'</td><td>'.$row['site'].'</td></tr>';
			$i++;
		}
		echo '</table><br /><br />';
		echo "Page ".$p." / ".$maxPage."<br />".$prev." / ".$next;
		echo '</div></div></body></html>';
	}
}

if(!myCheckCookie()){
		header("location: http://".$_SERVER['HTTP_HOST']."/admin/index.php");
		return;
}
$n = new shows();
$n->exec();

?>
