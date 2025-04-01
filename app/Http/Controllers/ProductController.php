<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Product::latest()->paginate(5);

        return view('produto.index',compact('produtos'))
            ->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required',
            'detail' => 'required',
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')
                        ->with('Sucesso','Produto criado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Produto
     * @return \Illuminate\Http\Response
     */
    public function show(Product $produto)
    {
        return view('produto.show',compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $produto)
    {
        return view('produto.edit',compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $produto)
    {
        $request->validate([
            'descricao' => 'required',
            'detail' => 'required',
        ]);

        $produto->update($request->all());

        return redirect()->route('produto.index')
                        ->with('Sucesso','Produto editado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $produto)
    {
        $produto->delete();

        return redirect()->route('produto.index')
                        ->with('Sucesso','Produto deletado com sucesso');
    }
}
