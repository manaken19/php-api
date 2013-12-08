<?php
  switch ($_SERVER['REQUEST_URI']) {
    case '/api/item': case '/api/item.json':
      header("Content-Type: application/json; charset=utf-8");
      $response = array();
      $file     = './item.csv';
      $fp       = fopen($file, "r");
      while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        $response[] = $data;
      }
      fclose($fp);
      echo json_encode($response);
      break;
    case '/api/item.xml':
      header("Content-Type: application/xml; charset=utf-8");
      $response = array();
      $file     = './item.csv';
      $fp       = fopen($file, "r");
      while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
        $response[] = $data;
      }
      fclose($fp);
      $xml    = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
      $xml   .= "<items>\n";
      foreach ($response as $value) {
        $xml .= "<item>\n";
        $xml .= "<ItemID>" . $value['0'] . "</ItemID>";
        $xml .= "<CategoryID>" . $value['1'] . "</CategoryID>";
        $xml .= "<ItemName>" . $value['2'] . "</ItemName>";
        $xml .= "<Price>" . $value['3'] . "</Price>";
        $xml .= "</item>";
      }
      $xml .= "</items>\n";
      echo $xml;
      break;
  }

?>
