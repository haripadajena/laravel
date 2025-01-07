<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel Crud

Here, you will learn how to build a Laravel 10 CRUD application. This guide is designed for beginners to help you create a simple CRUD application in Laravel 10. It’s a straightforward example to demonstrate the process of implementing Create, Read, Update, and Delete functionalities in Laravel.

Alright, let’s dive into the steps!

CRUD is an acronym commonly used in computer programming, representing the four essential functions needed to implement persistent storage in an application: Create, Read, Update, and Delete.

In this example, we will build a product CRUD application using Laravel 10. We will start by creating a products table with name and detail columns using Laravel 10 migrations. Then, we will set up routes, a controller, views, and model files for the product module.

We will use bootstrap 4 for interactive and responsive design.

## Step for Laravel 10 CRUD

Step 1:- [Install Laravel 10].
Step 2:- [Database Configuration].
Step 3:- [Create Migration].
Step 4:- [Create Controller and Model].
Step 5:- [Add Resource Route].
Step 6:- [Add Blade Files].

Laravel is accessible, powerful, and provides tools required for large, robust applications.



## Step 1 Install Laravel 10 App

```bash
composer create-project laravel/laravel laravel-10-crud "10.*"
```
## Step 2 Database Configuration

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(laravel_crud)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)
```
## Step 3 Create Migration

```bash
php artisan make:migration create_products_table --create=products
```
```bash
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('detail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

```
```bash
php artisan migrate
```

## Step 4 Create Controller and Model

```bash
php artisan make:controller ProductController --resource --model=Product
```

```bash
After the bellow command, you will find a new file in this path "app/Http/Controllers/ProductController.php".

In this controller will create seven methods by default as bellow methods:
1)index()
2)create()
3)store()
4)show()
5)edit()
6)update()
7)destroy()
```
app/Http/Controllers/ProductController.php

```bash
<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

  

class ProductController extends Controller

{

    /**

     * Display a listing of the resource.

     */

    public function index(): View

    {
        $products = Product::latest()->paginate(5);
        return view('products.index',compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**

     * Show the form for creating a new resource.

     */

    public function create(): View
    {
        return view('products.create');
    }
    /**

     * Store a newly created resource in storage.

     */

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);

        Product::create($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');

    }

    /**

     * Display the specified resource.

     */

    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }
    /**

     * Show the form for editing the specified resource.

     */

    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }
    /**

     * Update the specified resource in storage.

     */

    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
        $product->update($request->all());
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');

    }

    /**

     * Remove the specified resource from storage.

     */

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');

    }

}
```
app/Models/Product.php

```bash

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
}

```

## Step 5 Add Resource Route
routes/web.php

```bash
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::resource('products', ProductController::class);
```
## Step 6 Add Blade Files


In last step. In this step we have to create just blade files. So mainly we have to create new folder "products" then create blade files of crud app so on.

- **[1.layout.blade.php]**
- **[2.index.blade.php]**
- **[3.create.blade.php]**
- **[4.edit.blade.php]**
- **[5.show.blade.php]**


So let's just create following file and put bellow code.

## resources/views/products/layout.blade.php
```bash
<!DOCTYPE html>
<html>
<head>

    <title>Laravel 10 CRUD Application - Haripada Jena</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>
<div class="container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


```

## resources/views/products/index.blade.php

```bash
@extends('products.layout')

@section('content')
    <div class="row mb-4 mt-5">
            <div class="col-sm-8">
                <h2>Laravel 10 CRUD -by Haripada Jena</h2>
            </div>
            <div class="col-sm-4 text-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Message ! </strong>{{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->detail }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $products->links('pagination::bootstrap-5') }}

@endsection
```

## resources/views/products/create.blade.php

```bash
@extends('products.layout')

  

@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Product</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

        </div>

    </div>

</div>  

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('products.store') }}" method="POST">

    @csrf
     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                <input type="text" name="name" class="form-control" placeholder="Name">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Detail:</strong>

                <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

</form>

@endsection
```

## resources/views/products/edit.blade.php

```bash
@extends('products.layout')

   

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Edit Product</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    @if ($errors->any())

        <div class="alert alert-danger">

            <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

  

    <form action="{{ route('products.update',$product->id) }}" method="POST">

        @csrf

        @method('PUT')

   

         <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Name:</strong>

                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">

                <div class="form-group">

                    <strong>Detail:</strong>

                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>

                </div>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">

              <button type="submit" class="btn btn-primary">Update</button>

            </div>

        </div>
    </form>

@endsection
```

## resources/views/products/show.blade.php

```bash
@extends('products.layout')

@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Product</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $product->name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Details:</strong>

                {{ $product->detail }}

            </div>

        </div>

    </div>

@endsection
```
## Run Laravel Application
To run the Laravel application, you can use the following command in your terminal:
Note:You shoud go application folder 
```bash
php artisan serve
```
Now, Go to your web browser, type the given URL and view the app output:
```bash
Read Also: Laravel 10 REST API with Passport Authentication Tutorial
http://localhost:8000/products
```
## Screenshot Index Page

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/1.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Screenshot Create Page

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/2.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Screenshot Edit Page

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/3.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Screenshot Single View Page

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/4.PNG" alt="Description" style="max-width: 100%; height: auto;"/>
