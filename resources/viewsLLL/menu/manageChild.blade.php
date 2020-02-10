<ul>
    @foreach($menus as $child)

        <li>
            {{--@forelse($roles as $role)--}}
        {{--<li>--}}
            {{--<label>--}}
                {{--<input type="checkbox" name="roles[]"--}}
                       {{--value="{{ $role->id }}" {{ $user->hasRole($role) ? 'checked' : '' }}>--}}
                {{--{{ $role->name }}--}}
            {{--</label>--}}
        {{--</li>--}}
        {{--@empty--}}
            {{--<li>no roles</li>--}}
        {{--@endforelse--}}
            <input id="{{$item->id}}" type="checkbox" /><label for="assistantmanager3">{{ $child->menu }}</label>
            @if(count($child->menus))
                @include('menu.manageChild',['menus' => $child->menus])
            @endif
        </li>
    @endforeach
</ul>