<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Helper\FirebaseHelper;
use App\Product;
use App\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Validation\ValidationException;
use App\Helper\ImageManager;

class ProductsController extends Controller
{
    use ImageManager;
    use FirebaseHelper;
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view('products.index', [
            "products" => Product::latest()->paginate()
        ]);
    }

    public function create()
    {
        return view('products.create', [
            "categories" => ProductCategory::all()
        ]);
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validator =  Product::validate($request->all());
        if ($validator->fails()){
            return redirect('products/create')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();
            $path = storage_path('images/');
            !is_dir($path) && mkdir($path, 0777, true);

            if($file = $request->file('image')) {
                $fileData = $this->uploads($file,$path);

                $data = [
                    'imageUrl' => 'storage/'.$fileData['filePath'],
                    'imageSize' =>  $fileData['fileSize'],
                    'imageType' => $fileData['fileType'],
                    'name' => $validator->validated()['name'],
                    'price' => $validator->validated()['price'],
                    'weight' => $validator->validated()['weight'],
                    'weight_unit' => $validator->validated()['weight_unit'],
                    'description' => $validator->validated()['description'],
                    'category_id' => $validator->validated()['category_id'],
                ];

                $product = Product::create($data);
                DB::commit();

                $payload = [];
                $payload['title'] = 'New Fishes Available';
                $payload['message'] = 'You can drop any message here';
                $payload['body'] = 'New Fishes Available, Place your order now';

                //SEND GOOGLE CLOUD MESSAGE (NOTIFICATION TO ALL THE DEVICES)
                $customer_devices = Customer::select('device_id')->get();
                $devices = [];
                foreach ($customer_devices as $device){
                    $devices[] = $device['device_id'];
                }

                $this->pushNotification($devices,$payload);
                $request->session()->flash('product.name', $product->name);
                return redirect()->route('products.index');
            }

        } catch (ValidationException $e) {
            // VALIDATION EXCEPTION RETURN TO PRODUCTS PAGE.
            return redirect('products/create')
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function show(Product $product)
    {
        return view('products.show', [
            "product" => $product
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $product->update($request->all());

        $request->session()->flash('product.name', $product->name);

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

        // Redirect back or return a response as needed
        //return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
