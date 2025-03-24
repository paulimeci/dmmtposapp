<div class="vertical-menu">
    <div data-simplebar class="h-100">
    @php
        $id = Auth::user()->id;
        $adminData = App\Models\User::find($id);
    @endphp
        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty($adminData->profile_image))? url('upload/admin_images/'.$adminData->profile_image):url('upload/no_image.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{$adminData->name}}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i> Online</span>
            </div>
        </div>


        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li>
                    <a href="{{ url('/dashboard') }}" class="waves-effect">
                        <i class="ri-home-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-hotel-fill"></i>

                        <span>Menaxho furnitoret</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('shiko.furnitor') }}">Furinitoret</a></li>
                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Menaxho kategorite</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('shiko.kategori') }}">Kategorite</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-apps-2-fill"></i>
                        <span>Menaxho produktet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('shiko.produktet') }}">Produktet</a></li>
                        <li><a href="{{ route('edit.cmimet') }}">Edito cmimet</a></li>
                    </ul>
                </li>






                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-oil-fill"></i>
                        <span>Menaxho blerjet</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li><a href="{{route('shiko.blerjet')}}">Shiko Bljerjet</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-compass-2-fill"></i>
                        <span>Menaxho faturat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">All Invoices</a></li>
                        <li><a href="#">Approval Invoices</a></li>
                        <li><a href="#">Print Invoice List</a></li>
                        <li><a href="#">Daily Invoice Report</a></li>
                    </ul>
                </li>
                <li class="menu-title">Stock</li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-gift-fill"></i>
                        <span>Manage Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="#">Stock Report</a></li>
                        <li><a href="#">Supplier / Product Wise</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="has-arrow waves-effect">
                        <i class="ri-profile-line"></i>
                        <span>Support</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter.html">Starter Page</a></li>
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-directory.html">Directory</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
