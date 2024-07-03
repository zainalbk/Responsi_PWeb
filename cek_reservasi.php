<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (file_exists('pegawai.txt')) {
        $employees = file('pegawai.txt', FILE_IGNORE_NEW_LINES);
        $authenticated = false;

        foreach ($employees as $employee) {
            list($stored_username, $stored_password) = explode(':', $employee);
            if ($username == $stored_username && $password == $stored_password) {
                $authenticated = true;
                break;
            }
        }

        if ($authenticated) {
            echo "<h2>Daftar Reservasi:</h2>";
            if (file_exists('reservasi.txt')) {
                echo "<div>" . nl2br(file_get_contents('reservasi.txt')) . "</div>";
            } else {
                echo "<p>Tidak ada reservasi.</p>";
            }
        } else {
            echo "<p>Autentikasi gagal. Harap coba lagi.</p>";
        }
    } else {
        echo "<p>Data pegawai tidak tersedia.</p>";
    }
} else {
    echo "<p>Invalid request method.</p>";
}
?>
