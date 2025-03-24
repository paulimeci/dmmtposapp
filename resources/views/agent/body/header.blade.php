<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->

            @php
                $id = Auth::user()->id;
                $user = App\Models\User::find($id);
            @endphp
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}"
                         alt="Header Avatar">
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{route('full.home')}}"><i class="ri-user-line align-middle me-1"></i> {{$user->name}}</a>
                    <a class="dropdown-item" href="{{route('xhirot.ditore')}}"><i class="ri-user-line align-middle me-1"></i> Xhiro totale</a>
                    <a class="dropdown-item" href="{{route('bej.shitje')}}"><i class="ri-user-line align-middle me-1"></i> Bej shitje</a>
                    <a class="dropdown-item" href="{{route('shiko.faturat')}}"><i class="ri-wallet-2-line align-middle me-1"></i> Shiko shitjet</a>
                    <a class="dropdown-item text-danger" href="{{ route('dmmt.logout') }}"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
