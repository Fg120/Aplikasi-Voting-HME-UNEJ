<html>

<body>
    <h1>Verifikasi Token Login</h1>

    <p>Halo {{ $data['user']['nama'] }},</p>
    <p>Silakan gunakan token di bawah ini untuk melanjutkan proses login:</p>

    <p><strong>Token Login  :</strong> {{ $data['token'] }}</p>
    <p><strong>Link Website :</strong> <a href="{{ config('app.url') }}"></a>{{ config('app.url') }}</p>

    <p>Jangan lewatkan kesempatan untuk memilih pemimpin terbaik yang siap membawa Fakultas Teknik menuju perubahan dan kemajuan. Yuk, gunakan hak pilihmu
        sekarang!</p>

    <p>Terima kasih,<br>{{ config('app.name') }}</p>
</body>

</html>
