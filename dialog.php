<?php

	define('NO_MOODLE_COOKIES', true); // Session not used here.

	require(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__)))))) . '/config.php');

    $config = get_config('local_clickview');

    $params = [
            'consumerKey' => $config->consumerkey,
            'singleSelectMode' => 'true'
    ];

    if (!empty($schoolid = $config->schoolid)) {
        $params['schoolId'] = $schoolid;
    }

    $url = new moodle_url($config->hostlocation . $config->iframeurl, $params);

	$PAGE->set_context(context_system::instance());
	$PAGE->set_url('/lib/editor/tinymce/plugins/clickview/dialog.php');

	$editor = get_texteditor('tinymce');
	$plugin = $editor->get_plugin('clickview');
	$htmllang = get_html_lang();

	header('Content-Type: text/html; charset=utf-8');
	header('X-UA-Compatible: IE=edge');
?>
<!DOCTYPE html>
<html <?php echo $htmllang ?> >
	<head>
		<title><?php print_string('clickview:desc', 'tinymce_clickview'); ?></title>
		<script type="text/javascript" src="<?php echo $editor->get_tinymce_base_url(); ?>/tiny_mce_popup.js"></script>
		<script type="text/javascript" src="<?php echo $config->eventsapi; ?>"></script>
		<script type="text/javascript" src="<?php echo $plugin->get_tinymce_file_url('js/dialog.js'); ?>" ></script>
	</head>
	<body>
		<iframe frameborder="0" id="cv-plugin-frame" src="<?php echo $url; ?>" width="100%" height="474" ><iframe>
	</body>
</html>
