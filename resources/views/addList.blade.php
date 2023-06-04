@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="main mx-4 px-5 py-5">
        <form action="/product" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3 mt-4">
                <input type="text" name="jenisProduk" value="{{ old('jenisProduk') }}" class="form-control no-decoration"
                    required autofocus placeholder="Jenis Produk">
                <label>Jenis Produk</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control no-decoration" required placeholder="Deskripsi Produk" style="height: 70px"
                    name="descProduk">{{ old('descProduk') }}</textarea>
                <label>Deskripsi</label>
            </div>
            <div class="mb-3">
                <label class="form-label ms-3">Gambar</label>
                <input class="form-control" required type="file" accept="image/*" name="image"
                    value="{{ old('image') }}">
            </div>
            <div class="btn-group mt-2" role="group">
                <button type="submit" class="btn btn-secondary me-3 rounded p-4 py-2">Save</button>
                <a href="{{ redirect()->back()->getTargetUrl() }}"><button type="button"
                        class="btn btn-danger rounded p-4 py-2">Back</button></a>
            </div>
        </form>
    </div>
@endsection
