<?php

Class myFile{

	var $type;
	var $mode;
	var $langs;
	var $files;
	var $fps;

	function __construct($t,$langs){
		$this->type=$t;
		$this->mode=@$_GET['mode'];
		$this->langs=$langs;
		foreach($this->langs as $lang){
			$this->files[$lang]=getcwd()."/".$this->type."_".$lang.".txt";
			$this->fps[$lang]=NULL;
		}
	}

	function __destruct(){
		$this->close();
	}

	function run(){
		$f=$this->getFunc();
		$this->$f();
	
	}
	private function getFunc(){

		$func="";
		switch ($this->mode){
			case "update":
				$func="update";
				break;
			default:
				$func="show";
		}
		return $func;
	}

	private function update(){

		$contents=array();
		foreach($this->langs as $lang){
			$$lang=@$_POST[$this->type."-".$lang];
			if(empty($$lang)){
				error_log("An empty field was found.");
				$_SESSION['err']="An empty field was found. Check then try again.";
				header("location: http://".$_SERVER['HTTP_HOST']."/admin/".$this->type.".php?err=on");
				return;
			}
			$contents[$lang]=$$lang;
		}
		$u=@$_GET['unique'];
		if(empty($u)||$u!==$_SESSION['unique']){
			error_log("Prameter 'unique' was missing or wrong.");
			$_SESSION['err']="Invalid request. Try again.";
			header("location: http://".$_SERVER['HTTP_HOST']."/admin/".$this->type.".php?err=on");
			return;
		}
		if(!$this->write($contents)){
			error_log("Oops, failed to update.");
			$_SESSION['err']="Sorry, failed to update.";
			header("location: http://".$_SERVER['HTTP_HOST']."/admin/".$this->type.".php?err=on");
			return;
		}
		header("location: http://".$_SERVER['HTTP_HOST']."/admin/".$this->type.".php");
		return;
	}

	private function show(){

		include('header.html');
		$err=@$_SESSION['err'];
		if(!empty($err)){
			echo '<div id="err">'.$_SESSION['err'].'</div>';
			$_SESSION['err']=NULL;
		}

		$contents=array();
		$this->read($contents);

		$u=hash("crc32",rand());
		$_SESSION['unique']=$u;
		echo '<form id="upd" name="form" action="'.$this->type.'.php?mode=update&unique='.$u.'" method="post">';
		foreach($contents as $lang => $content)
			echo '<div class="form_container"><h3>'.$lang.'</h3>'.
					 '<textarea id="'.$this->type.'-'.$lang.'" name="'.$this->type.'-'.$lang.'" rows="20">'.
					 $content.'</textarea></div>';
		echo '<div class="form_container"><input id="update" type="submit" value="Update" /></div>';
		echo '</div></body></html>';
	}

	private function read(&$contents){
		foreach($this->files as $lang => $fname){
			$contents[$lang]=file_get_contents($fname);
		}
	}

	private function write($contents){
		if(!$this->open()) return false;
		foreach($this->files as $lang => $fname){
			if(!fwrite($this->fps[$lang],$contents[$lang]))
				error_log("failed to fwrite. ".$this->type."_".$lang);
			if(!rename($fname.".new",$fname))
				error_log("failed to rename. ".$this->type."_".$lang);
		}
		$this->close();
		return true;
	}

	private function open(){
		if(!$fp=fopen(getcwd()."/lock.txt","r")) return false;
		if(!flock($fp,LOCK_EX|LOCK_NB)) return false;
		$this->fps['lock']=$fp;

		foreach($this->files as $lang => $fname){
			if($this->fps[$lang]) continue;
			if(!$fp=fopen($fname.".new","w")){
				error_log("failed to open file. ".$this->type."_".$lang);
				return false;	
			}
			$this->fps[$lang]=$fp;
		}
		return true;
	}

	private function close(){
		foreach($this->fps as $lang => $fp){
			if($fp){ 
				fclose($fp);
				unset($this->fps[$lang]);
			}
		}
	}
}
