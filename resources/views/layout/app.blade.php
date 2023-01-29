<!DOCTYPE html>
<html>
    <head>
        @include("layout.head")
        <title>@yield('title', 'Item-Controller')</title>
    </head>
    <body>
        @include("layout.header")

        @yield("content")

        @include("layout.footer")
    </body>
</html>