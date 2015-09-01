(function() {
    tinymce.create('tinymce.plugins.Ufgallery', {
        init : function(ed, url) {
            ed.addButton('ufgallery', {
                title : 'Add recent posts shortcode',
                cmd : 'ufgallery',
                text : 'Gallery'
            });
  
            ed.addCommand('ufgallery', function() {
                var gallery = prompt("Gallery slug?"),
                    shortcode;

                if (gallery !== null) {
                    shortcode = '[ufgallery gallery="' + gallery + '"]';
                    ed.execCommand('mceInsertContent', 0, shortcode);
                }
            });
        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'ufgallery', tinymce.plugins.Ufgallery );
})();