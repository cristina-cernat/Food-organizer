<?php
    session_start();
    include('Includere/connection.php');
    $stmt = $dbh->prepare("SELECT id FROM `users` where email = :email;");
    $stmt->bindParam(':email', $email);
    $email = $_SESSION['email'];
    $stmt->execute();
    $usr_id =  $stmt->fetch()['id'];

    $stmt = $dbh->prepare("SELECT name, quantity, product_id  FROM shoping_lists s JOIN products p on p.id = s.product_id WHERE user_id = :id;");
    $stmt->bindParam(':id', $id);
    $id=$usr_id;
    $stmt->execute();

    $filename = "shopping_list".date('d.m.Y').'.csv';

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
