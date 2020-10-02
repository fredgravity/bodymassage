@extends('admin.layout.base')
@section('title', 'Create Product')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Create Product</h2>
        <hr>

        @include('includes.messages')

        <section>
            <div class="grid-padding-x grid-x ">

                <div class="small-12 medium-6 cell">
                    <form action="/profile/{{user()->username}}/products/create" method="post" enctype="multipart/form-data">
                        <label for="product_name">Product Name:</label>
                        <input type="text" id="product_name" name="product_name" value="{{ \App\Classes\Request::oldData('post', 'product_name') }}">

                        <label for="price">Product Price:</label>
                        <input type="text" id="price" name="price" value="{{ \App\Classes\Request::oldData('post', 'price') }}">

                        <label for="description">Product Description:</label>
                        {{--<input type="text" id="description" name="description" value="{{ \App\Classes\Request::oldData('post', 'description') }}">--}}

                        <textarea name="description" id="description" cols="30" rows="5">
                            {{ \App\Classes\Request::oldData('post', 'description') }}
                        </textarea>

                        <label for="productImage" class="button">Upload Image</label>
                        <input type="file" id="productImage" class="show-for-sr" name="productImage">

                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                        <div>
                            <input type="submit" class="button expanded" value="Create">
                        </div>

                        
                    </form>

                </div>


            </div>

        </section>

    </div>



    

    @endsection









