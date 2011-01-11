<?php 
/**
 * The uploadify element.
 * This element will create an Uploadify file input box.
 *
 * @since v 1.0
 * @author Amos Chan <amos.chan@chapps.org>
 */
?>
<?php
if (isset($include_scripts)) {
    if (in_array("uploadify_css", $include_scripts))
        $this->Html->css("/cuploadify/css/uploadify.css", null, array("inline"=>false));

    if (in_array("swfobject", $include_scripts))
        echo $this->Html->script("/cuploadify/js/swfobject.js");

    if (in_array("uploadify", $include_scripts))
        echo $this->Html->script("/cuploadify/js/jquery.uploadify.min.js");

    if (in_array("jquery", $include_scripts))
        echo $this->Html->script("jquery/jquery");
}

if (!isset($options["uploader"]))
    $options["uploader"] = $this->Html->url("/cuploadify/files/uploadify.swf");

if (!isset($options["cancelImg"]))
    $options["cancelImg"] = $this->Html->url("/cuploadify/img/cancel.png");

if (isset($options["fileDataName"]))
    $options["scriptData"]["fileDataName"] = $options["fileDataName"];

if (isset($session_id))
    $options["scriptData"]["session_id"] = $session_id;
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#<?php echo $dom_id; ?>').uploadify({
        <?php 
        foreach ($options as $key => $val) {
            echo "'$key' : ";

            if ($key == "scriptData") {
                echo $this->Js->object($val);
            } else if (is_bool($val)) {
                echo $val ? "true" : "false";
            } else if (is_numeric($val)) {
                echo $val;
            } else {
                echo "\"$val\"";
            }

            echo ",";
        } 
        ?>
    });
});
</script>

<input id="<?php echo $dom_id; ?>" name="<?php echo $dom_id; ?>" type="file" />
