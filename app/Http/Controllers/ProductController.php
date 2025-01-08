<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Account;
use App\Models\Product;
use App\Rules\WordCount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ProductController extends Controller
{

    public function index() {
        //$competitors = Competitor::all();

        $products = Product::withSum('deals', 'amount')->get();
        // return $products;
        return Inertia::render('Product/Index',['products' => $products]);

    }

    public function showEditProduct($id) {
        $product = Product::find($id);
        return Inertia::render('Product/Edit',compact('product'));
    }


    public function showAddProduct() {
        return Inertia::render('Product/Add');
    }


    public function submitAddProduct(Request $request) {

        // $file = $request->file('file');

        // $fileName = $file->getClientOriginalName();
        // $extension = $file->getClientOriginalExtension();
        // $mimeType = $file->getMimeType();
        // $size = $file->getSize();
        // $tempPath = $file->getPathname();
    
        // return response()->json([
        //     'name' => $fileName,
        //     'extension' => $extension,
        //     'mime_type' => $mimeType,
        //     'size' => $size,
        //     'temp_path' => $tempPath,
        // ]);

        $incomingFields=$request->validate([
            'name'=>'required|string|max:255',
            'description' => 'required|string|max:3000',
            'target_type' => 'required|string|max:255',
            'target_amount' => 'required|numeric|digits_between:1,20',
            'status' => ['required','string','max:255'],
            'file' => 'nullable|image|mimes:jpeg,webp,png,jpg,gif,svg|max:2048',

            
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        $incomingFields['name']=strip_tags($incomingFields['name']);
        $incomingFields['status']=strip_tags($incomingFields['status']);
        $incomingFields['target_type']=strip_tags($incomingFields['target_type']);
        $incomingFields['target_amount']=strip_tags($incomingFields['target_amount']);
        $incomingFields['description']=strip_tags($incomingFields['description']);
        
      
       
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('images', 'public');
            $incomingFields['image'] = $path;
        }
        // return $path;
        
        
        //$incomingFields['image']='';

        //return $request['image'];
        

        Product::create($incomingFields);

        return redirect('/products')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Product added successfully'
            ]
        ]);
    }

    public function showDeleteProduct($id) {
        $product = Product::find($id);
        return Inertia::render('Product/Delete', ['product' => $product]);
    }

    public function deleteProduct($id) {
        $product = Product::find($id);
        $product->delete();
        // return redirect('/listproducts');
        return redirect('/products')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ]
        ]);
    }


    public function submitEditProduct($id,Request $request) {
        $product = Product::find($id);
        $incomingFields=$request->validate([
            // 'account_id'=>'required|numeric|digits_between:1,20|exists:visits,id',
            
            'name'=>'required|string|max:255',
            'status'=>'required|string|max:255',
            'target_type' => 'required|string|max:255',
            'target_amount' => 'required|numeric|digits_between:1,20',
            'description' => ['required', 'string', new WordCount(300)], 
        
        ]);
        //'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'        
        //$incomingFields['image']='';

        //return $request['image'];
        $product->update($incomingFields);

        // return redirect('/listproducts');
        return redirect('/products')->with([
            'flash' => [
                'status' => 'success',
                'message' => 'Product edited successfully'
            ]
        ]);
    }
}
