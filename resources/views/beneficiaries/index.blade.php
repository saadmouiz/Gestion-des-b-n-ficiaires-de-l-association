<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archives Bénéficiaires</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        /* Global */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        /* Navbar */
        .navbar {
            background-color: red;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }

        .navbar-nav .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #cce5ff !important;
        }

        /* Hero Section */
        .hero-section {
            background-color: red;
            color: white;
            padding: 3rem 1rem;
            border-radius: 15px;
            margin-top:15px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .hero-section p {
            font-size: 1rem;
            font-weight: 300;
        }

        /* Search Bar */
        .search-bar {
            margin-bottom: 2rem;
        }

        .search-bar input {
            border: 1px solid #007bff;
            border-radius: 25px;
            padding: 0.75rem;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-bar button {
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
            background-color: red;
            border: none;
            color: white;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .search-bar button:hover {
            background-color: red;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-img-top {
            height: 180px;
            object-fit: cover;
        }

        .card-body {
            text-align: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .btn-card {
            background-color:red;
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-card:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            border-radius: 15px 15px 0 0;
        }

        footer p {
            margin: 0;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('beneficiaries.index') }}">Association Al Amal </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beneficiaries.create') }}">Ajouter Un bénéficiaire </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('beneficiaries.index') }}">Afficher des bénéficiaires</a>
                </li>
                @auth('admin')
                <li class="nav-item">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">Déconnexion</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="container">
    <div class="hero-section">
        <h1>Bienvenue dans les Archives</h1>
        <p>Gérez et explorez les informations des bénéficiaires en toute simplicité.</p>
    </div>

    <!-- Search Bar -->
    <form action="{{ route('beneficiaries.index') }}" method="GET" class="search-bar">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom, prénom ou CIN" value="{{ request('search') }}">
            <button class="btn" type="submit">Rechercher</button>
        </div>
    </form>

    <!-- Grid of Cards -->
    <div class="row gy-4">
        @forelse ($beneficiaries as $beneficiary)
        <div class="col-md-4">
            <div class="card">
                @if ($beneficiary->image_path)
                    <img src="{{ asset('storage/' . $beneficiary->image_path) }}" class="card-img-top" alt="Image">
                @else
                    <img src="https://via.placeholder.com/180" class="card-img-top" alt="Placeholder">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $beneficiary->nom }} {{ $beneficiary->prenom }}</h5>
                    <p class="card-text">{{ $beneficiary->cin }}</p>
                    <a href="{{ route('beneficiaries.show', $beneficiary) }}" class="btn btn-card">Voir plus</a>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">Aucun bénéficiaire trouvé.</p>
        @endforelse
    </div>
</div>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} Archives Bénéficiaires. Tous droits réservés.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
