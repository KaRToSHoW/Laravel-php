<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Laravel</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <style>
    .comments-section {
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 10px;
    }

    .comments-section h3 {
      font-size: 1.8rem;
      font-weight: bold;
      color: #333;
    }

    .card {
      border-radius: 8px;
    }

    .card-header {
      background-color: #f1f1f1;
      font-size: 1rem;
    }

    .card-text {
      font-size: 1rem;
      color: #555;
    }

    .add-comment-section {
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
    }

    #toast-container {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1050;
      display: flex;
      flex-direction: column;
      gap: 10px;
      align-items: center;
    }

    .toast-message {
      opacity: 0;
      transform: translateY(-50%);
      animation: slide-in 0.5s forwards, fade-out 0.5s 3s forwards;
      padding: 10px 15px;
      border-radius: 5px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      font-size: 14px;
    }

    @keyframes slide-in {
      from {
        opacity: 0;
        transform: translateY(-50%);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fade-out {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
        transform: translateY(-50%);
      }
    }
  </style>
</head>
<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class=" navbar-brand" href="/">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/article">Articles</a>
          </li>
          @can('create')
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/article/create">Create article</a>
          </li>
          @endcan
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/about">О нас</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/comment/show">Check comments</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/contact">Контакты</a>
          </li>
          <!-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> -->
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0 gap-3">
          @guest
            <li class="nav-item">
              <a href="/auth/signup" class="btn btn-outline-success">SignUp</a>
            </li>
            <li class="nav-item">
              <a href="/auth/login" class="btn btn-outline-success">SignIn</a>
            </li>
          @endguest
          @auth
            <li class="nav-item">
              <a href="/auth/logout" class="btn btn-outline-danger">Logout</a>
            </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>
</header>
<main>
  <div class="container mt-3">
    @yield('content')
  </div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const toasts = document.querySelectorAll('.toast-message');
    toasts.forEach((toast) => {
      setTimeout(() => {
        toast.remove();
      }, 3500); // Время анимации fade-out + задержка
    });
  });
</script>
</body>

</html>