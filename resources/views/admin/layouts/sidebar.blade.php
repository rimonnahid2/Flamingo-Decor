
<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('public/backend/assets/images/carimage3.jpg') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Affiliate Dit</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('dashboard') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
  
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Post</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.blogcate') }}"><i class="bx bx-right-arrow-alt"></i>Blog Category Manage</a>
                </li>
                <li> <a href="{{ route('index.blog') }}"><i class="bx bx-right-arrow-alt"></i>Blog List</a>
                </li>
                <li> <a href="{{ route('deactive.blog.list') }}"><i class="bx bx-right-arrow-alt"></i>Deactive Blog List</a>
                </li>
               {{--  <li> <a href="{{ route('admin.schedule') }}"><i class="bx bx-right-arrow-alt"></i>Schedule</a>
                </li> --}}
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Product</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.category') }}"><i class="bx bx-right-arrow-alt"></i>Product Category</a>
                </li>
                <li> <a href="{{ route('admin.subcate') }}"><i class="bx bx-right-arrow-alt"></i>Product Sub Category</a>
                </li>
                <li> <a href="{{ route('admin.website') }}"><i class="bx bx-right-arrow-alt"></i>Affiliate website</a>
                </li>
                <li> <a href="{{ route('create.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>
                <li> <a href="{{ route('index.product') }}"><i class="bx bx-right-arrow-alt"></i>product List</a>
                </li>
                <li> <a href="{{ route('deactive.product.list') }}"><i class="bx bx-right-arrow-alt"></i>Deactive product List</a>
                </li>
               {{--  <li> <a href="{{ route('admin.schedule') }}"><i class="bx bx-right-arrow-alt"></i>Schedule</a>
                </li> --}}
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Testimonial</div>
            </a>
            <ul>
                <li> <a href="{{ route('index.testimonial') }}"><i class="bx bx-right-arrow-alt"></i>Testimonial List</a>
                </li>
                <li> <a href="{{ route('deactive.testimonial.list') }}"><i class="bx bx-right-arrow-alt"></i>Deactive Testimonial List</a>
                </li>
               {{--  <li> <a href="{{ route('admin.schedule') }}"><i class="bx bx-right-arrow-alt"></i>Schedule</a>
                </li> --}} 
            </ul>
        </li>
 
        <li>
            <a href="{{ route('admin.contact.messages') }}" class="">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Contact Messages</div>
            </a>
        </li>

    
        <li class="menu-label">UI Elements</li>

        <li>
            <a href="{{ route('setting') }}" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Setting</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->