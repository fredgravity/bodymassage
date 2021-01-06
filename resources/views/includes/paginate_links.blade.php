{{--<div class="paginate-links float-center">--}}
{{--@if($links)--}}
{{--@if(array_key_exists('first', $links))--}}
{{--<li class="button small ">{!! $links['first'] !!}</li>--}}
{{--@endif--}}

{{--@if(array_key_exists('prev', $links))--}}
{{--<li class="button small ">{!! $links['prev'] !!}</li>--}}
{{--@endif--}}

{{--<li class="button small ">{!! $links['current'] !!}</li>--}}

{{--@if(array_key_exists('next', $links))--}}
{{--<li class="button small ">{!! $links['next'] !!}</li>--}}
{{--@endif--}}



{{--@if(array_key_exists('last', $links) )--}}
{{--<li class="button small ">{!! $links['last'] !!}</li>--}}
{{--@endif--}}


{{--@endif--}}
{{--</div>--}}

<div class="paginate-links float-center">
    {{--{{pnd($links)}}--}}
    <div class="grid-x">
        <div class="" style="display: flex;">
            @if($links)
                {{--FIRST--}}
                <div class="" >
                    @if(array_key_exists('first', $links))
                        <form action="{{$links['first']}}" method="get">
                            <input type="submit" class="button small" value="<< First">
                        </form>

                    @endif
                </div>

                {{--PREVIOUS--}}
                <div class="" style="margin: 0 0.3rem;">
                    @if(array_key_exists('prev', $links))
                        <form action="{{$links['prev']}}" method="get">
                            <input type="submit" class="button small" value="< Prev">
                        </form>

                    @endif
                </div>

                {{--CURRENT--}}
                <div class="" style="margin: 0 0.3rem;">
                    <h6 class="button small ">{!! $links['current'] !!}</h6>
                </div>

                {{--NEXT--}}
                <div class="" style="margin: 0 0.3rem;">
                    @if(array_key_exists('next', $links))
                        <form action="{{$links['next']}}" method="get">
                            <input type="submit" class="button small" value="Next >">
                        </form>

                    @endif
                </div>

                {{--LAST--}}
                <div class="" >
                    @if(array_key_exists('last', $links))
                        <form action="{{$links['last']}}" method="get">
                            <input type="submit" class="button small" value="Last >>">
                        </form>

                    @endif

                </div>


            @endif
        </div>
    </div>

</div>