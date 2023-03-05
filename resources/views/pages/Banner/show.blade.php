@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supplier.title') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="container col-6">
                {{-- Data Supplier --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data Supplier</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Input Nama Supplier --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Supplier</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Dropdown Status --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- Input Telpon --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telpon</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Email PO --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email PO</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Alamat --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Provinsi --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Provinsi</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Kota --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kota</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Kode POS --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode POS</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Selected Kategori --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kategori</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- Selected Tipe Pengiriman --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Tipe Pengiriman</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- Selected Pembayaran --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pembayaran</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Data PIC --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data PIC</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Input Nama PIC --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama PIC</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Foto KTP--}}
                            <div class="form-group">
                                <label for="foto_warung" class="form-label d-block">Foto KTP</label>
                                {{-- <img width="130" height="130" class="img-fluid img-thumbnail" alt="foto warung"> --}}
                            </div>
                            {{-- Input Telpon --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telpon</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Email PO --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email PO</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Data Pembayaran --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data Pembayaran</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Kredit Limit --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kredit Limit</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Nominal Minimum Pengiriman --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nominal Minimum Pengiriman</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Minimun Order --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Minimum Order</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Tambah Rek --}}
                            <div class="form-group">
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
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data Gudang</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Input Telpon --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">No Telpon</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Email PO --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email PO</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Alamat --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Provinsi --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Provinsi</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Kota --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kota</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Input Kode POS --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode POS</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Informasi Produk --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Informasi Produk</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Merk Produk --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Merk Produk</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Status --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- Jangka Waktu Kirem --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Jangka Waktu Kirim</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Hari Order --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- Hari Kirim --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Data Pajak --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data Pajak</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Pajak --}}
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Pajak</label>
                                <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                    <option selected>Pilih</option>
                                    <option value="1">D</option>
                                    <option value="2">R</option>
                                </select>
                            </div>
                            {{-- No NPWP --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">No NPWP</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Alamat Pajak --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Alamat Pajak</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- No PKP --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">No PKP</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Tanggal --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Data Promosi --}}
                <div class="card">
                    <div>
                        <h5
                            style="background-color: #e2e2e2;padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            Data Promosi</h5>
                        <div style="padding-left: 12px;padding-top: 8px;padding-bottom: 8px;padding-right: 12px">
                            {{-- Distribution Fee --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Distribution Fee</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            {{-- Diskon PO --}}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Diskon PO</label>
                                <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                            </div>
                            <div class="d-flex justify-content-between">
                                {{-- No PKP --}}
                                <div class="form-group flex-grow-1" style="margin-right: 10px">
                                    <label for="exampleInputEmail1">Min Order Diskon</label>
                                    <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                                </div>
                                {{-- Tanggal --}}
                                <div class="form-group flex-grow-1">
                                    <label for="exampleInputEmail1">Diskon PO</label>
                                    <input type="email" class="form-control" id="inputSupplier" aria-describedby="supplierHelp">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" href="{{ route('admin.suppliers.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
        {{-- <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.id') }}
                        </th>
                        <td>
                            {{ $supplier->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.name') }}
                        </th>
                        <td>
                            {{ $supplier->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $supplier->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.address') }}
                        </th>
                        <td>
                            {{ $supplier->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.ktp_photo') }}
                        </th>
                        <td>
                            @if($supplier->ktp_photo)
                                <a href="{{ $supplier->ktp_photo }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $supplier->ktp_photo }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.post_code') }}
                        </th>
                        <td>
                            {{ $supplier->post_code->code ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.store_photo') }}
                        </th>
                        <td>
                            @foreach($supplier->store_photo as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.password') }}
                        </th>
                        <td>
                            ********
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.channel') }}
                        </th>
                        <td>
                            {{ App\Models\Supplier::CHANNEL_SELECT[$supplier->channel] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supplier.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Supplier::STATUS_SELECT[$supplier->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.suppliers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div> --}}
    </div>
</div>

{{-- <div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#supplier_kantors" role="tab" data-toggle="tab">
                {{ trans('cruds.kantor.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#post_code_gudangs" role="tab" data-toggle="tab">
                {{ trans('cruds.gudang.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_pemiliks" role="tab" data-toggle="tab">
                {{ trans('cruds.pemilik.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_kontak_people" role="tab" data-toggle="tab">
                {{ trans('cruds.kontakPerson.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_taxes" role="tab" data-toggle="tab">
                {{ trans('cruds.tax.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_products" role="tab" data-toggle="tab">
                {{ trans('cruds.product.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#supplier_order_suppliers" role="tab" data-toggle="tab">
                {{ trans('cruds.orderSupplier.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="supplier_kantors">
            @includeIf('admin.suppliers.relationships.supplierKantors', ['kantors' => $supplier->supplierKantors])
        </div>
        <div class="tab-pane" role="tabpanel" id="post_code_gudangs">
            @includeIf('admin.suppliers.relationships.postCodeGudangs', ['gudangs' => $supplier->postCodeGudangs])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_pemiliks">
            @includeIf('admin.suppliers.relationships.supplierPemiliks', ['pemiliks' => $supplier->supplierPemiliks])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_kontak_people">
            @includeIf('admin.suppliers.relationships.supplierKontakPeople', ['kontakPeople' => $supplier->supplierKontakPeople])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_taxes">
            @includeIf('admin.suppliers.relationships.supplierTaxes', ['taxes' => $supplier->supplierTaxes])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_products">
            @includeIf('admin.suppliers.relationships.supplierProducts', ['products' => $supplier->supplierProducts])
        </div>
        <div class="tab-pane" role="tabpanel" id="supplier_order_suppliers">
            @includeIf('admin.suppliers.relationships.supplierOrderSuppliers', ['orderSuppliers' => $supplier->supplierOrderSuppliers])
        </div>
    </div>
</div> --}}

@endsection
