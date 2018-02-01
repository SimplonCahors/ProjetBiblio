tinymce.PluginManager.add('example', function(editor, url) {
    // Add a button that opens a window
    editor.addButton('example', {
        text: 'LWS Affiliation',
        icon: 'lws-affiliation-widget',
        onclick: function() {
            // Open window
            editor.windowManager.open({
                title: 'LWS Affiliation Widget',
                url:affiliationConfigWidget,
                width: 650,
                height: 500,
                onclose: function(e) {
                    if (typeof this.params.extension != 'function') {
                        var content = editor.getContent();
                        content = content.replace('<div class="widgetDomainNameContainer"></div>', '');
                        if (content.indexOf('divWidgetAffiliationLWS') == -1) {
                            editor.insertContent('<div class="widgetDomainNameContainer"><div class="divWidgetAffiliationLWS mceNonEditable" style="cursor:pointer;height: 100px;width: 100%;background-color: #f7f7f7;text-align:center;font-size:22px;font-weight:bold;line-height:100px;" data-extension="'+this.params.extension+'" data-theme="'+this.params.theme+'" data-txtButton="'+this.params.txtButton+'" data-cible="'+this.params.cible+'">Widget Affiliation LWS</div></div><br/>');
                        } else {
                            editor.windowManager.alert('Vous pouvez intégrer ce Widget une seule fois par page. Vous avez déjà intégré ce plugin dans ce post.')
                        }
                    }
                },
            }, {
                extension: function(){return 'com';},
                theme: function(){return 'default';},
                txtButton: function(){return 'Commander';},
                cible: function(){return 'blank';},
            });
        }
    });
});