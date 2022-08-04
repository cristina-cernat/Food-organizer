
<?php

    include('Includere/connection.php');
    $query = "SELECT name, popularity FROM `products` order by popularity DESC;";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $filename = "popularity".date('d.m.Y').'.csv';

    $data = fopen($filename, 'w');

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($data, $row);
    }

    fclose($data);

    if (file_exists($filename)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filename).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;
    }

?>
