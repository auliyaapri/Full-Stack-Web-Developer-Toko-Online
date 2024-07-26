<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Click Sweet Alert</title>
    <!-- Load Sweet Alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Tombol yang akan menampilkan Sweet Alert saat diklik -->
    <button id="showAlertButton">Click Me</button>

    <!-- JavaScript untuk menampilkan Sweet Alert saat tombol diklik -->
    <script>
        // Mendapatkan referensi tombol
        const button = document.getElementById('showAlertButton');

        // Menambahkan event listener untuk mendeteksi klik pada tombol
        button.addEventListener('click', () => {
            // Menampilkan Sweet Alert ketika tombol diklik
            Swal.fire({
                icon: 'success',
                title: 'Sweet Alert!',
                text: 'Ini adalah contoh Sweet Alert.',
                showConfirmButton: false,
                timer: 3000
            });
        });
    </script>
</body>
</html>
