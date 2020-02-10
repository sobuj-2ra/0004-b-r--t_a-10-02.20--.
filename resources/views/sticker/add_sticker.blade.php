@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Add Sticker
@endsection

<!--Page Header-->
@section('page-header')
    Add Sticker
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
                    <div class="row">
                        <div class="col-md-4">
                            <div class="change_passport_body" style="width:100% !important;">
                                <p class="form_title_center">
                                    <i>-Add Sticker Details-</i>
                                </p>
                                <form action="{{URL::to('/store-sticker')}}" method="POST">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="form_date"><i>Sticker:</i></label>
                                        <input type="text" class="form-control" name="sticker" value="" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>Region:</i></label>
                                        <select class="form-control" name="region" id="center_type" required>
                                            <option value="">Select Item</option>
                                            <?php foreach ($centers as $cen){ ?>
                                            <option value="<?php echo $cen->region ?>"> <?php echo $cen->region ?> </option>
                                            <?php  } ?>

                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="form_date"><i>Center:</i></label>
                                        <select class="form-control" name="center" id="search-result" required>

                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="form_date"><i>Remarks:</i></label>
                                        <input type="text" class="form-control" name="remarks" value="" autocomplete="off">
                                    </div>
                                    <hr>
                                    <div class="footer-box">
                                        <button type="reset" class="btn btn-danger">RESET</button>
                                        <button type="submit" id="submit" class="btn btn-info pull-right">STORE</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="table_view" style="padding: 10px">
                                <div class="panel-body">
                                    <table width="100%" class="table-bordered table" style="font-size:14px;">
                                        <thead style="background:#ddd">
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Sticker</th>
                                            <th scope="col">Center</th>
                                            <th scope="col">Region</th>
                                            <th scope="col">Remarks</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($stickers as $sticker)
                                            <?php $i++; ?>
                                            <tr>
                                                <th scope="row">{{$i}}</th>
                                                <td>{{$sticker->sticker}}</td>
                                                <td>{{$sticker->center}}</td>
                                                <td>{{$sticker->region}}</td>
                                                <td>{{$sticker->remarks}}</td>
                                                <td>
                                                    <a href="{{URL::to('edit_sticker/'.$sticker->id)}}"><button class="btn btn-warning">Edit </button></a>
                                                    <a href="{{URL::to('delete_sticker/'.$sticker->id)}}"><button class="btn btn-danger">Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <!-- /.table-responsive -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
    <script>

        $('select[name="region"]').on('change', function () {
            var keyword = $(this).val();
            $.ajax({
                url: "{{ url("/search-center-for-region") }}",
                type: 'GET',
                data: {keyword: keyword},
                cache: false,
                success: function (result) {
                    var item = [];
                    item.push('<select class="form-control" name="center" required><option value="">Select Item</option>');
                    $.each(result, function (kay, val) {
                        item.push('<option value="' + val.center_name + '">' + val.center_name + '</option>')
                    });
                    item.push('</select>');
                    if (keyword === '') {
                        $('#search-result').html('');
                    } else {
                        $('#search-result').html(item.join(''));
                    }
                }
            }, 'json');

        });
    </script>

@endsection
<!--Page Content End Here--