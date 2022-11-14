<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.common.head')
    <title>Banner</title>

</head>

<body>
    @include('admin.common.header')
    @include('admin.common.sidebar')

    <!-- Main Content Sectioon -->

    <main id="main" class="main">

        <div class="pagetitle">
          <h1>Banner</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Banner</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
          <div class="row">
            <div class="col-12">

                <div class="card">
                  <div class="card-body">
                      <h5 class="card-title">Banner List</h5>
                      <div class="d-flex justify-content-end me-3">
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            Add Banner
                        </button>
                      </div>

                      <!-- Default Table -->
                      <table class="table" id="example">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th>Status</th>
                            

                          </tr>
                        </thead>
                        <tbody>

                          @foreach($banner as $key=>$item)
                            <tr>
                           <td>{{$key+1}}</td>
                           <td>{{$item->name}}</td>
                           <td>
                            <img src="{{asset('Banner/'.$item->image)}}" width="100px" alt="">
                           </td>
                           <td>
                            @if ($item->status == 1)
                                <a href="" class="btn btn-success btn-sm">Active</a>
                            @else

                            @endif
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
                        <form action="{{route('add_banner')}}"  method="POST" enctype="multipart/form-data">
                            @csrf
                        <div class="mb-3">
                            <label for="yourName" class="form-label">Banner</label>
                            <input type="text" name="name" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, enter banner name</div>
                            <span class="text-danger">
                                @error('category_name')
                                    {{$message}}
                                @enderror
                            </span>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Banner Deatils</label>
                          <textarea class="form-control" name="deatils" id="" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                          <label for="" class="form-label">Banner Image</label>
                          <input type="file" class="form-control" name="image" id="" placeholder="" aria-describedby="fileHelpId" required>

                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Banner</button>
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
