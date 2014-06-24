<script type="text/javascript" src="<?=LIB_JS_PATH?>/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        selector: "textarea",
       
        menubar: false,
		
        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],
		content_css: '<?=MODULE_PATH?>/post/css/editor_js.css'
});
</script>