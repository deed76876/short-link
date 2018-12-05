<?php
require_once('config.inc.php');
require_once('global.inc.php');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<?php require_once('head.php'); ?>
	<title>短网址生成器 | LinkShortener</title>
</head>

<body>
<div class="wrapper">
	<?php require_once('header.php'); ?>
	<?php require_once('modals.php'); ?>
	<div class="container">

		<div id="main" class="form ui-widget load-overlay container">
			<div id="main-tabs">
				<ul class="nav nav-tabs">
					<li role="presentation" class="active"><a role="tab" href="#main-link-set">缩短</a></li>
					<li role="presentation"><a role="tab" href="#main-link-get">还原</a></li>
				</ul>
				<p>&nbsp;</p>
				<div id="main-tab-content" class="tab-content">
					<div id="main-link-set" class="tab-pane fade active in">
						<form class="form" action="javascript:void(0)">
							<label>原始网址</label>
							<div class="form-group input-group input-group-lg">
								<label for="form-set-url" class="sr-only">Shorten</label>
								<input type="text" id="form-set-url" class="form-control"
								       maxlength="500" placeholder="在此输入想要缩短的网址"
								       required autofocus autocomplete="off"/>
								<span class="input-group-btn">
                                    <button id="form-set-submit" type="submit" class="btn btn-default">缩短</button>
                                </span>
							</div>
							<label>自定义短链（可选）</label>
							<div class="form-group input-group input-group-lg">
								<div class="input-group-addon">
									<span><?= BASE_URL ?>/</span>
								</div>
								<label for="form-set-token" class="sr-only">Custom Token</label>
								<input type="text" id="form-set-token" class="form-control"
								       minlength="5" maxlength="15"
								       placeholder="字母、数字，5-15位" autocomplete="off"/>
							</div>
							<label>备注（可选）</label>
							<div class="form-group form-group-lg">
								<label for="form-set-remark" class="sr-only">Custom Token</label>
								<input type="text" id="form-set-remark" class="form-control"
								       placeholder="短链接备注" autocomplete="off"/>
							</div>
							<label>有效期自（可选）</label>
							<div class="form-group form-group-lg">
								<div class='input-group date date-picker'>
									<label for="form-set-valid-from" class="sr-only">Valid From</label>
									<input type='text' class="form-control" placeholder="留空表示不限制"
									       id="form-set-valid-from"/>
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
							<label>有效期至（可选）</label>
							<div class="form-group form-group-lg">
								<div class='input-group date date-picker'>
									<label for="form-set-valid-to" class="sr-only">Valid To</label>
									<input type='text' class="form-control" placeholder="留空表示不限制"
									       id="form-set-valid-to"/>
									<div class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div id="main-link-get" class="tab-pane fade">
						<form class="form" action="javascript:void(0)">
							<div class="input-group input-group-lg">
								<div class="input-group-addon">
									<span><?= BASE_URL ?>/</span>
								</div>
								<label for="form-get-token" class="sr-only">Token</label>
								<input type="text" id="form-get-token" class="form-control" placeholder="补全短网址"
								       required/>
								<span class="input-group-btn">
                                    <button id="form-get-submit" type="submit" class="btn btn-default">还原</button>
                                </span>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</div> <!-- /container -->
	<!--This div exists to avoid footer from covering main body-->
	<div class="push"></div>
</div>
<?php require_once('footer.php'); ?>
<script src="static/main.js"></script>
</body>
</html>