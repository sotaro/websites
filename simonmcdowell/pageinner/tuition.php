<?php

Class myForm{

	var $mode;
	var $symbol;
	var $title;
	var $keys;
	var $types;
	var $inputs;
	var $extras;
	var $specs;
	var $errors;

	function __construct($s,$t,$arr){

		$this->mode=@$_GET['mode'];
		$this->symbol=$s;
		$this->title=$t;
		$max=count($arr);
		for($i=0;$i<$max;$i++){
			$this->keys[$i]=$arr[$i][0];
			$this->inputs[$this->keys[$i]]=@$_POST[$this->keys[$i]];
			$this->types[$this->keys[$i]]=$arr[$i][1];
			$this->extras[$this->keys[$i]]=$arr[$i][2];
			$this->specs[$this->keys[$i]]=$arr[$i][3];
			$this->errors[$this->keys[$i]]="";
		}
	}

	private function disp($msg=""){

		$u=hash("crc32",rand());
		$_SESSION['uniq']=$u;

		echo '<h2>'.$this->title.'</h2>';
		echo file_get_contents(getcwd().'/admin/'.$this->symbol.'_en.txt');
		echo file_get_contents(getcwd().'/admin/'.$this->symbol.'_jp.txt');
		echo '<hr />';
		echo '<form id="'.$this->symbol.'_form" action="'.$this->symbol.'.php?mode=check&uniq='.$u.
				 '" method="post">';
		echo '<h3 style="font-size:120%">Please fill in the details below:</h3>';
		echo '<div id="msg">'.$msg.'</div>';
		foreach($this->keys as $key){
			echo '<p><label>'.ucwords($key).'</label>&nbsp;:'.$this->errors[$key].'<br />';
			if($this->types[$key]==="textarea"){
				echo '<textarea id="'.$key.'" name="'.$key.'"'.$this->extras[$key].'>'.
						 $this->inputs[$key].'</textarea></p>';
			}
			else{
				echo '<input type="'.$this->types[$key].'" id="'.$key.'" name="'.$key.'"'.$this->extras[$key].
				 		 'value="'.$this->inputs[$key].'" /></p>';
			}
		}
		echo '<p><input type="submit" value="check" /></p>';
		echo '</form>';

	}

	private function check(){

		$err=0;
		foreach($this->inputs as $key => $input){
			foreach($this->specs[$key] as $spec){
				if($spec==="must"){
					if(empty($input)){
						$this->errors[$key]="<span class=\"error\">   Empty</span>";
						$err++;
						break;
					}
				}
				else if($spec==="email"){
					if(!filter_var($input, FILTER_VALIDATE_EMAIL)){
						$this->errors[$key]="<span class=\"error\">   Invalid</span>";
						$err++;
						break;
					}
					list($usr,$domain)=split('@',$input);
					if(!checkdnsrr($domain,'MX')&&!checkdnsrr($domain,'A')){
						$this->errors[$key]="<span class=\"error\">   Invalid</span>";
						$err++;
						break;
					}
				}
			}
		}
		$u=@$_GET['uniq'];
		if(empty($u)||$u!==$_SESSION['uniq']){
			$msg="Please try again.";
			$err++;
		}

		if($err){
			$this->disp($msg);
			return;
		}
		$this->dispConfirm();
	}

	private function dispConfirm(){

		$u=hash("crc32",rand());
		$_SESSION['uniq']=$u;

		echo '<h2>'.$this->title.'</h2>';
		echo '<form id="'.$this->symbol.'_form" action="'.$this->symbol.'.php?mode=confirm&uniq='.$u.
				 '" method="post">';
		echo '<h3 style="font-size:120%" >Please confirm all the details below:</h3>';

		$vals="";
		foreach($this->keys as $key){
			echo '<p><label>'.$key.'</label>:'.$this->inputs[$key].'</p>';
			echo '<input type="hidden" name="'.$key.'" value="'.$this->inputs[$key].'" />';
			$vals.=$this->inputs[$key];
		}
		$sig=sha1($vals);
		$_SESSION['sig']=$sig;
		echo '<input type="hidden" name="sig" value="'.$sig.'" />';
		echo '<p><input id="back" type="button" value="modify" class="'.$this->symbol.'_form" />';
		echo '&nbsp;<input type="submit" value="submit" /></p>';
		echo '</form>';
	}

	private function confirm(){

		if(empty($_GET['uniq'])||$_GET['uniq']!==$_SESSION['uniq']){
			$this->disp("Please try again.");
			return;
		}

		if(empty($_POST['sig'])||$_POST['sig']!==$_SESSION['sig']){
			$this->disp("Please try again.");
			return;
		}

		//$to 			= "the.moa.special@gmail.com,the_moa_special@hotmail.com,simon@simonmcdowell.com";
		$to				= "sotaro.dev@gmail.com";
		$subject	= "Drum Tuition Inquiry";

		$msg  = "--------------------------------------------\n\n";
		$msg .= "  " .$this->inputs['name']. "\n\n";
		$msg .= "  Email: " .$this->inputs['email']. "\n\n";
		$msg .= "--------------------------------------------\n\n";
		$msg .= "\n\n";
		$msg .= "  Message:\n\n";
		$msg .= "  " .$this->inputs['message']. "\n\n";

		$mailheaders  = "From: " .$this->inputs['email']."\r\n";
		$mailheaders  = "Sender: ".$_SERVER['HTTP_HOST']."\r\n";
		$mailheaders .= "Reply-To: " .$this->inputs['email']. "\r\n";
		//$mailheaders .= "Errors-To: the.moa.special@gmail.com\r\n";
		$mailheaders .= "Errors-To: sotaro.dev@gmail.com\r\n";
		$mailheaders .= "MIME-Version: 1.0\r\n";
		$mailheaders .= "Content-type: text/plain; charset=\"UTF-8\"\r\n";
		$mailheaders .= "Content-Transfer-Encoding: 7bit\r\n";
		$mailheaders .= "X-Mailer: PHP/".phpversion()."\r\n"; 

		mail($to, $subject, $msg, $mailheaders);

		header ("Location: tuition.php?mode=thanks");
		return;
	}

	private function thanks(){

		echo '<h2>'.$this->title.'</h2>';
		echo '<p>Thank you for your inquiry. Your message has been sent successfully.</p>';
		echo '<p>Simon will reply to you shortly.</p>';
		echo '<p>お問い合わせありがとうございます。</p>';
		echo '<p>折り返し連絡します。サイモン</p>';
	}

	private function getFunc(){

		switch ($this->mode){
			case "check":
				$func="check";
				break;
			case "confirm":
				$func="confirm";
				break;
			case "thanks":
				$func="thanks";
				break;
			default:
				$func="disp";
		}
		return $func;
	}

	function run(){

		$f=$this->getFunc();
		$this->$f();	
	}

}

session_start();
$f=new myForm("tuition","Drum Tuition",
									array(
										array("name","text"," size=\"30\"",array("must")),
										array("email","text"," size=\"30\"",array("must","email")),
										array("message","textarea"," rows=\"8\"",array("must"))));
$f->run();
?>
