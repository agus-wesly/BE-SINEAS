<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route('dashboard') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @foreach (trans('menus') as $data)
            @php($url = ltrim($data['slug'], $data['slug'][0]) . '/*')
            <li class="{{ !empty($data["child"]) ? 'c-sidebar-nav-dropdown' : 'c-sidebar-nav-item' }}">
                <a class="{{ !empty($data["child"]) ? 'c-sidebar-nav-dropdown-toggle' : 'c-sidebar-nav-link'}} {{ request()->is($url) ? 'c-active' : '' }}" href="{{ $data['slug'] != "#" ? $data['slug'] : "#" }}">
                    <i class="{{ $data['icon'] }} c-sidebar-nav-icon">

                    </i>
                    {{ $data['title'] }}
                </a>
                @if (!empty($data['child']))
                    <ul class="c-sidebar-nav-dropdown-items">
                        @foreach ($data['child'] as $data2)
                            @php($url2 = ltrim($data2['slug'], $data2['slug'][0]) . '/*')
                            <li class="{{ !empty($data2["child"]) ? 'c-sidebar-nav-dropdown' : 'c-sidebar-nav-item' }}">
                                <a class="{{ !empty($data2["child"]) ? 'c-sidebar-nav-dropdown-toggle' : 'c-sidebar-nav-link'}} {{ request()->is($url2) ? 'c-active' : '' }}" href="{{ $data2['slug'] != "#" ? $data2['slug'] : "#" }}">
                                    <i class="{{ $data2['icon'] }} c-sidebar-nav-icon">

                                    </i>
                                    {{ $data2['title'] }}
                                </a>
                                @if (!empty($data2['child']))
                                    <ul class="c-sidebar-nav-dropdown-items">
                                        @foreach ($data2['child'] as $data3)
                                            @php($url3 = ltrim($data3['slug'], $data3['slug'][0]) . '/*')
                                            <li class="c-sidebar-nav-item">
                                                <a class="c-sidebar-nav-link {{ request()->is($url3) ? 'c-active' : '' }}" href="{{ $data3['slug'] != "#" ? $data3['slug'] : "#" }}">
                                                    <i class="{{ $data3['icon'] }} c-sidebar-nav-icon">

                                                    </i>
                                                    {{ $data3['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
        @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}"
                        href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link"
                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
