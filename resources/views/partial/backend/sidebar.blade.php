@php
    $current_page = \Route::currentRouteName();
@endphp
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{config('app.name')}}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @role(['admin'])
        @foreach($admin_side_menu as $menu)
            @if(count($menu->appearedChildren) == 0)
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{$menu->id == getParentShowOf($current_page) ? 'active' : null}}">
                    <a class="nav-link" href="{{route('admin.'. $menu->as)}}">
                        <i class="{{$menu->icon != null ? $menu->icon : 'fas fa-home'}}"></i>
                        <span>{{$menu->display_name}}</span></a>
                </li>
            @else
                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link {{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'active' : null}}{{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'collapsed' : null}} " href="#" data-toggle="collapse" data-target="#collapse_{{$menu->route}}" aria-expanded="{{$menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? false : true}}" aria-controls="collapse_{{$menu->route}}">
                        <i class="{{$menu->icon != null ? $menu->icon : 'fas fa-home'}}"></i>
                        <span>{{$menu->display_name}}</span>
                    </a>
                    @if($menu->appearedChildren != '' && count($menu->appearedChildren) > 0)
                        <div id="collapse_{{$menu->route}}" class="collapse {{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'show' : null}}" aria-labelledby="heading_{{$menu->route}}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @foreach($menu->appearedChildren as $sub_menu)
                                   <a class="collapse-item {{getParentOf($current_page) != '' && (int) (getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : ''}}" href="{{route('admin.' . $sub_menu->as)}}">{{$sub_menu->display_name}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </li>
            @endif
        @endforeach
    @endrole

    @role(['supervisor'])
    @foreach($admin_side_menu as $menu)
        @permission($menu->name)
            @if(count($menu->appearedChildren) == 0)
            <!-- Nav Item - Dashboard -->
                <li class="nav-item {{$menu->id == getParentShowOf($current_page) ? 'active' : null}}">
                    <a class="nav-link" href="{{route('admin.'. $menu->as)}}">
                        <i class="{{$menu->icon != null ? $menu->icon : 'fas fa-home'}}"></i>
                        <span>{{$menu->display_name}}</span></a>
                </li>
            @else
            <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link {{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'active' : null}}{{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'collapsed' : null}} " href="#" data-toggle="collapse" data-target="#collapse_{{$menu->route}}" aria-expanded="{{$menu->parent_show == getParentOf($current_page) && getParentOf($current_page) != '' ? false : true}}" aria-controls="collapse_{{$menu->route}}">
                        <i class="{{$menu->icon != null ? $menu->icon : 'fas fa-home'}}"></i>
                        <span>{{$menu->display_name}}</span>
                    </a>
                    @if($menu->appearedChildren != '' && count($menu->appearedChildren) > 0)
                        <div id="collapse_{{$menu->route}}" class="collapse {{in_array($menu->parent_show,[getParentShowOf($current_page),getParentOf($current_page)])? 'show' : null}}" aria-labelledby="heading_{{$menu->route}}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @foreach($menu->appearedChildren as $sub_menu)
                                    @permission($sub_menu->name)
                                       <a class="collapse-item {{getParentOf($current_page) != '' && (int) (getParentIdOf($current_page)+1) == $sub_menu->id ? 'active' : ''}}" href="{{route('admin.' . $sub_menu->as)}}">{{$sub_menu->display_name}}</a>
                                    @endpermission
                                @endforeach
                            </div>
                        </div>
                    @endif
                </li>
            @endif
        @endpermission
    @endforeach
    @endrole
</ul>
