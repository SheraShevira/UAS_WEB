@extends('layouts.app')

@section('content')
    @include('layouts.header')
    <div class="main mx-4 px-5 py-5">
        @foreach ($datas as $data)
            <form action="{{ route('product.update', $data->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-floating mb-3 mt-4">
                    <input type="text" name="jenisProduk" value="{{ $data->jenisProduk }}" class="form-control no-decoration"
                        required placeholder="Jenis Produk">
                    <label>Jenis Produk</label>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control no-decoration" required placeholder="Deskripsi Produk" style="height: 70px"
                        name="descProduk">{{ $data->descProduk }}</textarea>
                    <label>Deskripsi</label>
                </div>
                <div class="mb-3">
                    <label class="form-label ms-3">Gambar</label>
                    <input class="form-control" type="file" accept="image/*" name="newImage">
                </div>
                <div class="mb-3">
                    <p>{{ $data->image }}</p>
                    <img src="/image/{{ $data->image }}" class="imgProduct">
                    <input type="text" hidden value="{{ $data->image }}" name="oldImage">
                </div>
                <div class="btn-group mt-2" role="group">
                    <button type="submit" class="btn btn-secondary me-3 rounded p-4 py-2">Save</button>
                    <a href="{{ redirect()->back()->getTargetUrl() }}"><button type="button"
                            class="btn btn-danger rounded p-4 py-2">Back</button></a>
                </div>
            </form>
        @endforeach
    </div>
@endsection
