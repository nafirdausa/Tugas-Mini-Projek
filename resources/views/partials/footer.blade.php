<footer>
    @auth
        @if(Auth::check())
        @endif
    @else
    <div class="container-fluid fixed-bottom bg-info py-3" >
        <div class="row align-items-center">
            <div class="col-9">
                <h5 class="mb-1">Jangan Ketinggalan Berita Terbaru</h5>
                <p class="mb-0">Login untuk pengalaman yang baru</p>
            </div>
            <div class="col d-flex justify-content-end">
                <a href="{{route('login')}}">
                    <button class="btn btn-outline-light me-2">Login</button>
                </a>
                <a href="{{route('register')}}">
                    <button class="btn btn-light">Register</button>
                </a>
            </div>
        </div>
    </div>
    @endauth
</footer>