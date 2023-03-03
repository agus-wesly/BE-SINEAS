@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.supplier.title_singular') }}
    </div>

    <div class="card-body">
       <form method="POST" action="{{ route("admin.suppliers.store") }}" enctype="multipart/form-data">
           @csrf
           <div class="row">
               <div class="container col-6">
                   {{-- Data Supplier --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data Supplier</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Input Nama Supplier --}}
                               <div class="form-group">
                                   <label for="name">Nama Supplier</label>
                                   <input type="text"
                                          value="{{ old('name', '') }}"
                                          class="form-control"
                                          id="name"
                                          name="name"
                                          aria-describedby="supplierHelp"
                                          placeholder="joe joe"
                                          required
                                   >
                               </div>
                               {{-- Dropdown Status --}}
                               <div class="form-group">
                                   <label for="exampleFormControlSelect1">Status</label>
                                   <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="status" required>
                                       <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                       @foreach(App\Models\Supplier::STATUS_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('status', '')  === (string) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               {{-- Input Telpon --}}
                               <div class="form-group">
                                   <label for="phone_number">No Telpon</label>
                                   <input type="text"
                                          name="phone_number"
                                          class="form-control"
                                          id="phone_number"
                                          aria-describedby="supplierHelp"
                                          value="{{ old('phone_number', '') }}"
                                          placeholder="0822xxxxx"
                                          required
                                   >
                               </div>
                               {{-- Input Email PO --}}
                               <div class="form-group">
                                   <label for="email_po">Email PO</label>
                                   <input type="email"
                                          value="{{ old('email_po', '') }}"
                                          name="email_po" class="form-control"
                                          id="email_po"
                                          aria-describedby="supplierHelp"
                                          placeholder="tawakal@gmail.com"
                                   >
                               </div>
                               {{-- Input Alamat --}}
                               <div class="form-group">
                                   <label for="address">Alamat</label>
                                   <textarea name="address" id="address" class="form-control" cols="5" rows="5"  id="address" aria-describedby="supplierHelp" required>value="{{ old('address', '') }}"</textarea>
                               </div>
                               {{-- Input Provinsi --}}
                               <div class="form-group">
                                   <label for="provinsi">Provinsi</label>
                                   <input type="text"
                                          class="form-control"
                                          id="provinsi"
                                          aria-describedby="supplierHelp"
                                          value="{{ old('provinsi', '') }}"
                                   >
                               </div>
                               {{-- Input Kota --}}
                               <div class="form-group">
                                   <label for="city">Kota</label>
                                   <input type="text"
                                          value="{{ old('city', '') }}"
                                          class="form-control"
                                          id="city"
                                          aria-describedby="supplierHelp"
                                          name="city"
                                          placeholder="Jakarta Barat"
                                          required
                                   >
                               </div>
                               {{-- Input Kode POS --}}
                               <div class="form-group">
                                   <label for="post_code_id">Kode POS</label>
                                   <input type="text"
                                          value="{{ old('post_code_id', '') }}"
                                          name="post_code_id"
                                          class="form-control"
                                          id="post_code_id"
                                          aria-describedby="supplierHelp"
                                          placeholder="1111"
                                          required
                                   >
                               </div>
                               {{-- Selected Kategori --}}
                               <div class="form-group">
                                   <label for="type_dept_category_id">Kategori</label>
                                   <select class="custom-select my-1 mr-sm-2" id="type_dept_category_id" name="type_dept_category_id">
                                       <option value disabled {{ old('type_dept_category_id', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                       @foreach(App\Models\Supplier::CATEGORY_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('type_dept_category_id', '')  === (string) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               {{-- Selected Tipe Pengiriman --}}
                               <div class="form-group">
                                   <label for="delivery_type">Tipe Pengiriman</label>
                                   <select class="custom-select my-1 mr-sm-2" name="delivery_type" id="delivery_type">
                                       <option value disabled {{ old('delivery_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                       @foreach(App\Models\Supplier::DELIVERY_TYPE_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('delivery_type', '')  === (string) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               {{-- Selected Pembayaran --}}
                               <div class="form-group">
                                   <label for="payment">Pembayaran</label>
                                   <select class="custom-select my-1 mr-sm-2" name="payment" id="payment">
                                       <option value disabled {{ old('payment', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                       @foreach(App\Models\Supplier::PAYMENT_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('payment', '')  === (int) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Data PIC --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data PIC</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Input Nama PIC --}}
                               <div class="form-group">
                                   <label for="name_pic">Nama PIC</label>
                                   <input type="text"
                                          class="form-control"
                                          name="name_pic"
                                          id="name_pic"
                                          placeholder="joe"
                                          aria-describedby="supplierHelp"
                                          value="{{ old('name_pic', '') }}"
                                   >
                               </div>
                               {{-- Foto KTP--}}
                               <div class="form-group">
                                   <label for="foto_warung" class="form-label d-block">Foto KTP</label>
                                   {{-- <img width="130" height="130" class="img-fluid img-thumbnail" alt="foto warung"> --}}
                               </div>
                               {{-- Input Telpon --}}
                               <div class="form-group">
                                   <label for="tlp">No Telpon</label>
                                   <input type="number"
                                          class="form-control"
                                          name="tlp"
                                          id="tlp"
                                          placeholder="0822xxxxxxx"
                                          aria-describedby="supplierHelp"
                                          value="{{ old('tlp', 0) }}"
                                   >
                               </div>
                               {{-- Input Email PO --}}
                               <div class="form-group">
                                   <label for="email_pic">Email PO</label>
                                   <input type="email"
                                          class="form-control"
                                          name="email_pic"
                                          id="email_pic"
                                          placeholder="joe@gmail.com"
                                          aria-describedby="supplierHelp"
                                          value="{{ old('email_pic', '') }}"
                                   >
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Data Pembayaran --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data Pembayaran</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Kredit Limit --}}
                               <div class="form-group">
                                   <label for="limit_credit">Kredit Limit</label>
                                   <input type="number" name="limit_credit" value="{{ old('limit_credit', 0) }}" class="form-control" id="limit_credit" aria-describedby="supplierHelp">
                               </div>
                               {{-- Nominal Minimum Pengiriman --}}
                               <div class="form-group">
                                   <label for="minimum_delevery">Nominal Minimum Pengiriman</label>
                                   <input type="number" name="minimum_delevery" value="{{ old('minimum_delevery', 0) }}" class="form-control" id="minimum_delevery" aria-describedby="supplierHelp">
                               </div>
                               {{-- Minimun Order --}}
                               <div class="form-group">
                                   <label for="minimum_order">Minimum Order</label>
                                   <input type="number" value="{{ old('minimum_order', 0) }}" class="form-control" id="minimum_order" aria-describedby="supplierHelp">
                               </div>
                               {{-- Tambah Rek --}}
                               <div class="form-group">
                                   <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-primary">Tambah Akun</button>
                                   <table style="margin-top: 10px" class="table">
                                       <thead>
                                       <tr>
                                           <th scope="col">Bank</th>
                                           <th scope="col">No Akun</th>
                                           <th scope="col">Nama Akun</th>
                                           <th scope="col">Aksi</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       <tr>
                                           <th scope="row">BCA</th>
                                           <td>10223111</td>
                                           <td>PT. Maju Mundur</td>
                                           <td></td>
                                       </tr>
                                       </tbody>
                                   </table>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>

               <div class="container col-6">
                   {{-- Data Gudang --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data Gudang</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Input Telpon --}}
                               <div class="form-group">
                                   <label for="telp">No Telpon</label>
                                   <input type="text" name="telp" class="form-control" id="telp" placeholder="08xxxxxxx" aria-describedby="supplierHelp", value="{{ old('telp', '') }}">
                               </div>
                               {{-- Input Email PO --}}
                               <div class="form-group">
                                   <label for="email">Email PO</label>
                                   <input type="email" value="{{ old('email', '') }}" placeholder="email@gmail.com"  name="email" class="form-control"id="email" aria-describedby="supplierHelp" required>
                               </div>
                               {{-- Input Alamat --}}
                               <div class="form-group">
                                   <label for="address">Alamat</label>
                                   <input type="text" value="{{ old('address', '') }}" placeholder="jalan xxx" class="form-control" id="address" aria-describedby="supplierHelp" required>
                               </div>
                               {{-- Input Provinsi --}}
                               <div class="form-group">
                                   <label for="Provinsi">Provinsi</label>
                                   <input type="text" name="provinsi" value="{{ old('provinsi', '') }}" class="form-control" id="Provinsi" placeholder="DKI Jakarta" aria-describedby="supplierHelp" required>
                               </div>
                               {{-- Input Kota --}}
                               <div class="form-group">
                                   <label for="exampleInputEmail1">Kota</label>
                                   <input type="text" value="{{ old('kota', '') }}" placeholder="Jakarta Barat"  class="form-control" id="kota" aria-describedby="supplierHelp" required>
                               </div>
                               {{-- Input Kode POS --}}
                               <div class="form-group">
                                   <label for="post_code_id">Kode POS</label>
                                   <input type="text" value="{{ old('gudang_post_code_id', '') }}" name="gudang_post_code_id" placeholder="11xx" class="form-control" id="post_code_id" aria-describedby="supplierHelp">
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Informasi Produk --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Informasi Produk</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Merk Produk --}}
                               <div class="form-group">
                                   <label for="merk_product">Merk Produk</label>
                                   <input type="number"
                                          class="form-control"
                                          id="merk_product"
                                          name="merk_product"
                                          aria-describedby="supplierHelp"
                                          placeholder="111xxxx"
                                          value="{{ old('merk_product', 0) }}"
                                   >
                               </div>
                               {{-- Status --}}
                               <div class="form-group">
                                   <label for="information_product_status">Status</label>
                                   <select class="custom-select my-1 mr-sm-2" id="information_product_status" name="information_product_status">
                                       <option value disabled {{ old('information_product_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                       @foreach(App\Models\Supplier::INFORMATION_PRODUCT_STATUS_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('information_product_status', '')  === (int) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               {{-- Jangka Waktu Kirem --}}
                               <div class="form-group">
                                   <label for="jangka_pengiriman">Jangka Waktu Kirim</label>
                                   <input type="number" value="{{ old('jangka_pengiriman', 0) }}" class="form-control" id="jangka_pengiriman" name="jangka_pengiriman" aria-describedby="supplierHelp">
                               </div>
                               {{-- Hari Order --}}
                               <div class="form-group">
                                   <label class="required" for="hari_order">Hari Order</label>
                                   <div style="padding-bottom: 4px">
                                       <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                       <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                   </div>
                                   <select class="form-control select2 {{ $errors->has('hari_order') ? 'is-invalid' : '' }}" name="hari_order[]" id="hari_order" multiple required>
                                       @foreach(App\Models\Supplier::DAY_SELECT as $key => $label)
                                           <option value="{{ $key }}" {{ in_array($key, old('hari_order', [])) ? 'selected' : '' }}>{{ $label }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('hari_order'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('hari_order') }}
                                       </div>
                                   @endif
                                   <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                               </div>
                               {{-- Hari Kirim --}}
                               <div class="form-group">
                                   <label class="required" for="hari_pengiriman">Hari Pengiriman</label>
                                   <div style="padding-bottom: 4px">
                                       <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                       <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                                   </div>
                                   <select class="form-control select2 {{ $errors->has('hari_pengiriman') ? 'is-invalid' : '' }}" name="hari_pengiriman[]" id="hari_pengiriman" multiple required>
                                       @foreach(App\Models\Supplier::DAY_SELECT as $key => $label)
                                           <option value="{{ $key }}" {{ in_array($key, old('hari_pengiriman', [])) ? 'selected' : '' }}>{{ $label }}</option>
                                       @endforeach
                                   </select>
                                   @if($errors->has('hari_pengiriman'))
                                       <div class="invalid-feedback">
                                           {{ $errors->first('hari_pengiriman') }}
                                       </div>
                                   @endif
                                   <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Data Pajak --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data Pajak</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Pajak --}}
                               <div class="form-group">
                                   <label for="status_tax">Pajak</label>
                                   <select class="custom-select my-1 mr-sm-2" id="status_tax" name="tax_status">
                                       @foreach(App\Models\Supplier::TYPE_TAX_SELECT as $key => $label)
                                           <option value="{{ $key }}" @selected(old('tax_status', '')  === (int) $key)>{{ $label }}</option>
                                       @endforeach
                                   </select>
                               </div>
                               {{-- No NPWP --}}
                               <div class="form-group">
                                   <label for="no_npwp">No NPWP</label>
                                   <input type="number"
                                          class="form-control"
                                          name="no_npwp"
                                          id="no_npwp"
                                          aria-describedby="supplierHelp"
                                          placeholder="11111111111"
                                          value="{{ old('no_npwp', 0) }}"
                                   >
                               </div>
                               {{-- Alamat Pajak --}}
                               <div class="form-group">
                                   <label for="tax_address">Alamat Pajak</label>
                                   <input type="text"
                                          class="form-control"
                                          name="tax_address"
                                          id="tax_address"
                                          aria-describedby="supplierHelp"
                                          placeholder="tawakal xxxx"
                                          value="{{ old('tax_address', '') }}"
                                   >
                               </div>
                               {{-- No PKP --}}
                               <div class="form-group">
                                   <label for="no_pkp">No PKP</label>
                                   <input
                                       type="number"
                                       class="form-control"
                                       id="inputSupplier"
                                       name="no_pkp"
                                       aria-describedby="supplierHelp"
                                       placeholder="111111"
                                       value="{{ old('no_pkp', 0) }}"
                                   >
                               </div>
                               {{-- Tanggal --}}
                               <div class="form-group">
                                   <label for="date ">Tanggal</label>
                                   <input type="date" class="form-control" id="date" name="date" aria-describedby="supplierHelp">
                               </div>
                           </div>
                       </div>
                   </div>
                   {{-- Data Promosi --}}
                   <div class="card">
                       <div>
                           <h5 style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">Data Promosi</h5>
                           <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                               {{-- Distribution Fee --}}
                               <div class="form-group">
                                   <label for="distribution_fee">Distribution Fee</label>
                                   <input type="number" value="{{ old('distribution_fee', 0) }}" class="form-control" name="distribution_fee" id="distribution_fee" aria-describedby="supplierHelp" required>
                               </div>
                               <div class="d-flex justify-content-between">
                                   {{-- No PKP --}}
                                   <div class="form-group flex-grow-1" style="margin-right: 10px">
                                       <label for="minimum_order_discount">Min Order Diskon</label>
                                       <input type="number" name="minimum_order_discount" value="{{ old('minimum_order_discount', 0) }}" class="form-control" id="minimum_order_discount" aria-describedby="supplierHelp">
                                   </div>
                                   {{-- Tanggal --}}
                                   <div class="form-group flex-grow-1">
                                       <label for="discount">Diskon PO</label>
                                       <input type="number" name="discount" value="{{ old('discount', 0) }}" class="form-control" id="discount" aria-describedby="supplierHelp">
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

               </div>
           </div>
           <div>
               <button style="width: 130px" type="submit" class="btn btn-success">Simpan</button>
           </div>
       </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #E4EAEF">
                        <h5 class="modal-title" id="exampleModalLabel">Akun Bank</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Bank</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">No Akun</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Nama Akun</label>
                                <input type="text" class="form-control" id="recipient-name">
                            </div>
                        </form>
                    </div>
                        <div class="modal-footer justify-content-between" style="background-color: #E4EAEF">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
