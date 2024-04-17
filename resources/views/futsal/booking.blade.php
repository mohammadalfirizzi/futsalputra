<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Futsal Website Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* Add your custom styles here */
        footer {
            position: relative;
            height: 50px;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Futsal Club</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Panduan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Daftar Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Booking Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Cek Booking</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <h1>Halaman Booking</h1>
            <form action="{{route('checkBooking')}}" method="POST">
                @csrf
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                        <input name="tanggal" type="date" class="form-control" id="exampleFormControlInput1" value="{{$tanggal}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Lapangan</label>
                        <input type="hidden" id="hargaLapangan" class="form-control" value="{{$nama_lapangan->price}}">
                        <select name="lapangan" class="form-select" aria-label="Default select example">
                            <option value="{{$nama_lapangan->id}}">{{$nama_lapangan->court_type_name}} - {{$nama_lapangan->name}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jam</label>
                        <input type="text" class="form-control" name="jam" value="{{$jam}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Durasi</label>
                        <input type="number" class="form-control" name="duration" id="duration" value="1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Apakah anda menyewa sepatu?</label>
                        <div class="form-check">
                            <input class="form-check-input" name="sepatu" type="checkbox" id="sepatu">
                            <label class="form-check-label" for="flexCheckChecked">
                                Penyewaan Sepatu Rp 50.000 / jam
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Apakah anda menyewa kaos?</label>
                        <div class="form-check">
                            <input class="form-check-input" name="kaos" type="checkbox" id="kaos">
                            <label class="form-check-label" for="flexCheckChecked">
                                Penyewaan Kaos Rp 45.000 / jam
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Total Pembayaran</label>
                        <input type="number" id="grandtotal" class="form-control" name="grandtotal">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Masukkan Uang Anda</label>
                        <input type="number" class="form-control" name="paytotal">
                    </div>
                    <button disabled id="bookingbtn" type="submit" class="btn btn-primary btn-block mb-3">Booking</button>
                    <button type="button" onclick="checkHarga()" class="btn btn-success btn-block mb-3">Check</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Ini buat Footer -->
    <footer class="footer bg-dark text-white text-center py-3">
        <div class="container">
            &copy; 2024 Futsal Club
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<script>
    function checkHarga() {
        var sepatu = document.getElementById("sepatu");
        var kaos = document.getElementById("kaos");
        var hargaLapangan = document.getElementById("hargaLapangan").value;
        var duration = document.getElementById("duration").value;
        var total = hargaLapangan * duration;
        var grandtotal = document.getElementById("grandtotal");
        var bookingbtn = document.getElementById("bookingbtn");
        grandtotal.value = (sepatu.checked ? (kaos.checked ? 95000 + total : 50000 + total) : (kaos.checked ? 45000 + total : 0 + total));
        bookingbtn.disabled = false;
        console.log((sepatu.checked ? (kaos.checked ? 95000 + total : 50000 + total) : (kaos.checked ? 45000 + total : 0 + total)));
    }
</script>

</html>