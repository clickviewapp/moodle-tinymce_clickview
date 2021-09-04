(function () {
	tinymce.create('tinymce.plugins.ClickView', {

		init : function (ed, url) {
			ed.addCommand('mceClickview', function () {
				ed.windowManager.open({
					file : ed.getParam("moodle_plugin_base") + 'clickview/dialog.php',
					width : 800,
					height : 494,
					inline : 1,
					resizable : false,
				}, {
					plugin_url : url,
				});
			});

			ed.addButton('clickview', {
				title: 'clickview.desc', //Moodle Substitution
				cmd: 'mceClickview',
				image: url + '/img/icon.png'
			});
		},

		getInfo : function () {
			return {
				longname : 'ClickView Video Inserter',
				author : 'ClickView Pty Ltd.',
				authorurl : 'http://clickview.com.au',
				infourl : 'http://clickview.com.au',
				version : "1.2"
			};
		}
	});

	tinymce.PluginManager.add('clickview', tinymce.plugins.ClickView);
})();
