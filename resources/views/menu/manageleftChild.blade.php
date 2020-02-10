<ul>
    @foreach($menus as $child)

        <li>
            <input id="{{$item->id}}" type="checkbox" /><label for="assistantmanager3">{{ $child->menu }}</label>
            
        </li>
    @endforeach
</ul>
