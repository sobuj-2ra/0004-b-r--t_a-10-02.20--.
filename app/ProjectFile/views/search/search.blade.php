@extends('master.master')

@section('content')

    <div class="row">
        {{--{{dd($user)}}--}}

        <div class="col-md-6 col-xs-offset-1">

            <table class="table">
                <tbody class="col-md-3">
                <tr>
                    <th>Region</th>
                    <td></td>

                </tr>
                <tr>
                    <th>Count</th>
                    <td></td>

                </tr>
                <tr>
                    <th>User</th>
                    <td>{{auth()->user()->name}}</td>

                </tr>

                </tbody>
            </table>


        </div>





       <div class="col-md-5 col-md-offset-1">
           <form   action="{{route('search')}}" method="get" role="search" >
               {{--{{ csrf_field() }}--}}
               <div class="input-group col-md-6 ">
                   <input type="text" class="form-control" name="q"
                          placeholder="Search passport Number"> <span class="input-group-btn">
					<button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>



				</span>

               </div>


       </div>


        <div class="col-md-7 col-xs-offset-1">
            <table class="table table-striped ">
                <thead>
                <tr>
                    <th>Passport Number</th>
                    <th>Sticker type</th>
                    <th>Contact Number</th>
                </tr>
                </thead>
                <tbody >
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->passport}}</td>
                        <td>{{$user->sticker}}</td>
                        <td>{{$user->contact}}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

        </form>


        <div class="col-md-5 col-xs-offset-1">


        <form action="{{route('search.store',3)}}" method="post"  >
        {{ csrf_field() }}
        <button type="submit" class="btn btn-info">Save</button>

        </form>

        </div>







    </div>
@endsection


@section('script')

    <script type='text/javascript'>
        $(document).ready(function(){

            // Fetch all records
            $('#but_fetchall').click(function(){
                fetchRecords(0);
            });

            // Search by userid
            $('#but_search').click(function(){
                var userid = Number($('#search').val().trim());

                if(userid > 0){
                    fetchRecords(userid);
                }

            });

        });

        function fetchRecords(id){
            $.ajax({
                url: 'getUsers/'+id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var len = 0;
                    $('#userTable tbody').empty(); // Empty <tbody>
                    if(response['data'] != null){
                        len = response['data'].length;
                    }

                    if(len > 0){
                        for(var i=0; i<len; i++){
                            var id = response['data'][i].id;
                            var username = response['data'][i].username;
                            var name = response['data'][i].name;
                            var email = response['data'][i].email;

                            var tr_str = "<tr>" +
                                    "<td align='center'>" + (i+1) + "</td>" +
                                    "<td align='center'>" + username + "</td>" +
                                    "<td align='center'>" + name + "</td>" +
                                    "<td align='center'>" + email + "</td>" +
                                    "</tr>";

                            $("#userTable tbody").append(tr_str);
                        }
                    }else if(response['data'] != null){
                        var tr_str = "<tr>" +
                                "<td align='center'>1</td>" +
                                "<td align='center'>" + response['data'].username + "</td>" +
                                "<td align='center'>" + response['data'].name + "</td>" +
                                "<td align='center'>" + response['data'].email + "</td>" +
                                "</tr>";

                        $("#userTable tbody").append(tr_str);
                    }else{
                        var tr_str = "<tr>" +
                                "<td align='center' colspan='4'>No record found.</td>" +
                                "</tr>";

                        $("#userTable tbody").append(tr_str);
                    }

                }
            });
        }
    </script>

    @endsection
