<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.common.head')
    <title>Product</title>
<style>
    .col-4{
        /* padding:10px 0;
        margin: 10px 0; */
        width: 100px;
    }
</style>
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#category').on('change', function(e){
                var category_slug = e.target.value;

                $.ajax({
                    url:"{{route('getsubcategory')}}",
                    type: "GET",
                    data:{
                        category_slug:category_slug,
                    },
                    success:function(result){
                        $('#subcategory').empty();
                        $('#subcategory').append('<option value="" hidden>Choose Sub Category</option>');

                        $.each(result.subcategory, function(key, value){
                            $('#subcategory').append('<option value="' + value.slug +'">' + value.name + '</option>')
                            // console.log(key+value)
                        });
                    }
                });
            });
        });
    </script>

</head>

<body>
    @include('admin.common.header')
    @include('admin.common.sidebar')

    <!-- Main Content Sectioon -->

    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Menu</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
              <li class="breadcrumb-item active">Product List</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">
            <div class="col-12">

                <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Product List</h5>
                      <div class="d-flex justify-content-end me-3 mb-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            Add Product
                        </button>
                      </div>

                      <!-- Default Table -->
                      <table class="table" id="example">
                        <thead>
                          <tr>
                            <th scope="col">#</th>

                            <th>Product Name</th>
                            <th scope="col">Category</th>
                            <th scope="col"> Sub Category</th>
                            <th>Images</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>
                            {{-- {{$product}} --}}
                          @foreach($product as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{getCategory($item->category_slug)->name}}</td>
                                <td>{{getSubCategory($item->sub_category_slug)->name}}</td>
                                <td>
                                    <div class="row">
                                    @foreach (explode(',',$item->images) as $image)
                                        <div class="mb-3 col-4">
                                            <img src="{{asset('Gallery/'.$image)}}" height="64px" width="64px" alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <a href="{{route('product_details', $item->slug)}}" class="btn btn-primary btn-sm">info</a>
                                </td>
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
                      <!-- End Default Table Example -->
                    </div>
                  </div>
          </div>

            <div class="modal fade" id="categoryModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Menu</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('add__product')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                              <div class="mb-3 col-6">
                                <label for="" class="form-label">Main Category</label>
                                <select class="form-control" name="category_slug" id="category" required>
                                  <option value="">select main category</option>
                                  @foreach ($category as $value)
                                      <option value="{{$value->slug}}">{{$value->name}}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="mb-3 col-6" id="subpcategorydiv">
                                <label for="" class="form-label">Select Sub Page</label>
                                <select class="form-control" name="subcategoryslug" id="subcategory">

                                </select>
                              </div>
                              <div class="mb-3 col-6">
                              <label for="" class="form-label">Product Name</label>
                              <input type="text"
                                class="form-control" name="product_name" id="" aria-describedby="helpId" placeholder="">

                              </div>
                              <div class="mb-3 col-6">
                              <label for="" class="form-label">Product Price</label>
                              <input type="text"
                                class="form-control" name="product_price" id="" aria-describedby="helpId" placeholder="">

                              </div>
                              <div class="mb-3 col-12">
                                <label for="" class="form-label">Product Details</label>
                                <textarea class="form-control" name="product_details" id="" rows="3"></textarea>
                              </div>

                              <div class="mb-3 col-12">
                              <label for="" class="form-label">Product Images </label>
                              <input type="file" class="form-control"  name="product_images[]" multiple aria-describedby="fileHelpId" required>

                              </div>
                              </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>
                    </div>
                </form>
                  </div>
                </div>
              </div>
        </section>
        <!-- End Main  Section -->
    </main><!-- End #main -->
    @include('admin.common.script')



</body>

</html>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    history.pushState(null, document.title, location.href);
    window.addEventListener('popstate', function(event) {
        history.pushState(null, document.title, location.href);
    });
</script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#example').DataTable();
} );
</script>
