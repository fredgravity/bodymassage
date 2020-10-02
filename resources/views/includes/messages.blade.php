
<div class="grid-container fluid">
    <div class="grid-padding-x grid-x">

        <div class="cell">
{{--            {{ pnd($errors) }}--}}
            @if(isset($errors) || \App\Classes\Session::exist('error'))
                <div class="callout alert" data-closable>

                    @if(\App\Classes\Session::exist('error'))
                        {{ \App\Classes\Session::flash('error') }}

                    @else
                        @if(is_array($errors))
                            @foreach($errors as $errorArray)
                                @if(is_array($errorArray))
                                    @foreach($errorArray as $errorItem)

                                        {{ $errorItem }} <br />
                                    @endforeach
                                @else
                                    {{ $errorArray }}
                                @endif

                            @endforeach
                        @else
                            {{--{{ dnd(empty($errors)) }}--}}
                            @if(!empty($errors))
                                    {{$errors}}
                                @endif


                        @endif

                    @endif


                    <button class="close-button" aria-label="Dismiss Message" type="button" data-close> <span aria-hidden="true">&times;</span> </button>
                </div>

            @endif

            @if(isset($success) || \App\Classes\Session::exist('success'))
                <div class="callout success" data-closable>
                    @if(isset($success))
                        {{ $success }}
                    @elseif(\App\Classes\Session::exist('success'))
                        {{ \App\Classes\Session::flash('success') }}
                    @endif

                    <button class="close-button" aria-label="Dismiss Message" type="button" data-close> <span aria-hidden="true">&times;</span> </button>
                </div>

            @endif
        </div>



    </div>
</div>
