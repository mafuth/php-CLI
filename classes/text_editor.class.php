<?php
class text_editor{
    private $configure = false;
    private $CONFIG_STYLES;

    public function __construct($CONFIGS){
        if(!empty($CONFIGS)){
            $this->configure = true;
        }

        $this->CONFIG_STYLES = "<style>";
        if(in_array('hide_logo',$CONFIGS)){
            $CONFIG_STYLE = "
            .fr-second-toolbar a{
                display:none;
            }";
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_quick_insert',$CONFIGS)){
            $CONFIG_STYLE = "
            .fr-quick-insert{
                display:none;
            }";
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_insertFiles',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="insertFiles"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_moreRich',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="moreRich"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_moreMisc',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="moreMisc"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_insertImage',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="insertImage"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_insertVideo',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="insertVideo"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_insertFile',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="insertFile"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_markdown',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="markdown"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
        if(in_array('hide_insertLink',$CONFIGS)){
            $CONFIG_STYLE = '
            button[data-cmd="insertLink"]{
                display:none;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        }
            $CONFIG_STYLE = '
            .fr-wrapper{
                height:500px;
            }';
            $this->CONFIG_STYLES = $this->CONFIG_STYLES . $CONFIG_STYLE;
        
        $this->CONFIG_STYLES = $this->CONFIG_STYLES . '</style>';
    }
    public function build($BUILDER_NAME){
        $LAYOUT = '
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <style>a[href="https://www.froala.com/wysiwyg-editor?k=u"]{ display: none!important; }</style>
        ';
        if($this->configure == true){
            $LAYOUT = $LAYOUT . $this->CONFIG_STYLES;
        }
        $LAYOUT = $LAYOUT . '
        <textarea id="FroalaEditor" name="'.$BUILDER_NAME.'" style="height:500px;"></textarea>' . "
        <script>
            var editor = new FroalaEditor('#FroalaEditor', {toolbarInline: false})
        </script>
        ";
        return $LAYOUT;
    }
    public function buildCustome($BUILDER_NAME,$TEXT){
        $LAYOUT = '
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <style>a[href="https://www.froala.com/wysiwyg-editor?k=u"]{ display: none!important; }</style>
        ';
        if($this->configure == true){
            $LAYOUT = $LAYOUT . $this->CONFIG_STYLES;
        }
        $LAYOUT = $LAYOUT . '
        <textarea id="FroalaEditor" name="'.$BUILDER_NAME.'" style="height:500px;">'.$TEXT.'</textarea>' . "
        <script>
            var editor = new FroalaEditor('#FroalaEditor', {toolbarInline: false})
        </script>
        ";
        return $LAYOUT;
    }
}