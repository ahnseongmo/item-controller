<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/item">Item-Controller</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li id="item_nav" class="nav-item">
                <a class="nav-link" href="/item">items <span class="sr-only">(current)</span></a>
            </li>
            <li id="category_nav" class="nav-item">
                <a class="nav-link" href="/category">categories</a>
            </li>
            <li id="brand_nav" class="nav-item">
                <a class="nav-link" href="/brand">brands</a>
            </li>
            @if(Auth::user())
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/logout">Logout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#"><b>현재 사용자 : {{Auth::user()->name}} 님</b></a>
            </li>
            @else
            <li id="login_nav" class="nav-item">
                <a class="nav-link" aria-current="page" href="/login">Login</a>
            </li>
            @endif
        </ul>
    </div>
</nav>

<script>
    const url = $(location).attr('pathname');
    switch (url.split('/')[1]) {
        case 'item':
        $('#item_nav').attr('class', 'active');
        break;
        case 'category':
        $('#category_nav').attr('class', 'active');
        break;
        case 'brand':
        $('#brand_nav').attr('class', 'active');
        break;
        case 'login':
        $('#login_nav').attr('class', 'active');
        break;
        case '':
        $('#login_nav').attr('class', 'active');
        break;
    }
</script>
