function cekketersediaan() {
    const date = document.getElementById('tgl-availability').value;
    if (date) {
        fetch('cek_ketersediaan.php?date=' + date)
            .then(response => response.text())
            .then(data => {
                document.getElementById('availability-result').textContent = data;
            });
    } else {
        document.getElementById('availability-result').textContent = 'Pilih tanggal.';
    }
}
