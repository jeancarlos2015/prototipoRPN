<!doctype html>
<html lang="en">
@includeIf('layouts.wizards.material-bootstrap-wizard.head')
<body>

<div class="image-container set-full-height"
     style="background-image: url('{!! asset('material-bootstrap-wizard-v1.0.2/assets/img/wizard-book.jpg') !!}')">
    <!--   Creative Tim Branding   -->
    <a href="{!! route('painel') !!}">
        <div class="logo-container">
            <div class="brand">
                RPN
            </div>
        </div>
    </a>

    <!--   Big container   -->
    <div class="container">
        @yield('content')
    </div> <!--  big container -->

    @includeIf('layouts.wizards.material-bootstrap-wizard.footer')
</div>

</body>
@includeIf('layouts.wizards.material-bootstrap-wizard.script')
</html>
