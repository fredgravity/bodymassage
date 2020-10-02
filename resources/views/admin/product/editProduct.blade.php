@extends('admin.layout.base')
@section('title', 'Edit Product')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Edit Product - {{ $product->product_name }}</h2>
        <hr>

        <section>


            @include('includes.messages')

            <section>
                <div class="grid-padding-x grid-x ">

                    <div class="small-12 medium-6 cell">
                        <form action="/profile/{{user()->username}}/products/{{$product->id}}/update_product" method="post" enctype="multipart/form-data">

                            <label for="product_name">Product Name:</label>
                            <input type="text" id="product_name" name="product_name" value="{{ $product->product_name  }}">

                            <label for="price">Price:</label>
                            <input type="text" id="price" name="price" value="{{$product->price }}">

                            <label for="description">Description:</label>
                            <textarea name="description" id="description" cols="30" rows="10">{{$product->description}}</textarea>
{{--                            <input type="text" id="description" name="description" value="{{$product->description}}">--}}


                            <label for="productImage" class="button">Upload Image</label>
                            <input type="file" id="productImage" class="show-for-sr" name="productImage">

                            <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">

                            <div>
                                <input type="submit" class="button expanded" value="Update">
                            </div>


                        </form>

                    </div>


                </div>

            </section>

        </section>

    </div>



    

    @endsection









