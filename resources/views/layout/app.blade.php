

 @extends('layout.base')



 @section('body')

     @include('includes._nav')

     {{--SITE WRAPPER--}}
     <div class="site_wrapper">
         @yield('content')



         <div class="notify text-center">

         </div>

     </div>






 @endsection














