<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.common.head')
    <title>Profile</title>
</head>

<body>
    @include('admin.common.header')
    @include('admin.common.sidebar')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($admin->profile_image != '')
                                <img src="{{ asset('admins/' . $admin->profile_image) }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="{{ asset('admins/fake-admin.png') }}" alt="Profile" class="rounded-circle">
                            @endif

                            <h2>{{ $admin->name }}</h2>

                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>



                               

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                                        <div class="col-lg-9 col-md-8">{{ $admin->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">{{ $admin->email }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8">{{ $admin->phone_number }}</div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form action="{{route('admin.update_profile')}}" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <input type="text" name="id" value="{{$admin->id}}" hidden>
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                              @if ($admin->profile_image != '')
                                                <img src="{{ asset('admins/' . $admin->profile_image)}}" alt="Profile"
                                               id="preview_image" height="100px" width="100px" style="border-radius: 100px">
                                              @else
                                                <img src="{{ asset('admins/fake-admin.png') }}" alt="Profile" id="preview_image" height="100px" width="100px" style="border-radius: 100px">
                                              @endif
                                                <div class="pt-2 ms-3">
                                                    <label for="upload_image">
                                                      <i  class="bi bi-upload btn btn-primary btn-sm"></i>
                                                    </label>
                                                    <input type="file" name="profile_image" id="upload_image" hidden onchange="return preview()"">    
                                                    <a href="{{route('admin.delete_profile_image', $admin->id)}}" class="btn btn-danger btn-sm"  title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                                       
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full
                                                Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="fullName" value="{{ $admin->name }}">
                                            </div>
                                                    
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email"
                                                    value="{{ $admin->email }}" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone_number" type="text" minlength="10" maxlength="10" class="form-control"
                                                    id="Phone" value="{{ $admin->phone_number }}">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->

                                </div>



                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="{{route('admin.change_password')}}" method="POST">
                                      @csrf
                                      <input type="text" name="id" value="{{$admin->id}}" hidden>
                                        <div class="row mb-3">
                                            <label for="currentPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="old_password" type="password" class="form-control"
                                                    id="currentPassword">
                                                    <span class="text-danger">
                                                      @if(session('pass_error'))
                                                        {{session('pass_error')}}
                                                      @endif
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" type="password" class="form-control"
                                                    id="newPassword">
                                                    <span class="text-danger">
                                                      @if(session('message'))
                                                        {{session('message')}}
                                                      @endif
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword"
                                                class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="renewPassword">
                                                    <span class="text-danger">
                                                      @error('password')
                                                          {{"password does not matched"}}
                                                      @enderror
                                                      
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    @include('admin.common.script')
</body>

</html>
<script type="text/javascript">
  var img1 = document.getElementById('preview_image');
 
  function preview(){

   //console.log(event.target.files[0]);
   var imagePath = URL.createObjectURL(event.target.files[0]);
   //console.log(imagePath);
   img1.src=imagePath;

   img1.style.display='block';
  }

  addEventListener("load",function(){
      img1.style.display='block';
  });

  </script>