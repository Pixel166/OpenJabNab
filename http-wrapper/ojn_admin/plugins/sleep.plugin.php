<?php 
if(!empty($_POST['p'])) {
	if(!empty($_POST['a'])) {
		if($_POST['a']=="sleep")
			$retour = ojnApi::getApiString("bunny/".$_SESSION['bunny']."/sleep/sleep?".ojnApi::getToken());
		elseif($_POST['a']=="wakeup")
			$retour = ojnApi::getApiString("bunny/".$_SESSION['bunny']."/sleep/wakeup?".ojnApi::getToken());
		elseif($_POST['a']=="setup")
			if(!empty($_POST['wakeL']) && !empty($_POST['sleepL']))
				$retour = ojnApi::getApiString("bunny/".$_SESSION['bunny']."/sleep/setup?wakeupList=".$_POST['wakeL']."&sleepList=".$_POST['sleepL']."&".ojnApi::getToken());
		if(isset($retour['ok']))
			$_SESSION['message'] = $retour['ok'];
		else
			$_SESSION['message'] = "Error : ".$retour['error'];
		session_write_close();
		header("Location: bunny_plugin.php?p=sleep");
	}
} 
$wakeup = "";
$sleep = "";
$lists = ojnApi::getApiList("bunny/".$_SESSION['bunny']."/sleep/getsetup?".ojnApi::getToken());
if(count($lists))
{
	$lists = array_chunk($lists, 7);
	$wakeup = preg_replace("|(\d+:\d+):00|", "$1", implode(",", $lists[0]));
	$sleep = preg_replace("|(\d+:\d+):00|", "$1", implode(",", $lists[1]));
}
?>
<form method="post">
<?php
if(isset($_SESSION['message'])) {
	echo $_SESSION['message'];
	$_SESSION['message'] = null;
	unset($_SESSION['message']);
}
?>
<fieldset>
<legend>Actions</legend>
<input type="hidden" name="p" value="sleep">
<input type="radio" name="a" value="sleep" checked="true" /> Sleep<br />
<input type="radio" name="a" value="wakeup" /> Wake Up<br />
<input type="radio" name="a" value="setup" /> Setup: <br />hh:mm,hh:mm,hh:mm.... 7 times for each list<br />
Wakeup List: <input type="text" name="wakeL" value="<?=$wakeup ?>"/>
Sleep List: <input type="text" name="sleepL" value="<?=$sleep ?>"/><br />
<input type="submit" value="Enregister">
</fieldset>
</form>
