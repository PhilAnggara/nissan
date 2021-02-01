<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="shortcut icon" href="{{ url('frontend/images/logo.png') }}">
  <title>@yield('title')</title>
  @stack('prepend-style')
  @include('includes.admin.style')
  @stack('addon-style')
</head>
<body>

  @yield('content')

  @stack('prepend-script')
  @include('includes.admin.script')
  @stack('addon-script')
</body>
</html>