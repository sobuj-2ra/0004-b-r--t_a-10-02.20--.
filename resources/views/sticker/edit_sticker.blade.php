@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Edit Sticker
@endsection

<!--Page Header-->
@section('page-header')
    Edit Sticker
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if(Session::has('message'))
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
                        </div>
                @endif
                <!-- Code Here.... -->
                    <div class="change_passport_body">
                        <p class="form_title_center">
                            <i>-Add Sticker Details-</i>
                        </p>
                        <form action="{{URL::to('/update-sticker')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="form_date"><i>Sticker:</i></label>
                                <input type="text" class="form-control" name="sticker" value="{{$sticker_data->sticker}}" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="form_date"><i>Region:</i></label>
                                <select class="form-control" name="region" required>
                                    <option value="{{$sticker_data->region}}">{{$sticker_data->region}}</option>
                                </select>
                                {{--<input type="text" class="form-control" name="region" value="{{$sticker_data->region}}" autocomplete="off">--}}
                            </div>
                            <div class="form-group">
                                <label for="form_date"><i>Center:</i></label>
                                <select class="form-control" name="center" id="search-result" required>
                                    <option value="{{$sticker_data->center}}">{{$sticker_data->center}}</option>
                                </select>
                                {{--<input type="text" class="form-control" name="center" value="{{$sticker_data->center}}" autocomplete="off">--}}
                            </div>

                            <div class="form-group">
                                <label for="form_date"><i>Remarks:</i></label>
                                <input type="text" class="form-control" name="remarks" value="{{$sticker_data->remarks}}" autocomplete="off">
                            </div>
                            <hr>
                            <input type="hidden" value="{{$sticker_data->id}}" name="id">
                            <div class="footer-box">
                                <button type="reset" class="btn btn-danger">RESET</button>
                                <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                            </div>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>

@endsection
<!--Page Content End Here--