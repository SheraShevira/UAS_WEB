@extends('layouts.app')

@section('content')
    <a href="{{ route('product.create') }}" class="text-decoration-none text-light"><button type="button"
            class="btn btn-primary mt-3 ms-4 shadow-none border-0 px-4 py-3">ADD NEW</button></a>
    @include('layouts.header')
    <div class="main mx-4 p-5">
        <table id="data" class="display pt-2" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Jenis Produk</th>
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Created At</th>
                    <th>Update At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->jenisProduk }}</td>
                        <td>{{ $data->descProduk }}</td>
                        <td><img src="/image/{{ $data->image }}" class="imgProduct"></td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->updated_at }}</td>
                        <td><a href="{{ route('product.edit', $data->id) }}"><button type="button"
                                    class="btn btn-primary rounded p-4 py-2 mt-2"><i
                                        class="bi bi-pencil-square"></i></button></a>
                            <form action="{{ route('product.destroy', $data->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Apakah anda yakin? anda ingin menghapus ini?');" type="button"
                                    class="btn btn-danger rounded p-4 py-2 mt-2"><i class="bi bi-trash"></i></i>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
