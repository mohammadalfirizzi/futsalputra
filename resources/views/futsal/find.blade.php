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
            position: fixed;
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
            <form action="{{route('checkFind')}}" method="POST">
                @csrf
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                        <input name="tanggal" type="date" class="form-control" id="exampleFormControlInput1" value="{{date('Y-m-d')}}">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Lapangan</label>
                        <select name="lapangan" class="form-select" aria-label="Default select example">
                            @foreach ($lapangan as $l)
                            <option value="{{$l->id}}">{{$l->court_type_name}} - {{$l->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Jam</label>
                        <select name="jam" class="form-select" aria-label="Default select example">
                            @foreach ($jam as $j)
                            <option value="{{$j->jam}}">{{$j->jam}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Search</button>
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

</html>