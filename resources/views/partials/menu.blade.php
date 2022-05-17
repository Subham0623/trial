<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            <li class="nav-item">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
            <li class="nav-item nav-dropdown {{ request()->is('admins/permissions/*') || request()->is('admins/roles/*') || request()->is('admins/users/*') || request()->is('admins/groups/*') ? 'open' : '' }}">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('group_access')
                    <li class="nav-item {{ request()->is('admins/groups') || request()->is('admins/groups/*') ? 'active' : '' }}">
                        <a href="{{ route("admin.groups.index") }}"
                            class="nav-link ">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('cruds.group.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('permission_access')
                    <li class="nav-item {{ request()->is('admins/permissions') || request()->is('admins/permissions/*') ? 'active' : '' }}">
                        <a href="{{ route("admin.permissions.index") }}"
                            class="nav-link ">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item {{ request()->is('admins/roles') || request()->is('admins/roles/*') ? 'active' : '' }}">
                        <a href="{{ route("admin.roles.index") }}"
                            class="nav-link ">
                            <i class="fa-fw fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item {{ request()->is('admins/users') || request()->is('admins/users/*') ? 'active' : '' }}">
                        <a href="{{ route("admin.users.index") }}"
                            class="nav-link ">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('product_management_access')
            <li class="nav-item nav-dropdown {{ request()->is('admins/product-categories/*') ? 'open' : '' }}">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('product_category_access')
                        <li class="nav-item {{ request()->is('admins/product-categories') || request()->is('admins/product-categories/*') ? 'active' : '' }}">
                            <a href="{{ route("admin.product-categories.index") }}"
                                class="nav-link ">
                                <i class="fa-fw fas fa-list nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('province_access')
            <li class="nav-item {{ request()->is('admin/provinces') || request()->is('admin/provinces/*') ? 'active' : '' }}">
                <a href="{{ route('admin.provinces.index') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.province.title') }}
                </a>
            </li>
            @endcan

            @can('type_access')
            <li class="nav-item {{ request()->is('admin/types') || request()->is('admin/types/*') ? 'active' : '' }}">
                <a href="{{ route('admin.types.index') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.type.title') }}
                </a>
            </li>
            @endcan

            @can('organization_access')
            <li class="nav-item {{ request()->is('admin/organizations') || request()->is('admin/organizations/*') ? 'active' : '' }}">
                <a href="{{ route('admin.organizations.index') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.organization.title') }}
                </a>
            </li>
            @endcan
            
            @can('subject_area_access')
            <li class="nav-item {{ request()->is('admin/subject-areas') || request()->is('admin/subject-areas/*') ? 'active' : '' }}">
                <a href="{{ route('admin.subject-areas.index') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.subjectarea.title') }}
                </a>
            </li>
            @endcan

            @can('parameter_access')
            <li class="nav-item {{ request()->is('admin/parameters') || request()->is('admin/parameters/*') ? 'active' : '' }}">
                <a href="{{ route('admin.parameters.index') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.parameter.title') }}
                </a>
            </li>
            @endcan

            @can('form_access')
            <li class="nav-item {{ request()->is('admin/forms') || request()->is('admin/forms/*') ? 'active' : '' }}">
                <a href="{{ route('admin.forms') }}"
                    class="nav-link ">
                    <i class=" nav-icon fa fa-plus"></i>
                    {{ trans('cruds.form.title') }}
                </a>
            </li>
            @endcan















            
            @can('cms_access')
            <li class="nav-item nav-dropdown {{ request()->is('admins/permissions/*') || request()->is('admins/roles/*') || request()->is('admins/users/*') ? 'open' : '' }}">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.cms.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('slider_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.sliders.index") }}" class="nav-link {{ request()->is('admins/sliders') || request()->is('admins/sliders/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-plus nav-icon">

                                </i>
                                {{ trans('cruds.slider.title') }}
                            </a>
                        </li>
                    @endcan

                    @can('popup_access')
                        <li class="nav-item">
                            <a href="{{ route("admin.popups.index") }}" class="nav-link {{ request()->is('admins/popups') || request()->is('admins/popups/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-plus nav-icon">

                                </i>
                                {{ trans('cruds.popup.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('setting_create')
            <li class="nav-item">
                <a href="{{ route('admin.settings.create') }}"
                    class="nav-link {{ request()->is('admins/settings') || request()->is('admins/settings/*') ? 'active' : '' }}">
                    <i class=" nav-icon fa fa-gear"></i>
                    {{ trans('global.setting') }}
                </a>
            </li>
            @endcan

            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
            <li class="nav-item">
                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                    href="{{ route('profile.password.edit') }}">
                    <i class="fa-fw fas fa-key nav-icon">
                    </i>
                    {{ trans('global.change_password') }}
                </a>
            </li>
            @endcan
            @endif
            <li class="nav-item">
                <a href="#" class="nav-link"
                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
