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