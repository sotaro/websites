<?php

include "Auth/OpenID/Consumer.php";
include "Auth/OpenID/FileStore.php";
include "Auth/OpenID/SReg.php";
include "Auth/OpenID/AX.php";
include "Auth/OpenID/PAPE.php";

Class myOpenID{

	var $ids		= array("google" => "https://www.google.com/accounts/o8/id");
	//var $endPoints	= array("google"=>"https://www.google.com/accounts/o8/ud");
	var $consumer	= NULL;

	function myOpenID(){
		$this->consumer	= new Auth_OpenID_Consumer(new Auth_OpenID_FileStore(getcwd()."/oid"));
	}

	//function authenticate($op,$maxAuthAge=0,$mail){
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
		//$url=$req->redirectURL('http://simon.localhost/admin/','http://simon.localhost/admin/test.php');
		$url=$req->redirectURL('http://simon.localhost/admin/',$returnTo);
		header("Location: ".$url); 
	}

	function validate(&$msg){

		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].
		 			 "?openid1_nonce=".$_GET['openid1_nonce'];
		$res = $this->consumer->complete($url);
		if ($res->status == Auth_OpenID_CANCEL) {
			$msg = "Verification cancelled.";
			return FALSE;
		}
		if ($res->status == Auth_OpenID_FAILURE) {
			$msg = "OpenID authentication failed: " . $res->message;
			return FALSE;
		}

		$openID = $res->getDisplayIdentifier();
		if($openID === "https://www.google.com/accounts/o8/id?id=AItOawnKweV6ZnXfxZdhy5UFvuSIqSshfA4lHVw") return TRUE;

		$sreg = Auth_OpenID_SRegResponse::fromSuccessResponse($res)->contents();
		if (@$sreg['email']) {
			if(hash("crc32",$sreg['email'])==="1f0f7d86") return TRUE;
		}
		/*
		if (@$sreg['nickname']) {
			$msg .= "  Your nickname is '".htmlentities($sreg['nickname']).  "'.";
		}
		if (@$sreg['fullname']) {
			$msg .= "  Your fullname is '".htmlentities($sreg['fullname']).  "'.";
		}
		*/
		/*
		$pape = Auth_OpenID_PAPE_Response::fromSuccessResponse($res);
		if ($pape){
			if ($pape->auth_policies) {
				$msg .= "<p>The following PAPE policies affected the authentication:</p><ul>";
				foreach ($pape->auth_policies as $uri) {
					$escaped_uri = htmlentities($uri);
					$msg .= "<li><tt>$escaped_uri</tt></li>";
				}
				$msg .= "</ul>";
			} else {
				$msg .= "<p>No PAPE policies affected the authentication.</p>";
			}
			if ($pape->auth_age) {
				$age = htmlentities($pape->auth_age);
				$msg .= "<p>The authentication age returned by the " .
					"server is: <tt>".$age."</tt></p>";
			}
			if ($pape->nist_auth_level) {
				$auth_level = htmlentities($pape->nist_auth_level);
				$msg .= "<p>The NIST auth level returned by the " .
					"server is: <tt>".$auth_level."</tt></p>";
			}
		}
		else {
			$msg .= "<p>No PAPE res was sent by the provider.</p>";
		}
		*/

		$ax = Auth_OpenID_AX_FetchResponse::fromSuccessResponse($res);
		if (@$ax->data['http://axschema.org/contact/email']){
				if(hash("crc32",$ax->data['http://axschema.org/contact/email'][0])==="1f0f7d86") return TRUE ;
		}
		return FALSE;
	}
}
?>
