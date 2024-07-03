<?php
if (isset($_GET['date'])) {
    $date = htmlspecialchars($_GET['date']);

    if (file_exists('kamar.txt')) {
        $rooms = file('kamar.txt', FILE_IGNORE_NEW_LINES);
        $kamarkosong = [];

        foreach ($rooms as $room) {
            list($type, $status) = explode(':', $room);
            if ($status == 'tersedia') {
                $kamarkosong[] = $type;
            }
        }

        if (!empty($kamarkosong)) {
            echo "Kamar yang tersedia pada " . $date . ": " . implode(', ', $kamarkosong);
        } else {
            echo "Tidak ada kamar yang tersedia pada " . $date;
        }
    } else {
        echo "Data kamar tidak tersedia.";
    }
} else {
    echo "Tanggal tidak diberikan.";
}
?>
