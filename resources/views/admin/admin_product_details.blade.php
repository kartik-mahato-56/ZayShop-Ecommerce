<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.common.head')
    <title>Dashboard</title>

</head>

<body>
    @include('admin.common.header')
    @include('admin.common.sidebar')

    <!-- Main Content Sectioon -->

    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Dashboard</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
              <li class="breadcrumb-item active">Product Details</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">
                <!-- Sales Card -->
                <h2 class="text-center">Product Details</h2>

                    <div class="mb-3 col-6">
                      <label for="" class="form-label">Product Name</label>
                      <input type="text"
                        class="form-control" name="" id="" value="{{$product->name}}">

                    </div>
                    <div class="mb-3 col-6">
                      <label for="" class="form-label">Product Category</label>
                      <input type="text"
                        class="form-control" name="" id="" value="{{getCategory($product->category_slug)->name}}">

                    </div>
                    <div class="mb-3 col-6">
                      <label for="" class="form-label">Product Sub Category</label>
                      <input type="text"
                        class="form-control" name="" id="" value="{{getSubCategory($product->sub_category_slug)->name}}">

                    </div>
                    <div class="mb-3 col-6">
                        <label for="" class="form-label">Product Price</label>
                        <input type="text"
                          class="form-control" name="" id="" value="{{$product->price}}">

                      </div>
                    <div class="mb-3 col-12">
                      <label for="" class="form-label">Product Details</label>
                      <textarea class="form-control" name="" id="" rows="3">{{$product->details}}</textarea>
                    </div>
                    <div class="mb-3 col-12">
                        <label for="">Product Images</label>
                        <div class="row">
                            @foreach (explode(',',$product->images) as $image)
                            <div class="col-3">
                                <img src="{{asset('Gallery/'.$image)}}" class="img-fluid" width="200px" height="200px" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{route('products')}}" class="btn btn-success my-3 btn-lg btn-block">Back</a>

          </div>
        </section>

      </main><!-- End #main -->


    <!-- End Main  Section -->
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
