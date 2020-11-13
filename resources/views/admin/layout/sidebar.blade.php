<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="">
            <img src="" alt="logo" style="width: 30px;height:30px; border-radius:20px;">
            <h5 class="logo-text"></h5>
        </a>
    </div>
    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
            <li class="{{ Route::currentRouteNamed('') ? 'active ' : '' }}">
            <a href="{{route('dashboard')}}" class="waves-effect ">
                    <i class="ti-home "></i> <span>Dashboard</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('truck.brand') ? 'active ' : '' }}">
            <a href="{{route('truck.brand')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Truck Brand</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('truck.model') ? 'active ' : '' }}">
            <a href="{{route('truck.model')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Truck Models </span>
                </a>

            </li>

            <li class="{{ Route::currentRouteNamed('product.category') ? 'active ' : '' }}">
            <a href="{{route('product.category')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Product Category</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('product.size') ? 'active ' : '' }}">
            <a href="{{route('product.size')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Product Size</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('product.type') ? 'active ' : '' }}">
            <a href="{{route('product.type')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Product Type</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('packaging.style') ? 'active ' : '' }}">
            <a href="{{route('packaging.style')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Packaging Style</span>
                </a>

            </li>
            {{-- <li class="{{ Route::currentRouteNamed('truck.type') ? 'active ' : '' }}">
            <a href="{{route('truck.type')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Truck Type</span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('truck.size') ? 'active ' : '' }}">
            <a href="{{route('truck.size')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Truck Size</span>
                </a>

            </li> --}}
            <li class="{{ Route::currentRouteNamed('driving.year') ? 'active ' : '' }}">
            <a href="{{route('driving.year')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Driving Year </span>
                </a>

            </li>
            <li class="{{ Route::currentRouteNamed('license.plate.color') ? 'active ' : '' }}">
            <a href="{{route('license.plate.color')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>License Plate Color</span>
                </a>

            </li>
            {{-- <li class="{{ Route::currentRouteNamed('carrier.length') ? 'active ' : '' }}">
            <a href="{{route('carrier.length')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Carrier Lenght </span>
                </a>

            </li> --}}
            {{-- <li class="{{ Route::currentRouteNamed('truck.requirements') ? 'active ' : '' }}">
            <a href="{{route('truck.requirements')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Truck Requirements </span>
                </a>

            </li> --}}
            {{-- <li class="{{ Route::currentRouteNamed('') ? 'active ' : '' }}">
            <a href="{{route('')}}" class="waves-effect">
                    <i class="ti-package"></i>
                    <span>Product </span>
                </a>

            </li> --}}


    </ul>

</div>
