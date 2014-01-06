<?php
header("Content-Type: application/xml; charset=utf-8");
?>
<?php foreach ($content_data as $item) {
    echo $item . "\n";
}?>