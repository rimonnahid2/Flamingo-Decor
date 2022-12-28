@extends('admin.layouts.app')

@section('content')
   <!-- Page Body Start-->
 <div class="page-wrapper">
   <div class="page-content">
       <!--breadcrumb-->
       <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
           <div class="breadcrumb-title pe-3">FDT admin</div>
           <div class="ps-3">
               <nav aria-label="breadcrumb">
                   <ol class="breadcrumb mb-0 p-0">
                       <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                       </li>
                       <li class="breadcrumb-item active" aria-current="page">Practical blogcate Manage</li>
                   </ol>
               </nav>
           </div>
           <div class="ms-auto">
               <div class="btn-group">
                   <div class="btn-group">
                       <!-- Button trigger modal -->
                       <a href="{{ route('admin.blogcate') }}" class="btn btn-primary" ><i class="fadeIn animated bx bx-plus"></i> Add new category</a>
                   </div>
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
         
           <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-check-circle'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Success</h6>
                        <div class="text-white">{{ session('wrong') }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
           @endif
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <form action="{{ route('store.blog') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="row product-adding">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>General</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Blog Title</label>
                                    <input id="textString" class="form-control  @error('title') is-invalid @enderror" type="text"  value="{{ old('title') }}"  name="title" maxlength="150" placeholder="Your course title" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Slug</label>
                                    <input id="textSlug" class="form-control .unselectable-input   @error('slug') is-invalid @enderror" type="text" name="slug" value="{{ old('slug') }}" readonly required>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label"><span>*</span> Blog Category</label>
                                    <select class="form-control @error('blogcate_id') is-invalid @enderror"  name="blogcate_id"  required="" value="{{ old('blogcate_id') }}" >
                                        <option value="">--Select--</option>
                                        @foreach($blogcates as $blogcate)
                                        @if($blogcate->user_id == Auth::id())
                                        <option value="{{ $blogcate->id }}">{{ $blogcate->name }}</option>
                                        @endif
                                        @endforeach
                                        
                                    </select>

                                    @error('blogcate_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              <!--  -->
                            
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        
                                    <label for="validationCustom02" class="col-form-label"><span>*</span> Blog Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" id="validationCustom02" type="file"  required="" name="image" onchange="photoChange(this)">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="col-md-6">
                                    <img src=""  class="img-thumbnail mt-2" width="100%" value="{{ old('image') }}" id="photo">
                                    </div>
                                </div>


                      
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Meta Data</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0"> Meta Title</label>
                                    <input class="form-control" id="validationCustom05" type="text" value="{{ old('meta_tag') }}" name="meta_tag">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Meta Description</label>
                                    <textarea rows="4" cols="12" class="form-control" name="meta_description">{{ old('description') }}</textarea>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">*</span>Add Description</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                
                                <div class="form-group">

                                    <textarea id="mytextarea" name="description">Hello, World!</textarea>
                                </div>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group mb-0">
                                    <div class="product-buttons text-center">
                                        <button class="btn btn-primary">Add Blog</button>
                                        <button type="button" class="btn btn-light">Discard</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>
        <!-- Container-fluid Ends-->



   </div>
</div>

<script>
function photoChange(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#photo')
            .attr('src', e.target.result)
            .attr("class","img-thumbnail mt-3")
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script>
function photoChange1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#photo1')
            .attr('src', e.target.result)
            .attr("class","img-thumbnail mt-3")
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
@section('footer_js')

<script>
    ClassicEditor
    .create( document.querySelector( '#editor' ) )
    .then( editor => {
        console.log( editor );
    } )
    .catch( error => {
        console.error( error );
    } );

</script>
<script>
    $('#name').keyup(function() {
        $('#slug').val($(this).val().toLowerCase().split(',').join('').replace(/\s/g, "-"));
    });
</script>
<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
    </script>
    <script>
        tinymce.init({
          selector: '#mytextarea'
        });
    </script>
@endsection
