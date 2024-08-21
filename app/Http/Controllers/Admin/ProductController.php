<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Services\Product\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function create(){
        return view('admin.product.add', [
            'title' => 'Thêm sản phẩm mới',
            'categories' => $this->productService->getCategories()
        ]);
    }
    public function store(CreateFormRequest $request)
    {
        $result = $this -> productService->create($request);
        return redirect()->back();
    }
    public function index()
    {
        $list = Product::paginate(10);
        return view('admin.product.list',[
            'title' => 'Danh sach muc moiw nhat',
            'list' => Product::paginate(10)
        ]);

    }

}
