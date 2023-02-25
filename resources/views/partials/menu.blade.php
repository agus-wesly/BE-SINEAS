<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route('admin.home') }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'c-show' : '' }} {{ request()->is('admin/roles*') ? 'c-show' : '' }} {{ request()->is('admin/users*') ? 'c-show' : '' }} {{ request()->is('admin/provinces*') ? 'c-show' : '' }} {{ request()->is('admin/cities*') ? 'c-show' : '' }} {{ request()->is('admin/districts*') ? 'c-show' : '' }} {{ request()->is('admin/villages*') ? 'c-show' : '' }} {{ request()->is('admin/post-codes*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.permissions.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.roles.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.users.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('province_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.provinces.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/provinces') || request()->is('admin/provinces/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.province.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('city_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.cities.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/cities') || request()->is('admin/cities/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.city.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('district_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.districts.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/districts') || request()->is('admin/districts/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.district.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('village_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.villages.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/villages') || request()->is('admin/villages/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.village.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('post_code_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.post-codes.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/post-codes') || request()->is('admin/post-codes/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.postCode.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('user_management_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'c-show' : '' }} {{ request()->is('admin/roles*') ? 'c-show' : '' }} {{ request()->is('admin/users*') ? 'c-show' : '' }} {{ request()->is('admin/provinces*') ? 'c-show' : '' }} {{ request()->is('admin/cities*') ? 'c-show' : '' }} {{ request()->is('admin/districts*') ? 'c-show' : '' }} {{ request()->is('admin/villages*') ? 'c-show' : '' }} {{ request()->is('admin/post-codes*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    Menu Gt
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    <li
                        class="c-sidebar-nav-dropdown {{ request()->is('admin/permissions*') ? 'c-show' : '' }} {{ request()->is('admin/roles*') ? 'c-show' : '' }} {{ request()->is('admin/users*') ? 'c-show' : '' }} {{ request()->is('admin/provinces*') ? 'c-show' : '' }} {{ request()->is('admin/cities*') ? 'c-show' : '' }} {{ request()->is('admin/districts*') ? 'c-show' : '' }} {{ request()->is('admin/villages*') ? 'c-show' : '' }} {{ request()->is('admin/post-codes*') ? 'c-show' : '' }}">
                        <a class="c-sidebar-nav-dropdown-toggle" href="#">
                            <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                            </i>
                            Product
                        </a>
                        <ul class="c-sidebar-nav-dropdown-items">
                            @can('permission_access')
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ route('admin.kategori.index') }}"
                                       class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                        </i>
                                        Kategori
                                    </a>
                                </li>
                                <li class="c-sidebar-nav-item">
                                    <a href="{{ route('admin.product-dc.index') }}"
                                       class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                        <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                        </i>
                                        Barang
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.transaction-dc.index') }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                Transaksi
                            </a>
                        </li>
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.invoice-dc') }}"
                               class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                Receving
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('menu_md_access')
            <li
                class="c-sidebar-nav-dropdown {{ request()->is('admin/suppliers*') ? 'c-show' : '' }} {{ request()->is('admin/kantors*') ? 'c-show' : '' }} {{ request()->is('admin/gudangs*') ? 'c-show' : '' }} {{ request()->is('admin/pemiliks*') ? 'c-show' : '' }} {{ request()->is('admin/kontak-people*') ? 'c-show' : '' }} {{ request()->is('admin/taxes*') ? 'c-show' : '' }} {{ request()->is('admin/products*') ? 'c-show' : '' }} {{ request()->is('admin/categories*') ? 'c-show' : '' }} {{ request()->is('admin/product-categories*') ? 'c-show' : '' }} {{ request()->is('admin/product-informations*') ? 'c-show' : '' }} {{ request()->is('admin/supplier-details*') ? 'c-show' : '' }} {{ request()->is('admin/order-suppliers*') ? 'c-show' : '' }} {{ request()->is('admin/order-suplier-details*') ? 'c-show' : '' }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.menuMd.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('supplier_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.suppliers.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/suppliers') || request()->is('admin/suppliers/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.supplier.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kantor_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.kantors.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/kantors') || request()->is('admin/kantors/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kantor.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('gudang_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.gudangs.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/gudangs') || request()->is('admin/gudangs/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-store c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.gudang.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('pemilik_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.pemiliks.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/pemiliks') || request()->is('admin/pemiliks/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.pemilik.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('kontak_person_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.kontak-people.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/kontak-people') || request()->is('admin/kontak-people/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-user-circle c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.kontakPerson.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('tax_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.taxes.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/taxes') || request()->is('admin/taxes/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.tax.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.products.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.categories.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.category.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.product-categories.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/product-categories') || request()->is('admin/product-categories/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_information_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.product-informations.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/product-informations') || request()->is('admin/product-informations/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productInformation.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('supplier_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.supplier-details.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/supplier-details') || request()->is('admin/supplier-details/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.supplierDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_supplier_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.order-suppliers.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/order-suppliers') || request()->is('admin/order-suppliers/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderSupplier.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_suplier_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route('admin.order-suplier-details.index') }}"
                                class="c-sidebar-nav-link {{ request()->is('admin/order-suplier-details') || request()->is('admin/order-suplier-details/*') ? 'c-active' : '' }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderSuplierDetail.title') }}
                            </a>
                        </li>
                    @endcan
                    {{-- @can('order_suplier_detail_access') --}}
                    <li class="c-sidebar-nav-item">
                        <a href="{{ route('admin.pembayaran-suppliers.index') }}"
                            class="c-sidebar-nav-link {{ request()->is('admin/pembayaran-suppliers') || request()->is('admin/pembayaran-suppliers/*') ? 'c-active' : '' }}">
                            <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                            </i>
                            {{ trans('cruds.pembayaran_supplier.title_singular') }}
                        </a>
                    </li>
                    {{-- @endcan --}}
                </ul>
            </li>
        @endcan
        @can('keuangan_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route('admin.keuangans.index') }}"
                    class="c-sidebar-nav-link {{ request()->is('admin/keuangans') || request()->is('admin/keuangans/*') ? 'c-active' : '' }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.keuangan.title') }}
                </a>
            </li>
        @endcan
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
