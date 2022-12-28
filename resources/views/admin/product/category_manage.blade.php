@extends('admin.layouts.app')

@section('content')

<div class="page-wrapper">
   <div class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
       {{--     <div class="breadcrumb-title pe-3">FDT admin</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Practical category Manage</li>
                   </ol>
               </nav>
           </div> --}}
           <div class="ms-auto">
               <div class="btn-group">
                   <!-- Button trigger modal -->
                   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"><i class="fadeIn animated bx bx-plus"></i> Add New Category</button>
               </div>
           </div>
       </div>
       <!--end breadcrumb-->

  @if(session('success'))
  <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-2">
       <div class="d-flex align-items-center">
           <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
           </div>
           <div class="ms-3">
               <h6 class="mb-0 text-white">Success</h6>
               <div class="text-white">{{ session('success') }}</div>
           </div>
       </div>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
  @endif 
  @if(session('wrong'))
  <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
      <div class="d-flex align-items-center">
          <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
          </div>
          <div class="ms-3">
               <h6 class="mb-0 text-white">Wrong</h6>
              <div class="text-dark">{{ session('wrong') }}</div>
          </div>
      </div>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

   @if($errors->any())
     @foreach ($errors->all() as $error)
        <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
            <div class="d-flex align-items-center">
                <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                </div>
                <div class="ms-3">
                    <div class="text-dark">Warning !! {{ $error }}</div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
     @endforeach
   <hr/>
    @endif

       <h6 class="mb-0 text-uppercase">List of categories</h6>
       <hr/>
       <div class="card">
           <div class="card-body">
               <div class="table-responsive">
                   <table id="example2" class="table table-striped table-bordered">
                       <thead>
                           <tr>
                               <th>Sl</th>
                               <th>Name</th>
                               <th>Image</th>
                               <th>Status</th>
                               <th>Edit</th>
                               <th>Delete</th>
                           </tr>
                       </thead>
                       <tbody>
                          @foreach($categories as $category)
                           <tr>
                              <td>{{ $count++ }}</td>
                              <td>{{ $category->name }}</td>
                              <td><img src="{{ asset('storage/app/public/'.$category->image) }}" style="height: 50px; width: 50px;"></td>
                              <td> 
                                 @if($category->status == 1)
                                    <a class="btn btn-primary" href="{{ route('deactive.category',$category->id) }}">Active</a>
                                 @else
                                    <a class="btn btn-warning" href="{{ route('active.category',$category->id) }}">Deactive</a>
                                 @endif
                              </td>
                              <td>
                                <!-- Large modal -->
                                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editcategory{{ $category->id }}"><i class="bx bxs-edit"></i></button>
                                <!-- Small modal -->
                              </td>
                              <td>
                                 <a href="{{ route('delete.category',$category->id) }}" class="btn btn-xs waves-effect waves-light btn-danger" id="delete"><i class="lni lni-trash"></i></a>
                              </td>
                            <!-- Button trigger modal -->
                          </tr>

                            <!-- Modal create -->
                            <div class="modal fade" id="editcategory{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">category update form</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xl-8 mx-auto"> 
                                                    @if ($errors->any())
                                                         @foreach ($errors->all() as $error)
                                                            <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                                                                    </div>
                                                                    <div class="ms-3">
                                                                        <div class="text-dark">Warning !! {{ $error }}</div>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                            </div>
                                                         @endforeach
                                                     @endif
                                                    <hr/>
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="p-4 border rounded">
                                                                  <form action="{{ route('update.category',$category->id) }}" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                                                                   @csrf
                                                                   <div class="col-md-12">
                                                                       <label for="validationCustom02" class="form-label">Category name</label>
                                                                       <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                                                                       <div class="invalid-feedback">Please enter category name</div>
                                                                   </div>
                                                                   <div class="col-md-12">
                                                                       <label for="validationCustom02" class="form-label">Image</label>
                                                                        <input type="file" id="file-input" name="image" class="form-control-file  @error('image') is-invalid @enderror " onchange="photoChangEdit(this)">

                                                                       <div class="invalid-feedback">Please select a category image</div>
                                                                         <input type="hidden" name="old_image" value="{{ $category->image }}">
                                                                         @error('image')
                                                                         <span class="invalid-feedback" role="alert">
                                                                         <strong>{{ $message }}</strong>
                                                                         </span>
                                                                         @enderror
                                                                         <img class="img-thumbnail" src="{{ asset('/storage/app/public/'.$category->image) }}" alt="{{ $category->name }}" id="photoEdit" style="height: 100%; width: 100%;">
                                                                   </div>
                                                                   <div class="col-12">
                                                                       <button class="btn btn-primary" type="submit">Submit form</button>
                                                                   </div>
                                                               </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          @endforeach
                       </tbody>
                       <tfoot>
                           <tr>
                               <th>Sl</th>
                               <th>Name</th>
                               <th>Image</th>
                               <th>Status</th>
                               <th>Edit</th>
                               <th>Delete</th>
                           </tr>
                       </tfoot>
                   </table>
               </div>
           </div>
       </div>

       <!-- Modal create -->
       <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title">New category Form</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="row">
                           <div class="col-xl-8 mx-auto"> 
                               @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                       <div class="alert alert-warning border-0 bg-warning alert-dismissible fade show py-2">
                                           <div class="d-flex align-items-center">
                                               <div class="font-35 text-dark"><i class='bx bx-info-circle'></i>
                                               </div>
                                               <div class="ms-3">
                                                   <div class="text-dark">Warning !! {{ $error }}</div>
                                               </div>
                                           </div>
                                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                       </div>
                                    @endforeach
                                @endif
                               <hr/>
                               <div class="p-4 border rounded">
                                   <form action="{{ route('create.category') }}" method="post" class="row g-3 needs-validation" novalidate  enctype="multipart/form-data">
                                       @csrf
                                       <div class="col-md-12">
                                           <label for="validationCustom02" class="form-label">Date</label>
                                           <input type="text" name="name" class="form-control" required>
                                           <div class="invalid-feedback">Please enter category name</div>
                                       </div>
                                       <div class="col-md-12">
                                           <label for="validationCustom02" class="form-label">Image</label>
                                           <input type="file" name="image" class="form-control" required>
                                           <div class="invalid-feedback">Please select a category image</div>
                                       </div>
                                       <div class="col-12">
                                           <button class="btn btn-primary" type="submit">Submit form</button>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                       
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

@endsection
