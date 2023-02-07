<!DOCTYPE html>
<html>

<head>
    @include("layout.head")
    <title>@yield('title', 'Item-Controller')</title>
</head>

<body class="p-3">
    @include("layout.header") @yield("content") @include("layout.footer")
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <script src='/assets/js/index.js'>
    </script>
</body>

</html>