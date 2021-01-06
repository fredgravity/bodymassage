@extends('admin.layout.base')
@section('title', 'Users')


@section('content')


    <div class="grid-container fluid product">

        <h2 class="text-center">
            @if($role ==='user')
                Users
                @elseif($role === 'worker')
                Workers
            @endif
        </h2>
        <hr>

        <section>

            @include('includes.messages')

            <div class="grid-x grid-padding-x">

                <div class="small-12 medium-6 cell">
                    @if($role ==='user')
                        <form action="/search/user" method="post" class="input-group">
                            <input type="text" placeholder="Search User" name="search" class="input-group-field">
                            <div class="input-group-button">
                                <input type='submit' class="button" value="Search">
                            </div>
                            <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                        </form>
                        @else
                        <form action="/search/worker" method="post" class="input-group">
                            <input type="text" placeholder="Search User" name="search" class="input-group-field">
                            <div class="input-group-button">
                                <input type='submit' class="button" value="Search">
                            </div>
                            <input type="hidden" name="token" value="{{ \App\Classes\CSRFToken::generate() }}">
                        </form>

                    @endif

                </div>
                or
                <div class="small-12 medium-5 cell">
                    <a href="/profile/{{user()->username}}/users/register" class="button" >Create</a>
                </div>


            </div>


            <div class="grid-x grid-padding-x cell">
                @if($role === 'user')
                    @if(count($users))
                        <table>
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                                @foreach($users as $user)
                                {{--{{ pnd($user) }}--}}
                                <tbody>
                                <tr>
                                    <td>{{$user['username']}}</td>
                                    <td>{{$user['email']}}</td>
                                    <td>{{$user['fullname']}}</td>
                                    <td>{{$user['address']}}</td>
                                    <td>{{$user['region']}}</td>
                                    <td>{{$user['city']}}</td>
                                    <td>+233-{{$user['phone']}}</td>
                                    <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >
                                            <a href='/profile/{{user()->username}}/users/{{$user['id']}}/edit_user'><i class="fa fa-edit" title="Edit User"></i></a>
                                        </span>

                                        &nbsp;

                                        {{--<span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >--}}
                                            {{--<a href='/admin/user/{{$user['id']}}/delete'><i class="fa fa-trash" title="Edit User"></i></a>--}}
                                        {{--</span>--}}


                                        <span data-tooltip class="has-tip top" tabindex="1" title="Delete User">
                                            <form action='/profile/{{user()->username}}/users/{{ $user['id'] }}/delete_user' method="post" class="delete-user">
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
@include('includes.paginate_links')
                        {{--@if($links)--}}
                            {{--{!! $links !!}--}}
                        {{--@endif--}}

                    @endif

                    @if($role === 'worker')
                        @if(count($workers))
                            <table>
                                <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Name</th>
                                    <th>Address</th>
                                    <th>Region</th>
                                    <th>City</th>
                                    <th>Phone Number</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                @foreach($workers as $user)

                                    <tbody>
                                    <tr>
                                        <td>{{$user['username']}}</td>
                                        <td>{{$user['email']}}</td>
                                        <td>{{$user['fullname']}}</td>
                                        <td>{{$user['address']}}</td>
                                        <td>{{$user['region']}}</td>
                                        <td>{{$user['city']}}</td>
                                        <td>+233-{{$user['phone']}}</td>
                                        <td>
                                        <span data-tooltip class="has-tip top" tabindex="1" title="Edit Worker" >
                                            <a href='/profile/{{user()->username}}/users/{{$user['id']}}/edit_worker'><i class="fa fa-edit" title="Edit Worker"></i></a>
                                        </span>

                                            &nbsp;

                                            {{--<span data-tooltip class="has-tip top" tabindex="1" title="Edit User" >--}}
                                            {{--<a href='/admin/user/{{$user['id']}}/delete'><i class="fa fa-trash" title="Edit User"></i></a>--}}
                                            {{--</span>--}}


                                            <span data-tooltip class="has-tip top" tabindex="1" title="Delete Worker">
                                            <form action='/profile/{{user()->username}}/users/{{ $user['id'] }}/delete_user' method="post" class="delete-worker">
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
@include('includes.paginate_links')
                        {{--@if($links)--}}
                            {{--{!! $links !!}--}}
                            {{--@endif--}}

                    @endif
            </div>


        </section>

    </div>



    

    @endsection









