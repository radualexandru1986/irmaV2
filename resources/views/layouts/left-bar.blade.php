<div class="left-bar bg-dark m-0 p-0">

    <a href="{{route('home')}}" class="menu-item p-3">
        Dashboard <i class="bi bi-house-door"></i>
    </a>

    <a href="{{route('rota.index')}}" class="menu-item p-3">
        Rotas <i class="bi bi-calendar3"></i>
    </a>

    <hr>

    <a href="{{route('user.index')}}" class="menu-item p-3">
        Users <i class="bi bi-person"></i>
    </a>

    <a href="{{route('shift.index')}}" class="menu-item p-3">
        Shifts <i class="bi bi-clock"></i>
    </a>

    <a href="{{route('department.index')}}" class="menu-item p-3">
        Departments <i class="bi bi-arrow-repeat"></i>
    </a>

    <a href="{{route('contract.index')}}" class="menu-item p-3">
        Contracts <i class="bi bi-clipboard"></i>
    </a>

    <a href="{{route('settings.index')}}" class="menu-item p-3">
        Settings <i class="bi bi-gear"></i>
    </a>
    <hr>

    <form action="{{route('logout')}}" method="post" id="logout"> @csrf </form>
    <div class="menu-item p-3" id="exitButton">
        Exit <i class="bi bi-box-arrow-left"></i>
    </div>
</div>

@push('scripts')
    <script>

        let btn = document.getElementById('exitButton');
        let form = document.getElementById('logout');
        btn.addEventListener('click', (event)=>{
           form.submit()
        })


    </script>
@endpush
