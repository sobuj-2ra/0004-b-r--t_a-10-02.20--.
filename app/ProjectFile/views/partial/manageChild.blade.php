<ul>
    @foreach($menus as $child)

        <li class="active"><a href="{{url($child->url_link)}}"><i class="fa fa-circle-o"></i> {{$child->menu}}</a>
            @if(count($child->menus))
                @include('partial.manageChild',['menus' => $child->menus])
            @endif

        </li>


    @endforeach
</ul>