<?php

include "Auth/OpenID/Consumer.php";
include "Auth/OpenID/FileStore.php";
include "Auth/OpenID/SReg.php";
include "Auth/OpenID/AX.php";
include "Auth/OpenID/PAPE.php";

Class myOpenID{

	var $ids		  = array("google" => "https://www.google.com/accounts/o8/id");
	var $consumer	= NULL;

	function __construct(){
		$this->consumer	= new Auth_OpenID_Consumer(new Auth_OpenID_FileStore(getcwd()."/oid"));
	}

	function authenticate($op,$returnTo,$maxAuthAge=0,$attrs){

		$req=$this->consumer->begin($this->ids[$op]);

		if($maxAuthAge){
			$pape=new Auth_OpenID_PAPE_Request(NULL,$maxAuthAge);
			$req->addExtension($pape);
		}

		if($op==="google" && !empty($attrs)){
			$ax=new Auth_OpenID_AX_FetchRequest();
			$ax->mode="fetch_request";
			$i = 1;
			foreach($attrs as $a){
				switch ($a){
					case "email":
						$ax->add(Auth_OpenID_AX_AttrInfo::make('http://axschema.org/contact/email',$i,TRUE,'email'));
						$i++;
						break;
					default:
						error_log("unknown attribute specified. ".$a." was skipped.");
				}
			}
			$req->addExtension($ax);
		}
		$url=$req->redirectURL("http://".$_SERVER['HTTP_HOST'].'/admin/',$returnTo);
		header("Location: ".$url); 
	}

	function validate(&$msg){

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].
		 			 "?openid1_nonce=".$_GET['openid1_nonce'];
		$res = $this->consumer->complete($url);
		if ($res->status == Auth_OpenID_CANCEL){
			$msg = "Verification cancelled.";
			return FALSE;
		}
		if ($res->status == Auth_OpenID_FAILURE){
			$msg = "OpenID authentication failed: " . $res->message;
			return FALSE;
		}

		$sreg = Auth_OpenID_SRegResponse::fromSuccessResponse($res)->contents();
		if (@$sreg['email']){
			;
		}

		$ax = Auth_OpenID_AX_FetchResponse::fromSuccessResponse($res);
		if (@$ax->data['http://axschema.org/contact/email']){
				if(hash("crc32",$ax->data['http://axschema.org/contact/email'][0])==="1f0f7d86") return TRUE ;
				if(hash("crc32",$ax->data['http://axschema.org/contact/email'][0])==="594f782c") return TRUE ;
				if(hash("crc32",$ax->data['http://axschema.org/contact/email'][0])==="796b3778") return TRUE ;
		}
		return FALSE;
	}
}
?>
