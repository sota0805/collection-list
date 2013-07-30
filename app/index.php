<?php
/**
 * Copyright 2004–2013 Mozilla Japan. All rights reserved.
 *
 * Licensed under the Mozilla Public License, version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.mozilla.org/MPL/2.0/
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

/**
*
* index.php
* Author: Sota Yamashita
* Version: 0.1
*
*/

// $link = mysql_connect('localhost', 'user', '');
$link = mysql_connect('localhost', 'root', 'root');
if(!$link) {
	die("データベースに接続出来ませんでした。");
}

//データベース選択
mysql_select_db('collections',$link);

// データベースから製作日をもとにデータを抽出
$sql = "select * from user ORDER BY 'created_at' DESC";
// 結果にデータを入力
$result = mysql_query($sql, $link);

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
	<title>Collection</title>
	<link rel="stylesheet" type="text/css" href="assets/css/top-TRUNK.css">
	<!-- Library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/masonry.pkgd.min.js"></script>
	<script>
		$(function(){
		  $('.commonContainer').masonry({
		    // options
		    itemSelector : '.item'
		  });
		});
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
	<a class="btn btn-primary" href="/collection-list/app/save.php">登録する</a>
</header>

<!-- Content
================================================== -->
<div id="container">
	<div class="commonContainer clearfix">

		<?php if ( $result !== false && mysql_num_rows($result) ): ?>
			<?php while ( $post = mysql_fetch_assoc($result) ): ?>
				<div class="item">
					<div class="userPic">
						<a href="<?php echo htmlspecialchars($post['url'], ENT_QUOTES, 'UTF-8'); ?>"><img src="#" alt=""></a>
					</div><!-- /userPic -->
					<div class="userInfo">
						<h3><?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
					</div><!-- /userInfo -->
				</div><!-- /item -->
			<?php endwhile; ?>
		<?php endif; ?>

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

