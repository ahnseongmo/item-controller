<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div>
            <a class="navbar-brand" href="/item">Item-Controller</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/item"
                        >items</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/category">categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/brand">brands</a>
                </li>
                @if(Auth::user())
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/logout"
                        >Logout</a
                    >
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#"
                        ><b>현재 사용자 : {{Auth::user()->name}} 님</b></a
                    >
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/login"
                        >Login</a
                    >
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
