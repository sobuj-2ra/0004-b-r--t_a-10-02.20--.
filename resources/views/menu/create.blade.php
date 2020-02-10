@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Menu Create
@endsection

<!--Page Header-->
@section('page-header')
    Create Menu
@endsection

<!--Page Content Start Here-->
@section('page-content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="main_part">
                    <br>
                    @if (Session::has('message'))
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3 alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×
                                </button>
                                <h4> {{ Session::get('message') }}</h4>
                            </div>
                        </div>
                    @endif
                    <div class="change_passport_body">
                        <p class="form_title_center">
                            <i>-Add Details-</i>
                        </p>
                        <form action="{{route('store')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <label for="form_date">Parent Menu:</label>
                                <select class="form-control" name="parent_id" id="p_id" required>
                                    <option value="">Select Item</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" {{ ( $menu->id == $menu->parent_id) ? 'selected' : '' }}> {{ $menu->menu }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" value="" id="parentID">
                            <div class="form-group">
                                <label>Sub Menu Name</label>
                                <input type="text" name="sub" id="sub_name" class="form-control" list="search-list" required autocomplete="off">
                                <div id="search-result">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form_date">Child Menu Name:</label>
                                <input type="text" class="form-control" name="menu" value="" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="form_date">Link:</label>
                                <input type="text" class="form-control" name="url_link" value="" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="form_date">Center Type:</label>
                                <p>
                                    @foreach ($center_type as $center)
                                    <span style="padding: 10px"><input type="checkbox" class="checkAll" name="center_type[]" value="{{$center->center_type}}"> {{$center->center_type}}</span>
                                    @endforeach
                                </p>
                                <p><span style="border: 2px solid #009bca;padding: 0px 6px 0px 5px;background: #009bca;float: right"><input type="checkbox" id="checkAll">Check All</span></p>
                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </section>
<script>
    $('select[name="parent_id"]').on('change', function() {
            var id = this.value;
            document.getElementById("parentID").value=id;


    });
    $("#checkAll").click(function () {
        $('.checkAll').not(this).prop('checked', this.checked);
    });
</script>
    <script>

        $('#sub_name').keyup(function() {
            var id = document.getElementById("parentID").value;
            console.log(id);
            var keyword = $(this).val();

            $.ajax({
                url: "{{ url("/search-sub-menu") }}",
                type: 'GET',
                data: { id: id, keyword: keyword},
                cache: false,
                success: function(result) {
                    var item = [];
                    item.push('<datalist class="list-group" id="search-list" style="position: absolute;width: 37%; background: #eee;cursor: pointer;">');
                    $.each(result, function(kay, val) {
                        item.push('<option class="list-group-item list-group-item-warning">' + val.menu + '</option>')
                    });
                    item.push('</datalist>');
                    if (keyword === '') {
                        $('#search-result').html('');
                    } else {
                        $('#search-result').html(item.join(''));
                    }
                }
            },'json');

        });
    </script>
@endsection
<!--Page Content End Here-->


  