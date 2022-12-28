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
                       <li class="breadcrumb-item active" aria-current="page">Practical product Manage</li>
                   </ol>
               </nav>
           </div>
           <div class="ms-auto">
               <div class="btn-group">
                   <div class="btn-group">
                       <!-- Button trigger modal -->
                       <a href="{{ route('admin.category') }}" class="btn btn-primary" ><i class="fadeIn animated bx bx-plus"></i> Add new category</a>
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
            <form action="{{ route('update.product',$product->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
            <div class="row product-adding">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>General</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Product Title</label>
                                    <input id="textString" class="form-control  @error('title') is-invalid @enderror" type="text"  value="{{ $product->title }}"  name="title" maxlength="190" placeholder="Your course title" required>
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Product price</label>
                                    <input id="textString" class="form-control  @error('price') is-invalid @enderror" type="number"  value="{{ $product->price }}"  name="price" maxlength="13" placeholder="Your course price" required>
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Product discount</label>
                                    <input id="textString" class="form-control  @error('discount') is-invalid @enderror" type="text"  value="{{ $product->discount }}"  name="discount" maxlength="11" placeholder="Your course discount">
                                    @error('discount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Product link</label>
                                    <input id="textString" class="form-control  @error('link') is-invalid @enderror" type="text"  value="{{ $product->link }}"  name="link" maxlength="150" placeholder="Your course link" required>
                                    @error('link')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="col-form-label pt-0"><span>*</span>Product shipping_info</label>
                                    <input id="textString" class="form-control  @error('shipping_info') is-invalid @enderror" type="text"  value="{{ $product->shipping_info }}"  name="shipping_info" maxlength="150" placeholder="Your course shipping_info" required>
                                    @error('shipping_info')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                     
                                <div class="form-group mt-2">
                                    <label class="col-form-label"><span>*</span>Category</label>
                                    <select class="form-control @error('category_id') is-invalid @enderror"  name="category_id"  required="" value="{{ old('category_id') }}" >
                                        <option value="">--Select--</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{ $category->name }}</option>
                                        @endforeach
                                        
                                    </select>

                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-2">
                                    <label class="col-form-label"><span>*</span> Subcate</label>
                                    <select class="form-control @error('subcate_id') is-invalid @enderror"  name="subcate_id"  required=""  >
                                        <option value="">--Select--</option>
                                        @foreach($subcates as $subcate)
                                        <option value="{{ $subcate->id }}"  @if($subcate->id == $product->subcate_id) selected @endif>{{ $subcate->name }}</option>
                                        @endforeach
                                        
                                    </select>

                                    @error('subcate_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label class="col-form-label"><span>*</span> Website</label>
                                    <select class="form-control @error('website_id') is-invalid @enderror"  name="website_id"  required="" value="{{ old('website_id') }}" >
                                        <option value="">--Select--</option>
                                        @foreach($websites as $website)
                                        <option value="{{ $website->id }}"  @if($website->id == $product->website_id) selected @endif>{{ $website->name }}</option>
                                        @endforeach
                                        
                                    </select>

                                    @error('website_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                              <!--  -->
                            
                                <div class="form-group mt-2 row">
                                    <div class="col-md-12">
                                        
                                    <label for="validationCustom02" class="col-form-label"><span>*</span> Product Image</label>
                                    <input class="form-control @error('image') is-invalid @enderror" id="validationCustom02" type="file" name="image" onchange="photoChange(this)">
                                    <input type="hidden" name="old_image" value="{{ $product->image }}">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>

                                    <div class="col-md-6">
                                    <img src="" class="img-thumbnail mt-2" width="100%" value="{{ old('image') }}" id="photo">
                                    </div>
                                </div>


                      
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Choose Options</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="form-group">
                                   <label class="me-2" for="trend"> <input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="trend"   @if($product->trend == 1) checked @endif id="trend"> Trend</label>

                                    <label class="me-2" for="offer"><input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="offer"   @if($product->offer == 1) checked @endif id="offer"> Offer</label>

                                    <label class="me-2" for="new"><input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="new"   @if($product->new == 1) checked @endif id="new">New</label>

                                  <label class="me-2" for="today_offer">  <input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="today_offer"   @if($product->today_offer == 1) checked @endif id="today_offer"> Today Offer</label>

                                    <label class="me-2" for="best_rated"><input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="best_rated"   @if($product->best_rated == 1) checked @endif id="best_rated"> Best Rated</label>

                                    <label class="me-2" for="slider"> <input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="slider"   @if($product->slider == 1) checked @endif id="slider">Slider</label>

                                  <label class="me-2" for="hot_deal"> <input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="hot_deal"   @if($product->hot_deal == 1) checked @endif id="hot_deal">Hot Deal</label>

                                  <label class="me-2" for="top_1"> <input class="form-check-input" type="checkbox" value="1" aria-label="Checkbox for following text input" name="top_1"   @if($product->top_1 == 1) checked @endif id="top_1">Top One</label>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="form-group">
                                    <textarea  rows="8" cols="12"  class="form-control  @error('summary') is-invalid @enderror" type="text"  name="summary" maxlength="150"  placeholder="Your course summary" required>{{ $product->summary }}</textarea>
                                    @error('summary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Meta Data</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                <div class="form-group">
                                    <label for="validationCustom05" class="col-form-label pt-0"> Meta Tag (Separate by comma)</label>
                                    <input class="form-control" id="validationCustom05" type="text" value="{{ $product->meta_tag }}" name="meta_tag">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Meta Description</label>
                                    <textarea rows="6" cols="12" class="form-control" name="meta_description">{{ $product->meta_description }}</textarea>

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

                                    <textarea id="mytextarea" name="description">{{ $product->description }}</textarea>
                                </div>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                    </div>

	               <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5><span class="text-danger">*</span>Add Additional Note</h5>
                        </div>
                        <div class="card-body">
                            <div class="digital-add needs-validation">
                                
                                <div class="form-group">

                                    <textarea id="mytextarea" name="note">{{ $product->note }}</textarea>
                                </div>
                                    @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="form-group mb-0 mt-3">
                                    <div class="product-buttons text-center">
                                        <button class="btn btn-primary">Update product</button>
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
