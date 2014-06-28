<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Laravel Media Manager (tinymce) based on elFinder 2.1</title>

		<!-- jQuery and jQuery UI (REQUIRED) -->
		<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

		<!-- elFinder CSS (REQUIRED) -->
		<link rel="stylesheet" type="text/css" href="<?=$package_url . '/css/elfinder.min.css' ?>">
		<link rel="stylesheet" type="text/css" href="<?=$package_url . '/css/theme.css' ?>">

		<!-- elFinder JS (REQUIRED) -->
		<script src="<?=$package_url . '/js/elfinder.min.js' ?>"></script>

		<?php if (isset($config['lang'])) : ?>
		<!-- elFinder translation (OPTIONAL) -->
		<script src="<?=$package_url . '/js/i18n/elfinder.' . $config['lang'] . '.js' ?>"></script>
		<?php endif; ?>

		<!-- elFinder initialization (REQUIRED) -->
		<script type="text/javascript" charset="utf-8">
			var elFinderInstance, fileBrowserDialogue;

			fileBrowserDialogue = {
				init: function() {
					// Here goes your code for setting your custom things onLoad.
				},
				mySubmit: function (URL) {
					var win = tinyMCEPopup.getWindowArg('window');

					// pass selected file path to TinyMCE
					win.document.getElementById(tinyMCEPopup.getWindowArg('input')).value = URL;

					// are we an image browser?
					if (typeof(win.ImageDialog) != 'undefined') {
						// update image dimensions
						if (win.ImageDialog.getImageData) {
							win.ImageDialog.getImageData();
						}

						// update preview if necessary
						if (win.ImageDialog.showPreviewImage) {
							win.ImageDialog.showPreviewImage(URL);
						}
					}

					// close popup window
					tinyMCEPopup.close();
				}
			}

			tinyMCEPopup.onInit.add(fileBrowserDialogue.init, fileBrowserDialogue);

			$(function() {
				var config;

				config = <?= json_encode($config) ?>;

				config.getFileCallback = function(file) {
					fileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
				};

				// Documentation for client options:
				// https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
				elFinderInstance = $('#elfinder').elfinder(config).elfinder('instance');
			});
		</script>
	</head>
	<body>

		<!-- Element where elFinder will be created (REQUIRED) -->
		<div id="elfinder"></div>

	</body>
</html>