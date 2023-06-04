<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class itemListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('itemList', [
            "title" => "All Product",
            "datas" => Product::orderBy('updated_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addList', [
            "title" => "Add New Product"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenisProduk' => 'required',
            'descProduk' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'jenisProduk.required' => 'Jenis produk tidak boleh kosong!',
            'descProduk.required' => 'Deskripsi produk tidak boleh kosong!',
            'img.required' => 'Gambar produk tidak boleh kosong!',
            'image.image' => 'Gambar produk harus file image!',
            'image.mines' => 'Gambar produk harus file dengan format jpg, png, jpeg!',
            'image.max' => 'Size file Gambar tidak boleh lebih dari 2MB!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            DB::transaction(function () use ($request) {
                if ($image = $request->file('image')) {
                    $path = 'image/';
                    $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $productImage = $imageName . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($path, $productImage);
                }

                Product::create([
                    'jenisProduk'     => $request->jenisProduk,
                    'descProduk'   => $request->descProduk,
                    'image'     => $productImage
                ]);
            });

            return redirect('/')->with(['success' => 'Data berhasil ditambah!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('products')->where('id', $id)->get();
        return view('editList', [
            "title" => "Edit Product",
            "datas" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'jenisProduk' => 'required',
            'descProduk' => 'required',
            'newImage' => 'image|mimes:jpeg,png,jpg|max:2048'
        ], [
            'jenisProduk.required' => 'Jenis produk tidak boleh kosong!',
            'descProduk.required' => 'Deskripsi produk tidak boleh kosong!',
            'image.image' => 'Gambar produk harus file image!',
            'image.mines' => 'Gambar produk harus file dengan format jpg, png, jpeg!',
            'image.max' => 'Size file Gambar tidak boleh lebih dari 2MB!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors(['msg' => $validator->errors()->all()]);
        }

        if ($validator->passes()) {
            if (is_null($request->newImage)) {
                Product::findOrFail($id)->update([
                    'jenisProduk'     => $request->jenisProduk,
                    'descProduk'   => $request->descProduk
                ]);
            } else {
                if ($image = $request->file('newImage')) {
                    $path = 'image/';
                    $imageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $productImage = $imageName . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                    $image->move($path, $productImage);
                }

                Product::findOrFail($id)->update([
                    'jenisProduk'     => $request->jenisProduk,
                    'descProduk'   => $request->descProduk,
                    'image'     => $productImage
                ]);

                unlink("image/" . $request->oldImage);
            }

            return redirect('/')->with(['success' => 'Data berhasil diubah!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        unlink("image/" . $product->image);

        Product::findOrFail($id)->delete();

        return redirect('/')->with(['success' => 'Data berhasil dihapus!']);
    }
}
