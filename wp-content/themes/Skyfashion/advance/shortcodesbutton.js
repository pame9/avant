(function () {
    tinymce.create('tinymce.plugins.shortcodes', {
        init:function (ed, url) {
            ed.addButton('shortcodes', {
                title:'Insert Shortcodes',
                image:url + '/add.png',
                onclick:function () {
                    tb_show('Shortcodes Manager', url + '/shortcodesbutton.php?&height=450&width=640');
                }
            });
        },
        createControl:function (n, cm) {
            return null;
        },
        getInfo:function () {
            return {
                longname:"Skyfashion Shortcodes",
                author:'Apollo13',
                authorurl:'http://apollo13.eu/',
                infourl:'http://apollo13.eu/',
                version:"1.0"
            };
        }
    });
    tinymce.PluginManager.add('shortcodes', tinymce.plugins.shortcodes);
})();
