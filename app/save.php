<?php
/**
*
* save.php
* Author: Sota Yamashita
* Version: 0.1
*
*/

// $link = mysql_connect('localhost', 'user', '');
$link = mysql_connect('localhost', 'root', 'root');
if(!$link) {
	die("データベースに接続出来ませんでした。");
}

// データベース選択
mysql_select_db('collections',$link);

$errors = array();

// POSTで保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// 名前が正しく入力されているかチェック
	$name = null;
	if ( !isset($_POST['name']) || !strlen($_POST['name'])) {
		$errors['name'] = '名前を正しく入力してください';
	} elseif ( strlen($_POST['name']) > 20) {
		$errors['name'] = '名前は20字以内で入力してください。';
	} else {
		$name = $_POST['name'];
	}
	// urlが正しく入力されているかチェック
	$url = null;


	if ( !isset($_POST['url']) ) {
		$errors['url'] = 'URLを正しく入力してください';
	} else {
		$url = $_POST['url'];
	}

	// エラーがなければ保存
	if (count($errors) === 0) {
		// エスケープ処理
		// SQLインジェクション対策
		$name       = mysql_real_escape_string($name);
		$url        = mysql_real_escape_string($url);
		$created_at = date('Y-m-d H:i:s'); // 新規レコード作成時間

		//保存するためのSQL文を作成
		$sql = " INSERT INTO user "
			. " (name, url, created_at ) "
			. " VALUES ( '$name', '$url', '$created_at')  ";

		//保存する
		mysql_query($sql, $link);

		mysql_close($link);
		リダイレクト
		header('Location: http://' . $_SERVER['HTTP_HOST']. '/collection-list/app/');
	}
}


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="ja">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link href="assets/img/webmaker.ico" rel="icon" type="image/x-icon" />
	<title>Collection | Save</title>
	<link rel="stylesheet" type="text/css" href="assets/css/save-TRUNK.css">
	<script type="text/javascript" src="assets/js/jquery.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(".alert").alert('close')
	</script>
</head>
<body>

<!-- For IE
================================================== -->
<!--[if lt IE 7]>
  <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
<![endif]-->

<!--[if lt IE 9]>
  <script src="components/es5-shim/es5-shim.js"></script>
  <script src="components/json3/lib/json3.min.js"></script>
<![endif]-->


<!-- Header
================================================== -->
<header>
	<a href="./"><img src="assets/img/MakerPartyLogo.png" width="86" height="86" alt="Maker Party Logo"><span>Collection</span></a>
</header>

<!-- Content
================================================== -->
<div id="container">
	<div class="commonContainer clearfix">
		<?php if (count($errors)): ?> 
			<?php foreach ($errors as $error): ?>
				<div class="alert alert-danger" data-dismiss="alert">
					<a class="close" data-dismiss="alert" href="#">&times;</a>
					<?php echo htmlspecialchars("$error", ENT_QUOTES, 'UTF-8'); ?>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<form action="save.php" method="post">
 			<fieldset>
					<div class="form-group">
						<label for="exampleInputEmail">Name</label>
						<input type="text" name="name" class="form-control" placeholder="Enter your name">
					</div>
					<div class="form-group">
						<label for="exampleInputUrl">Url</label>
						<input type="url" name="url"class="form-control" id="exampleInputUrl" placeholder="Enter publised url">
        			</div>
        			<button type="submit" name="submit" class="btn btn-default">登録する</button>
			</fieldset>
		</form>

	</div><!-- /commonContainer --> 
</div><!-- /container -->

<!-- Footer
================================================== -->
<footer>
	<div id="topFooter">
		<img src="assets/img/MakerPartyWordmark.png" alt="Maker Party logo" >
		<ul>
			<li><a href="#">Privacy</a></li>
			<li><a href="#">Terms</a></li>
			<li><a href="#">Cookies</a></li>
			<li><a href="#">Send Feedback</a></li>
			<li id="custom-tweet-button"> 
			<a href="https://twitter.com/share?url=https%3A%2F%2Fdev.twitter.com%2Fpages%2Ftweet-button" target="_blank">Tweet</a>
			</li>
		</ul>
	</div><!-- /topFooter -->
	<div id="bottomFooter">
		<small>Copyright &copy; 2004 – 2013 Mozilla Japan. All rights reserved.</small>
	</div><!-- /bottomFooter -->
</footer>


<!-- Google Analytics
================================================== -->
<script>
  var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
  (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
  g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
  s.parentNode.insertBefore(g,s)}(document,'script'));
</script>

</body>

