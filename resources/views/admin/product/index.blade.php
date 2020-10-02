@extends('admin.layout.base')
@section('title', 'Product')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">Product</h2>
        <hr>

        <section>
            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    <form action="/search/product" method="post" class="input-group">
                        <input type="text" placeholder="Search Product" name='search'  class="input-group-field">
                        <div class="input-group-button">
                            <input type='submit' class="button" value="Search">
                        </div>
                        <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                    </form>
                </div>
                or
                <div class="small-12 medium-5 cell">
                    <a href="/profile/{{user()->username}}/products/create" class="button" >Create</a>
                </div>


            </div>

            @include('includes.messages')

            <div class="grid-x grid-padding-x">

                @if($products)

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>Product Description</td>
                                    <td>Product Image</td>
                                    <td>Action</td>
                                </tr>
                            </thead>

                            @foreach($products as $product)
                            <tbody>
                                <tr>
                                    <td>{{$product['product_name']}}</td>
                                    <td>{{$product['price']}}</td>
                                    <td>{{$product['description']}}</td>
                                    <td><img src="/{{$product['image_path']}}" alt="{{$product['product_name']}}"></td>

                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit Product" >
                                            <a href='/profile/{{user()->username}}/products/{{$product['id']}}/edit_product'><i class="fa fa-edit" title="Edit Product"></i></a>
                                        </span>

                                                    &nbsp;

                                                    {{--<span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >--}}
                                                    {{--<a href='/admin/user/{{$user['id']}}/delete'><i class="fa fa-trash" title="Edit User"></i></a>--}}
                                                    {{--</span>--}}


                                                    <span data-tooltip class="has-tip top" tabindex="1" title="Delete Product">
                                            <form action='/profile/{{user()->username}}/products/{{$product['id']}}/delete_product' method="post" class="delete-product">
                                                <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                                                <button type="submit"><i class="fa fa-times delete"></i></button>
                                            </form>
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                            @endforeach
                        </table>



                @endif

            </div>


        </section>

    </div>



    

    @endsection









