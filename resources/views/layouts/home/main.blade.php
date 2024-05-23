<!DOCTYPE html>
<html lang="en">

@includeIf('layouts.home.head')

<body id="page-top">
<div class="se-pre-con"></div>

<!-- Navigation -->
@yield('nav')

<!-- Header -->
@includeIf('layouts.home.header')
@yield('content')
@includeIf('layouts.home.footer')
@includeIf('layouts.home.script')

</body>

</html>
