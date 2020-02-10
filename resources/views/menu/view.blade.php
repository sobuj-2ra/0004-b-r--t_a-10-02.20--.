@extends('master.master')

@section('content')

    <div class="row">

        <div class="col-md-6">



            @foreach($treeView as $category)
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>{{ $category->menu }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        @foreach($category->childs as $subcategory)
                            <li class=""><a href="#">{{$subcategory->menu}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach


        </div>
    </div>

    @endsection