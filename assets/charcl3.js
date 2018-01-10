$(document).ready(function() {
   tinymce.init({
    selector: '#c',
	height:200,
    inline: false,
    menubar: false,
	statusbar: false,
    toolbar: 'bold,italic,underline,|,alignleft,aligncenter,alignright,alignjustify,|,bullist,numlist',
	
	max_chars: 2000, // max. allowed chars
    setup: function (ed) {
        var allowedKeys = [8, 37, 38, 39, 40, 46]; // backspace, delete and cursor keys
        ed.on('keydown', function (e) {
            if (allowedKeys.indexOf(e.keyCode) != -1) return true;
            if (tinymce_getContentLength() + 1 > this.settings.max_chars) {
                e.preventDefault();
                e.stopPropagation();
                return false;
            }
            return true;
        });
        ed.on('keyup', function (e) {
            tinymce_updateCharCounter(this, tinymce_getContentLength());
        });
    },
    init_instance_callback: function () { // initialize counter div
        $('#' + this.id).prev().append('<div class="char_count" style="font-weight:bold;font-size:13px;margin:10px;color:red;text-align:right"></div>');
        tinymce_updateCharCounter(this, tinymce_getContentLength());
    },
    paste_preprocess: function (plugin, args) {
        var editor = tinymce.get(tinymce.activeEditor.id);
        var len = editor.contentDocument.body.innerText.length;
        var text = $(args.content).text();
        if (len + text.length > editor.settings.max_chars) {
            alert('Pasting this exceeds the maximum allowed number of ' + editor.settings.max_chars + ' characters.');
            args.content = '';
        } else {
            tinymce_updateCharCounter(editor, len + text.length);
        }
    }
  });
  
  function tinymce_updateCharCounter(el, len) {
    $('#' + el.id).prev().find('.char_count').text(len + '/' + el.settings.max_chars);
}

function tinymce_getContentLength() {
    return tinymce.get(tinymce.activeEditor.id).contentDocument.body.innerText.length;
}
});