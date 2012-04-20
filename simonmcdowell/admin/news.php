<?php

include("myCookie.php");
include("myList.php");
session_start();

Class news extends myList{

	function __construct(){
		parent::__construct("news");
	}

	function exec(){
		$func=parent::getFunc();
		$this->$func();
	}

	function create(){
		$part= '<div class="form_container"><h3>News</h3><textarea id="newsbody" name="news" rows="20">' .
					 '</textarea></div>';
		parent::create($part);
	}

	function update(){

		$y=@$_POST['year'];
		$m=@$_POST['month'];
		$d=@$_POST['day'];
		$n=@$_POST['news'];
		$u=@$_GET['unique'];
		$num=@$_GET['num'];
		$mode=parent::getMode();

		if($y===NULL||$m===NULL||$d===NULL||$n===NULL||$n===""||$u===NULL||
			 $u!==$_SESSION['unique']||($mode==="mod"&&$num===NULL)){
			header("location: http://".$_SERVER['HTTP_HOST']."/admin/news.php");
			return;
		}

		$db=new myDB("news");
		if($mode==="add"){
			$keys=array("date","news");
			$vals=array($y."-".$m."-".$d,$n);
			if($db->add($keys,$vals)){
				header("location: http://".$_SERVER['HTTP_HOST']."/admin/news.php");
				return;
			}
		}
		else if($mode==="mod"){
			$kvs=array();
			$kvs["date"]=$y."-".$m."-".$d;
			$kvs["news"]=str_replace("'","\'",$n);
			if($db->mod($kvs,$num)){
				header("location: http://".$_SERVER['HTTP_HOST']."/admin/news.php");
				return;
			}
		}
		echo "Oops, error occured.";
	}

	function getOne(){
		$row=parent::getOne();
		if(count($row)===0){
			echo '{"n":"not found","y":"","m":"","d":""}';
			return;
		}
		list($y,$m,$d)=explode('-',$row[0]['date']);
		$n=str_replace(array("\r\n","\r","\n"),"\\n",$row[0]['news']);
		echo '{"n":"'.htmlspecialchars($n).'","y":"'.$y.'","m":"'.$m.'","d":"'.$d.'"}';
		return;
	}

	function get(){

		list($rows,$from,$p,$maxPage,$prev,$next)=parent::get();
		
		echo "Page ".$p." / ".$maxPage."<br />".$prev." / ".$next;
		echo '<table border="0" cellspacing="3">';
		echo '<tr><th>#</th><th /><th /><th /><th style=text-aling:left>&nbsp;Date</th><th>&nbsp;News</th></tr>';
		$i=1;
		foreach($rows as $row){
			$n=$row['news'];
			$l=80;
			if(strlen($n) > $l){
				$n=substr($n,0,$l);
				$j=$l-1;
				while($n[$j]!==" ")$j--;
				$n=substr($n,0,$j)." ...";
			}
			$n2=htmlspecialchars($row['news']);
			echo '<tr><td>'.sprintf("%02d",($from+$i)).'</td>&nbsp;';
			echo '<td><div id="tt">';
			echo '<img title="'.$n2.'" src="../images/layout/view.png" width="24" height="24" /></div></td>';
			echo '<td><div id="modify" class="news/'.$row['num'].'">';
			echo '<img src="../images/layout/edit.png" width="24" height="24" /></div></td>';
			echo '<td><div id="delete" class="news/'.$row['num'].'">';
			echo '<img src="../images/layout/dump.png" width="24" height="24" /></div></td>';
		  echo '<td>&nbsp;'.$row['date'].'&nbsp;</td><td>'.$n.'</td></tr>';
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
$n = new news();
$n->exec();

?>
