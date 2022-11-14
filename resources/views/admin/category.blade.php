<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.common.head')
    <title>Category</title>

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
              <li class="breadcrumb-item active">Menu</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">
            <div class="col-12">

                <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Category List</h5>
                      <div class="d-flex justify-content-end me-3">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            Add Category
                        </button>
                      </div>

                      <!-- Default Table -->
                      <table class="table" id="example">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                            {{-- <th scope="col">Action</th> --}}

                          </tr>
                        </thead>
                        <tbody>

                          @foreach($category as $key=>$item)
                            <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$item->name}}</td>
                           <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                           {{-- <td></td> --}}
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
                        <form action="{{route('add_category')}}"  method="POST">
                            @csrf
                        <div class="mb-3">
                            <label for="yourName" class="form-label">Category Name</label>
                            <input type="text" name="category_name" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, enter menu name</div>
                            <span class="text-danger">
                                @error('category_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Category</button>
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

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#example').DataTable();
} );
