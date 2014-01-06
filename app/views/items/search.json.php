<?php
header("Content-Type: application/json; charset=utf-8");
?>
{
    "result":
        {
        "item":
            [
<?php foreach ($content_data as $item) {
    echo json_encode($item) . ',' . "\n";
}?>
            ]
        }
}