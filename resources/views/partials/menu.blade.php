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
            <li
                class="nav-item nav-dropdown {{ request()->is('admin/permissions/*') || request()->is('admin/roles/*') || request()->is('admin/users/*') ? 'open' : '' }}">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}"
                            class="nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-unlock-alt nav-icon">

                            </i>
                            {{ trans('cruds.permission.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}"
                            class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-briefcase nav-icon">

                            </i>
                            {{ trans('cruds.role.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}"
                            class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-user nav-icon">

                            </i>
                            {{ trans('cruds.user.title') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan

            @can('product_category_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.product-categories.index") }}"
                        class="nav-link {{ request()->is('admin/product-categories') || request()->is('admin/product-categories/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-list nav-icon">

                        </i>
                        {{ trans('cruds.productCategory.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('author_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.authors.index") }}" class="nav-link {{ request()->is('admin/authors') || request()->is('admin/authors/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon">

                        </i>
                        {{ trans('cruds.author.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('license_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.licenses.index") }}" class="nav-link {{ request()->is('admin/licenses') || request()->is('admin/licenses/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon">

                        </i>
                        {{ trans('cruds.license.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('support_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.supports.index") }}" class="nav-link {{ request()->is('admin/supports') || request()->is('admin/supports/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-briefcase nav-icon">

                        </i>
                        {{ trans('cruds.support.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('product_management_access')
            <li
                class="nav-item nav-dropdown {{ request()->is('admin/product-categories/*') || request()->is('admin/product-tags/*') || request()->is('admin/products/*') ? 'open' : '' }}">
                <a class="nav-link  nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-shopping-cart nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="nav-dropdown-items">

                    @can('product_tag_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.product-tags.index") }}"
                            class="nav-link {{ request()->is('admin/product-tags') || request()->is('admin/product-tags/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-tag nav-icon">

                            </i>
                            {{ trans('cruds.productTag.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('level_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.levels.index") }}" 
                            class="nav-link {{ request()->is('admin/levels') || request()->is('admin/levels/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-plus nav-icon">

                            </i>
                            {{ trans('cruds.level.title') }}
                        </a>
                    </li>
                    @endcan
                    @can('product_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.products.index") }}"
                            class="nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active' : '' }}">
                            <i class="fa-fw fas fa-shopping-cart nav-icon">

                            </i>
                            {{ trans('cruds.product.title') }}
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            
            @can('book_access')
            <!-- <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/books') || request()->is('admin/books/*') ? 'active' : '' }}"
                    href="{{ route('admin.books.index') }}">
                    <i class="fa-fw fas fa-book nav-icon">
                    </i>
                    {{ trans('global.book') }}
                </a>
            </li> -->
            @endcan

            @can('review_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.reviews.index") }}" class="nav-link {{ request()->is('admin/reviews') || request()->is('admin/reviews/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-comments nav-icon">

                        </i>
                        {{ trans('cruds.review.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('slider_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.sliders.index") }}" class="nav-link {{ request()->is('admin/sliders') || request()->is('admin/sliders/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-plus nav-icon">

                        </i>
                        {{ trans('cruds.slider.title') }}
                    </a>
                </li>
            </li>
            @endcan

            @can('popup_access')
            <li class="nav-item nav-dropdown">
                <li class="nav-item">
                    <a href="{{ route("admin.popups.index") }}" class="nav-link {{ request()->is('admin/popups') || request()->is('admin/popups/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-plus nav-icon">

                        </i>
                        {{ trans('cruds.popup.title') }}
                    </a>
                </li>
            </li>
            @endcan
            
            @can('setting_create')
            <li class="nav-item">
                <a href="{{ route('admin.settings.create') }}"
                    class="nav-link {{ request()->is('admin/settings') || request()->is('admin/settings/*') ? 'active' : '' }}">
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
