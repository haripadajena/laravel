<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel 10 Crud with AJAX

Here, you will learn how to build a Laravel 10 CRUD with AJAX application. This guide is designed for beginners to help you create a simple CRUD application in Laravel 10. It’s a straightforward example to demonstrate the process of implementing Create, Read, Update, and Delete functionalities in Laravel.

Alright, let’s dive into the steps!

CRUD is an acronym commonly used in computer programming, representing the four essential functions needed to implement persistent storage in an application: Create, Read, Update, and Delete.

In this example, we will build a product CRUD application using Laravel 10. We will start by creating a products table with name and detail columns using Laravel 10 migrations. Then, we will set up routes, a controller, views, and model files for the product module.

We will use bootstrap 4 for interactive and responsive design.

## Step for Laravel 10 CRUD with AJAX

Step 1:- [Install Laravel 10].
Step 2:  [Install Yajra Datatable].
Step 3:- [Database Configuration].
Step 4:- [Create Migration].
Step 5:- [Create Controller and Model].
Step 6:- [Add Resource Route].
Step 7:- [Add Blade Files].
Step 8:- [Run Laravel App].
Laravel is accessible, powerful, and provides tools required for large, robust applications.



## Step 1 Install Laravel 10 App

```bash
composer create-project laravel/laravel laravel-10-crud-ajax-yajra-datatable "10.*"
```
## Step 2 Install Yajra Datatable
Download datatables via terminal.
```bash
composer require yajra/laravel-datatables:^10.0
```
Configuration- Open the file config/app.php and then add following service provider.
```bash
'providers' => [
    // ........
    ..........
    ........//
Yajra\DataTables\DataTablesServiceProvider::class,
Yajra\DataTables\ButtonsServiceProvider::class,
],

```
Publish configuration & assets of Yajra Datatable:

```bash
php artisan vendor:publish --tag=datatables

```
## Step 3 Database Configuration

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=here your database name(laravel_crud)
DB_USERNAME=here database username(root)
DB_PASSWORD=here database password(root)
```
## Step 4 Create Migration

```bash
php artisan make:migration create_product_ajaxes_table --create=product_ajaxes
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
        Schema::create('product_ajaxes', function (Blueprint $table) {
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
        Schema::dropIfExists('product_ajaxes');
    }
};

```
```bash
php artisan migrate
```

## Step 5 Create Controller and Model

```bash
php artisan make:controller ProductAjaxController --resource --model=ProductAjax
```

```bash
After the bellow command, you will find a new file in this path "app/Http/Controllers/ProductAjaxController.php".

In this controller will create seven methods by default as bellow methods:
1)index()
2)create()
3)store()
4)show()
5)edit()
6)update()
7)destroy()
```
app/Http/Controllers/ProductAjaxController.php
```bash
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

```
app/Models/ProductJax.php
```bash

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAjax extends Model
{
    use HasFactory;
    protected $guarded = [];
}

```


## Step 6 Add Resource Route
routes/web.php

```bash
<?php

use App\Http\Controllers\ProductAjaxController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products-ajax-crud', ProductAjaxController::class);

```
## Step 7 Add Blade Files


In last step. In this step we have to create just blade files. So mainly we have to create new folder "products" then create blade files of crud app so on.

- **[1.layout.blade.php]**
- **[2.index.blade.php]**



So let's just create following file and put bellow code.

## resources/views/products/layout.blade.php
Note: Donn't forget add all resources in public folder
public/assets/libs/...
```bash

<!DOCTYPE html>
<html>
<head>

<title>Laravel 10 CRUD Application - Haripada Jena</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Css -->
<link href="{{asset('assets/libs/bootstrap/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />

<!-- DataTables -->
<link href="{{asset('assets/libs/datatables/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />
<link href="{{asset('assets/libs/datatables/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />

<!-- Responsive datatable examples -->
<link href="{{asset('assets/libs/datatables/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
type="text/css" />
</head>

<body>
<div class="container">
    @yield('content')
</div>
 <!-- JAVASCRIPT -->
 <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Required datatable js -->
 <script src="{{asset('assets/libs/datatables/datatables.net/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <!-- Buttons examples -->
 <script src="{{asset('assets/libs/datatables/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
 <!-- Responsive examples -->
 <script src="{{asset('assets/libs/datatables/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('assets/libs/datatables/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
@yield('script')
</body>

</html>

```

## resources/views/products/index.blade.php

```bash

@extends('products.layout')

@section('content')
<div class="container">

    <div class="row mb-4 mt-5">
        <div class="col-sm-8">
            <h2>Laravel 10 CRUD with AJAX -by Haripada Jena</h2>
        </div>
        <div class="col-sm-4 text-right">
            <a class="btn btn-info" href="javascript:void(0)" id="createNewProduct"> Create New Product</a>
        </div>
</div>

   

    <table class="table table-bordered data-table">

        <thead>

            <tr>

                <th>No</th>

                <th>Name</th>

                <th>Details</th>

                <th width="280px">Action</th>

            </tr>

        </thead>

        <tbody>

        </tbody>

    </table>

</div>

     

<div class="modal fade" id="ajaxModel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="modelHeading"></h4>

            </div>

            <div class="modal-body">

                <form id="productForm" name="productForm" class="form-horizontal">

                   <input type="hidden" name="product_id" id="product_id">

                    <div class="form-group">

                        <label for="name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-12">

                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">

                        </div>

                    </div>

       

                    <div class="form-group">

                        <label class="col-sm-2 control-label">Details</label>

                        <div class="col-sm-12">

                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>

                        </div>

                    </div>

        

                    <div class="col-sm-offset-2 col-sm-10">

                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes

                     </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
@section('script')
<script type="text/javascript">

    $(function () {

      /*------------------------------------------
       --------------------------------------------
       Pass Header Token
       --------------------------------------------
       --------------------------------------------*/ 
  
      $.ajaxSetup({
  
            headers: {
  
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  
            }
      });
  

      /*------------------------------------------
      --------------------------------------------
      Render DataTable
      -------------------------------------------
      --------------------------------------------*/
  
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{ route('products-ajax-crud.index') }}",
          columns: [
  
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'name', name: 'name'},
              {data: 'detail', name: 'detail'},
              {data: 'action', name: 'action', orderable: false, searchable: false},
          ]
  
      });
  
        
  
      /*------------------------------------------
      --------------------------------------------
      Click to Button
      --------------------------------------------
      --------------------------------------------*/
  
      $('#createNewProduct').click(function () {
          $('#saveBtn').val("create-product");
          $('#product_id').val('');
          $('#productForm').trigger("reset");
          $('#modelHeading').html("Create New Product");
          $('#ajaxModel').modal('show');
  
      });
  
        
  
      /*------------------------------------------
      --------------------------------------------
      Click to Edit Button
      --------------------------------------------
      --------------------------------------------*/
      $('body').on('click', '.editProduct', function () {
        var product_id = $(this).data('id');
        $('#saveBtn').html('Edit Changes');
        $.get("{{ route('products-ajax-crud.index') }}" +'/' + product_id +'/edit', function (data) {
            $('#modelHeading').html("Edit Product");
            $('#saveBtn').val("edit-user");
            $('#ajaxModel').modal('show');
            $('#product_id').val(data.id);
            $('#name').val(data.name);
            $('#detail').val(data.detail);
        })

      });

      /*------------------------------------------
      --------------------------------------------
      Create Product Code
      --------------------------------------------
      --------------------------------------------*/
      $('#saveBtn').click(function (e) {
          e.preventDefault();
          //$(this).html('Sending..');
          $('#saveBtn').html('Save Changes');
          $.ajax({
            data: $('#productForm').serialize(),
            url: "{{ route('products-ajax-crud.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                
                $('#productForm').trigger("reset");
                $('#ajaxModel').modal('hide');
                table.draw();
                alert(data.success);
            },
            error: function (data) {
                console.log('Error:', data);
                $('#saveBtn').html('Save Changes');
            }
        });

      });
      /*------------------------------------------
      -------------------------------------------
      Delete Product Code
      --------------------------------------------
      --------------------------------------------*/
  
      $('body').on('click', '.deleteProduct', function () {
          var product_id = $(this).data("id");
          confirm("Are You sure want to delete !");
          $.ajax({
              type: "DELETE",
              url: "{{ route('products-ajax-crud.store') }}"+'/'+product_id,
              success: function (data) {
                  table.draw();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          }); 
      });

    });
  
  </script>
@endsection
```


## Step 8 Run Laravel Application
To run the Laravel application, you can use the following command in your terminal:
Note:You shoud go application folder 
```bash
php artisan serve
```
Now, Go to your web browser, type the given URL and view the app output:
```bash
http://127.0.0.1:8000/products-ajax-crud
```
## Screenshot 
## --------------------------------------------------------------------------------

## Index Page

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/1.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Add Modal

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/2.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Edit Modal

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/3.PNG" alt="Description" style="max-width: 100%; height: auto;"/>

## Delete Modal

<img src="https://github.com/haripadajena/laravel/blob/main/laravel-10-crud/output-screen/4.PNG" alt="Description" style="max-width: 100%; height: auto;"/>


