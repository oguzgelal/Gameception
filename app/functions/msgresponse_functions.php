<?php
	/*
	* Ex : error #x
	* Sx : success #x
	* Ix : info #x
	*/
	function getMessage($msgcode){
		if ($msgcode == "E0"){ return dbFail(); }
		else if ($msgcode == "E1"){ return loginError(); }
		else if ($msgcode == "S1"){ return loginSuccess(); }
		else if ($msgcode == "E2"){ return ajaxPathFail(); }
		else if ($msgcode == "E3"){ return logoutError(); }
		else if ($msgcode == "S3"){ return logoutSuccess(); }
		else if ($msgcode == "E4"){ return loginRequired(); }
		else if ($msgcode == "E5"){ return missingData(); }
		else if ($msgcode == "E6"){ return wentwrong(); }
		else if ($msgcode == "E7"){ return morematch(); }
		else if ($msgcode == "E8"){ return notnumeric(); }
		else if ($msgcode == "E9"){ return usernotfound(); }
		else if ($msgcode == "E10"){ return matchnotfound(); }
		else if ($msgcode == "E11"){ return notenoughmoney(); }
		else if ($msgcode == "E12"){ return matchnotactive(); }
		else if ($msgcode == "E13"){ return accountinactive(); }
		else if ($msgcode == "E14"){ return fatalerror(); }
		else if ($msgcode == "E15"){ return datacorrupted(); }
		else if ($msgcode == "E16"){ return matchoutdated(); }
		else if ($msgcode == "E17"){ return cantaddmatch(); }
		else if ($msgcode == "S18"){ return couponplayed(); }
		else if ($msgcode == "E19"){ return questionnotfound(); }
		else if ($msgcode == "E20"){ return answernotfound(); }
		else if ($msgcode == "E21"){ return matchnotadded(); }
		else if ($msgcode == "E22"){ return questionnotadded(); }
		else if ($msgcode == "E23"){ return answerdoesnotbelong(); }
		else if ($msgcode == "E24"){ return adminrequired(); }
		else if ($msgcode == "S25"){ return matchdeleted(); }
		else if ($msgcode == "E26"){ return answernotadded(); }
		else if ($msgcode == "S27"){ return questiondeleted(); }
		else if ($msgcode == "S28"){ return answerdeleted(); }
		else if ($msgcode == "E29"){ return imageuploaderr(); }
		else if ($msgcode == "E30"){ return biotoolong(); }
		else if ($msgcode == "E31"){ return formdatamissing(); }
		else if ($msgcode == "E32"){ return invalidemail(); }
		else if ($msgcode == "E33"){ return invalidinvite(); }
		else if ($msgcode == "E34"){ return invalidnick(); }
		else if ($msgcode == "E35"){ return registrationFailed(); }
		else if ($msgcode == "S35"){ return registrationCompleted(); }
		else if ($msgcode == "E36"){ return invalidInput(); }
		else { return "E:undefined."; }
	}

	function invalidInput() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Geçersiz."; }
		}
		return "E:Invalid Input.";
	}
	function registrationFailed() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Kayıt işlemi sırasında bir hata oluştu."; }
		}
		return "E:Registration failed.";
	}
	function registrationCompleted() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Kayıt işlemi başarı ile tamamlandı."; }
		}
		return "S:Registration succeeded.";
	}
	function invalidnick() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Nick kullanımda."; }
		}
		return "E:Nick in use.";
	}
	function invalidemail() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Geçersiz / kullanımda email."; }
		}
		return "E:Email invalid or in use.";
	}
	function invalidinvite() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Geçersiz davet kodu."; }
		}
		return "E:Invalid invite code.";
	}
	function dbFail(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Veritabanına bağlanılamıyor."; }
		}
		return "E:Cannot connect to the database.";
	}
	function loginError(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Hatalı kullanıcı adı / şifre."; }
		}
		return "E:Invalid username and/or password.";
	}
	function loginSuccess(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Oturum açıldı."; }
		}
		return "S:Logged In.";
	}
	function ajaxPathFail(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Ajax dizini hatası."; }
		}
		return "E:Ajax path fail.";
	}
	function logoutError(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Oturum kapatılamadı."; }
		}
		return "E:Error logging out.";
	}
	function logoutSuccess(){
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Oturum kapatıldı."; }
		}
		return "S:Logged out.";
	}
	function loginRequired() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Bu işlem için üye girişi yapmanız gerekmektedir."; }
		}
		return "E:You have to login for this action.";
	}
	function missingData() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Hatalı/eksik bilgi."; }
		}
		return "E:Missing data.";
	}
	function wentwrong() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Beklenmedik bir hata oluştu."; }
		}
		return "E:Something went wrong.";
	}
	function morematch() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:En az bir maça oynamanız gerekmektedir."; }
		}
		return "E:You have to play at least one match.";
	}
	function notnumeric() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Yatıracağınız para yerine sayısal bir değer girmeniz gerekmektedir."; }
		}
		return "E:Deposit amount must be numeric.";
	}
	function usernotfound() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Kullanıcı bulunamadı."; }
		}
		return "E:User not found.";
	}
	function matchnotfound() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Maç bulunamadı."; }
		}
		return "E:Match could not be found.";
	}
	function notenoughmoney() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Yetersiz kredi bakiyesi."; }
		}
		return "E:Not enough money to play this coupon.";
	}
	function matchnotactive() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Oynadığınız maçlardan bir tanesi aktif değil."; }
		}
		return "E:One of the matches you have selected is not active.";
	}
	function accountinactive() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Hesabınız aktif değil."; }
		}
		return "E:Your account is not active.";
	}
	function fatalerror() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Sistem hatası."; }
		}
		return "E:Fatal error.";
	}
	function datacorrupted() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Bozuk bilgi girdiniz."; }
		}
		return "E:Data corrupted.";
	}
	function matchoutdated() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Oynadığınız maçlardan bir tanesi için bahisler kapandı."; }
		}
		return "E:One of the matches you have selected is outdated.";
	}
	function cantaddmatch() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Kupona maç eklenememektedir."; }
		}
		return "E:Cannot add match to the coupon.";
	}
	function couponplayed() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Kupon oynandı."; }
		}
		return "S:Coupon played.";
	}
	function questionnotfound() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Soru bulunamadı."; }
		}
		return "E:Question not found.";
	}
	function answernotfound() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Cevap bulunamadı."; }
		}
		return "E:Answer not found.";
	}
	function answerdoesnotbelong() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Cevap soruya ait değil."; }
		}
		return "E:Answer does not belong to the question.";
	}
	function matchnotadded() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Maç kupona eklenemedi."; }
		}
		return "E:Match not added to coupon.";
	}
	function questionnotadded() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Soru kupona eklenemedi."; }
		}
		return "E:Question not added to coupon.";
	}
	function adminrequired() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Bu işlemi yapabilmek için admin yetkisine sahip olmanız gerekmektedir."; }
		}
		return "E:Only admins can do this action.";
	}
	function matchdeleted() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Maç silindi."; }
		}
		return "S:Match deleted.";
	}
	function answernotadded() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Cevap eklenemedi."; }
		}
		return "E:Answer not added.";
	}
	function questiondeleted() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Soru silindi."; }
		}
		return "S:Question deleted.";
	}
	function answerdeleted() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "S:Cevap silindi."; }
		}
		return "S:Answer deleted.";
	}
	function imageuploaderr() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Geçersiz resim dosyası."; }
		}
		return "E:Image cannot be uploaded.";
	}
	function biotoolong() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Bio çok uzun. Maksimum 140 karakter."; }
		}
		return "E:Bio too long. Max 140 chars.";
	}
	function formdatamissing() {
		if (isset($_SESSION['lang'])){
			if ($_SESSION['lang']=="tr"){ return "E:Formu eksik doldurdunuz."; }
		}
		return "E:Form incomplete.";
	}
	
	?>