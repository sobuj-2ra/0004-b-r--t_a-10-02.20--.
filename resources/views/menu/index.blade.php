@extends('admin.master')
<!--Page Title-->
@section('page-title')
		Menu List View
@endsection 

<!--Page Header-->
@section('page-header')
	Menu List
@endsection 

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>

                    <!-- Code Here.... -->
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div style="">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Settings</h4>
                                            <div style="padding-left: 5px; padding-bottom: 12px;">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Settings')
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"> <li style="padding-left: 5px">{{$sub->menu}}</li>
                                                            @foreach($sub->child_menu as $child_menu)
                                                                <p style="margin-left: 30px;"> <li style="padding-left: 40px;">{{$child_menu->menu}}</li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Operation</h4>
                                            <div style="padding-left: 5px; padding-bottom: 12px;">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Operation')
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"> <li style="padding-left: 5px"> {{$sub->menu}} </li>
                                                            @foreach($sub->child_menu as $child_menu)
                                                                <p style="margin-left: 30px;"> <li style="padding-left: 40px;"> {{$child_menu->menu}}</li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="" style="border: 1px solid #ddd;">
                                            <h4 class="text-center bg-info" style="margin-top: 0px;  padding-top: 10px; padding-bottom: 10px">Reports</h4>
                                            <div style="padding-left: 5px; padding-bottom: 12px;">
                                                @foreach($settings as $s)
                                                    @if($s->menu == 'Report')
                                                        {{--<p> <input type="checkbox" name="id[]" value="{{$s->id}}"> {{$s->menu}}--}}
                                                        @foreach($s->sub_menu as $sub)
                                                            <p style="margin-left: 5px;"> <li style="padding-left: 5px"> {{$sub->menu}}</li>
                                                            @foreach($sub->child_menu as $child_menu)
                                                                <p style="margin-left: 30px;"> <li style="padding-left: 40px;"> {{$child_menu->menu}}</li>
                                                            @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection 
<!--Page Content End Here-->



