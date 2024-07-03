<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $tanggal = htmlspecialchars($_POST['tgl']);
    $tipe_kamar = htmlspecialchars($_POST['kamar']);

    if (file_exists('kamar.txt')) {
        $kamar = file('kamar.txt', FILE_IGNORE_NEW_LINES);
        $kamar_ditemukan = false;
        
        foreach ($kamar as $index => $room) {
            list($type, $status) = explode(':', $room);
            if ($type == $tipe_kamar && $status == 'tersedia') {
                $kamar[$index] = $type . ':tdktersedia';
                $kamar_ditemukan = true;
                break;
            }
        }

        if ($kamar_ditemukan) {
            file_put_contents('kamar.txt', implode(PHP_EOL, $kamar) . PHP_EOL);

            $reservasi = "Nama: $nama, Email: $email, Tanggal: $tanggal, Kamar: $tipe_kamar\n";
            file_put_contents('reservasi.txt', $reservasi, FILE_APPEND);
            
            header('Location: index.html?reserve=success');
            exit;
        } else {
            echo "Kamar tidak tersedia.";
        }
    } else {
        echo "Data kamar tidak tersedia.";
    }
} else {
    echo "request invalid.";
}
?>
