@extends('admin.layout.base')
@section('title', 'Orders')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">{{ $orderDetails[0]['order_number'] }}</h2>
        <hr>

        <section>

            <div class="grid-x grid-padding-x">

                @if(count($orderDetails))

                        <table class="hover">
                            <thead>
                                <tr>
                                    <td>Product Name</td>
                                    <td>Product Price</td>
                                    <td>Ordered By</td>
                                    <td>Email</td>
                                    <td>Address</td>
                                    <td>Phone #</td>
                                    <td>Hours</td>
                                    <td>Total </td>
                                    <td>Status</td>
                                </tr>
                            </thead>

                            @foreach($orderDetails as $order)

                            <tbody>
                                <tr>
                                    <td>{{$order['product']['product_name']}}</td>
                                    <td>{{$order['product']['price']}}</td>
                                    <td>{{$order['user']['username']}}</td>
                                    <td>{{$order['user']['email']}}</td>
                                    <td>{{$order['user']['address']}}</td>
                                    <td>+233-{{$order['user']['phone']}}</td>
                                    <td>{{$order['orderDetail']['hours']}}</td>
                                    <td>{{number_format($order['orderDetail']['total_price'],2) }}</td>
                                    <td>{{$order['orderDetail']['status']}}</td>



                                    {{--<td>--}}
                                        {{--<span data-tooltip class="has-tip top" tabindex="1" title="Order Details" >--}}
                                            {{--<a href='/admin/orders/{{$order['id']}}/order_details'><i class="fa fa-arrow-alt-circle-right" title="Order Details"></i></a>--}}
                                        {{--</span>--}}

                                                    {{--&nbsp;--}}

                                                    {{--<span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >--}}
                                                    {{--<a href='/admin/user/{{$user['id']}}/delete'><i class="fa fa-trash" title="Edit User"></i></a>--}}
                                                    {{--</span>--}}


                                                    {{--<span data-tooltip class="has-tip top" tabindex="1" title="Delete Order">--}}
                                            {{--<form action='/admin/orders/{{ $order['id'] }}/delete_order' method="post" class="delete-order">--}}
                                                {{--<input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">--}}
                                                {{--<button type="submit"><i class="fa fa-times delete"></i></button>--}}
                                            {{--</form>--}}
                                        {{--</span>--}}
                                    {{--</td>--}}

                                </tr>

                            </tbody>

                            @endforeach
                        </table>



                @endif

            </div>




        </section>

    </div>



    

    @endsection









