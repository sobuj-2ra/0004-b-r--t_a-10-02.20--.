@extends('master.master')

@section('content')

    <div class="row">

        <div class="col-md-6">


            <ul class="checktree">

{{--{{dd($array)}}--}}

                    @foreach($menus as $item)
                        {{--{{dd(in_array($item->id,$array))}}--}}
                {{--{{$item->id}}--}}

                        {{--@if(in_array($item->id,$array))--}}

                    {{--<li><input id="{{$item->id}}" type="checkbox" /><label for="assistantmanager3">{{ $item->menu }}</label></li>--}}


                        <li style="list-style: none">
                            <input id="{{$item->id}}" type="checkbox"  /><label for="assistantmanager3">{{ $item->menu }}</label>
                            {{--<a href="{{ $item->id }}"><span>{{ $item->menu }}</span> <i class="fa fa-angle-left pull-right"></i></a>--}}

                            @if(count($item->menus))

                                @include('menu.manageChild',['menus' => $item->menus])

                            @endif
                    {{--@endif--}}

                    @endforeach



            </ul>




        </div>
    </div>



    @endsection


@section('script')

    <script type="text/javascript" src="{{asset('template')}}/js/checktree.js"></script>

    <script src="//code.jquery.com/jquery.min.js"></script>

    <script>
        $(function(){
            $("ul.checktree").checktree();
        })(jQuery);
    </script>

@endsection



