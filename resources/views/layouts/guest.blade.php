<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net" />
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow-x: hidden;
      font-family: 'Figtree', sans-serif;
    }

    .login-section {
      position: relative;
      min-height: 100vh;
      overflow: hidden;
    }

    .bg-container {
      position: absolute;
      inset: 0;
      z-index: -1;
      overflow: hidden;
    }

    .bg-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      user-select: none;
      pointer-events: none;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.5);
      width: 100%;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      z-index: 1;
    }

    .form-container {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 2rem;
      width: 100%;
      max-width: 420px;
    }
  </style>
</head>

<body class="font-sans text-gray-900 antialiased">
  <section class="login-section">
    <!-- Background Image -->
    <div class="bg-container">
      <img src="{{ asset('images/bg1.jpeg') }}" alt="Background" />
    </div>

    <!-- Overlay + Form -->
    <div class="overlay">
      <div class="form-container">
        {{ $slot }}
      </div>
    </div>
  </section>
</body>
</html>
