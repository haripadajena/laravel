<?php

namespace App\Http\Controllers;

use App\Models\ProductAjax;
use Illuminate\Http\Request;
use DataTables;

class ProductAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductAjax::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

        }
        return view('products.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)

    {
        ProductAjax::updateOrCreate([
                    'id' => $request->product_id
                ],

                [
                    'name' => $request->name, 
                    'detail' => $request->detail
                ]);        
        return response()->json(['success'=>'Product saved successfully.']);

    }

    /**
     * Display the specified resource.
     */
    public function show(ProductAjax $productAjax)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = ProductAjax::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductAjax $productAjax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ProductAjax::find($id)->delete();
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}
