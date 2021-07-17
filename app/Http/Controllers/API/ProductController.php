<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Product;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Product as ProductResource;

class ProductController extends BaseController
{

    public function index()
    {
        $products = Product::all();
        return $this->sendResponse( $products, 'Products retrieved successfully.');

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $product = Product::create($input);
        return $this->sendResponse( $product, 'Product created successfully');

    }

    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->sendError('Product not found.');
        }
        return $this->sendResponse( $product, 'Product created successfully');

    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $this->sendResponse( $product, 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $this->sendResponse([], 'Product deleted successfully.');
    }
}
