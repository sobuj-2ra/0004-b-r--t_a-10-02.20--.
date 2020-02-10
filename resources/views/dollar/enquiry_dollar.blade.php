@extends('admin.master')
<!--Page Title-->
@section('page-title')
    Dollar Endorsement
@endsection

<!--Page Header-->
@section('page-header')
    Enquiry - Dollar Endorsement
@endsection

<!--Page Content Start Here-->
@section('page-content')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="col-md-4 col-md-offset-4" style="padding-top:10px">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4> {{ Session::get('message') }}</h4>
                        </div>
                    </div>
                @endif
                <div class="main_part">
                    <form action="{{url('search-enquiry')}}" method="get" role="search">
                        {{ csrf_field() }}

                        <div class="passport_search">
                            <div class="row">
                                <h4 class="text-center " style="font-weight: bold">Enquiry Dollar Endorsement</h4>
                                <div class="col-md-4" style="padding-right: 0px;padding-left: 0px">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="entity" value="passport" required=""> Passport
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 0px;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="entity" value="name"> Name
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 0px;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="radio" name="entity" value="travel_card"> Travel Card
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <input type="search" name="q" value="" placeholder="Search" required>
                            <button type="submit" class="btn_search">Search</button>
                        </div>
                    </form>
                    <div class="result_body">
                        <div class="result_table">
                            <?php if (isset($print_data) && !empty($print_data)){ ?>
                            <button value="Voucher Print" onclick="printDiv('printableArea')" class="btn_approved">Print</button>
                            <br>
                            <br>
                            <style>
                                @media print {
                                    @page layout {
                                        size: portrait;

                                    }
                                }
                            </style>
                            <br>
                            <div id="printableArea">
                                <div class="table_view" style="padding: 10px">
                                    <div class="panel-body">
                                        <table width="100%" class="table-bordered table" style="font-size:14px;">
                                            <thead style="background:#ddd">
                                            <tr>
                                                <th>SL</th>
                                                <?php if ($first_entity == 'passport'){ ?>
                                                <th>Passport Number</th>
                                                <th>Card Number</th>
                                                <th>Name</th>
                                                <?php }elseif ($first_entity == 'name'){ ?>
                                                <th>Name</th>
                                                <th>Passport Number</th>
                                                <th>Card Number</th>
                                                <?php }elseif ($first_entity == 'travel_card'){ ?>
                                                <th>Card Number</th>
                                                <th>Passport Number</th>
                                                <th>Name</th>
                                                <?php } ?>
                                                <th>Date of issuance</th>
                                                <th> Amount in USD</th>
                                                <th>Contact Number</th>
                                                <th>Centre of issuance</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php $i=0; foreach ($print_data as $print_datum) { $i++; ?>
                                                <td><?php echo $i; ?></td>
                                                <?php if ($first_entity == 'passport'){ ?>
                                                <td><?php  echo $print_datum->passport_no; ?></td>
                                                <td><?php echo $print_datum->digit; ?></td>
                                                <td><?php echo $print_datum->a_name; ?></td>
                                                <?php }elseif ($first_entity == 'name'){ ?>
                                                <td><?php echo $print_datum->a_name; ?></td>
                                                <td><?php  echo $print_datum->passport_no; ?></td>
                                                <td><?php echo $print_datum->digit; ?></td>
                                                <?php }elseif ($first_entity == 'travel_card'){ ?>
                                                <td><?php echo $print_datum->digit; ?></td>
                                                <td><?php  echo $print_datum->passport_no; ?></td>
                                                <td><?php echo $print_datum->a_name; ?></td>
                                                <?php } ?>
                                                <td><?php echo date('d-m-Y', strtotime($print_datum->date_of_issue)); ?></td>
                                                <td><?php echo $print_datum->f_currency; ?></td>
                                                <td><?php echo $print_datum->a_mobile; ?></td>
                                                <td><?php echo $print_datum->place_of_issue; ?></td>
                                            <?php if ($i > 0){
                                                echo '</tr><tr>';
                                            } }  ?>

                                            </tbody>
                                        </table>
                                        <!-- /.table-responsive -->

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function printDiv(divName) {

            var css = '@page { size: portrait; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
                style.styleSheet.cssText = css;
            } else {
                style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
    <script>
        //window.onload = printDiv('printableArea');
        $(window).on('afterprint', function () {
            window.location.href="{{ url("/enquiry-dollar") }}";
        });
    </script>
@endsection


