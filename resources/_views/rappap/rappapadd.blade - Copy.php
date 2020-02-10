@include('admin.inc.header')
@include('admin.inc.leftmenu')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add R.A.P/ P.A.P</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
<div id="server-results" style="color:#d9534f;font-weight: bold;font-size:18px;"></div>
<!-- /.row -->
 {!! Form::open(['url' => 'rap/pap/save','id' => 'applicant_form']) !!}
            <div class="row">
                <div class="col-md-2">   
                    <div class="form-group">
                        <label>Route</label>
                        <div style="margin-bottom:10px;">
                              <select id="multipleRoutes" multiple="multiple" style="width:150px;">
                                 @foreach ($routes as $routes_value)
                                    <option>{{$routes_value->route_name}} </option>
                                 @endforeach
                              </select>
                       </div>
                       <p class="routeselected"></p>
                       <input type="hidden" name="route" id="routefield">
                    </div>             
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label>Area</label>
                            <div style="margin-bottom:10px;">
                              <select id="multiplePorts" multiple="multiple" style="width:150px;">
                                 @foreach ($port as $port_value)
                                    <option>{{$port_value->port_name}} </option>
                                 @endforeach
                              </select>
                            </div>
                            <p class="portselected"></p>
                            <input type="hidden" name="port" id="portfield">
                    </div>                  
                </div>
            </div>

            <div class="row">             
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                  <select class="form-control" name="stickerType" required="required">
                                    <option>--Sticker Type--</option>
                                    @foreach($sticker as $sticker_value)
                                     <option value="{{$sticker_value->id}}">{{$sticker_value->sticker}}</option>
                                     @endforeach
                                 </select>
                             </div>
                        </div>
                        <div class="col-sm-3">
                             <div class="form-group"><input class="form-control"></div>
                        </div>
                        <div class="col-sm-1" style="padding:0;text-align: center;">To</div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input class="form-control">
                            </div>
                        </div>
                    </div>                   
                </div>
                 <div class="col-sm-6">
                    <div class="row">
                       <div class="col-sm-6">
                          <input type="date" name="arrivalDate" id="dt" class="form-control" onchange="mydate1();" />
                       </div>
             <div class="col-sm-6"><input type="date" name="derpartureDate" id="dt" class="form-control" onchange="mydate2();"></div>
                    </div>
                </div>
            </div>

<div class="control-group after-add-more">
     <div class="row">
        <div class="col-md-2"> 
            <div style="float:left;width:100px;"><input type="text" name="passportNo[]" class="form-control" placeholder="P.P. No"></div><div style="float:right;width:42px;margin-top:5px;"> <label style="font-weight:normal;"> <input type="radio" value="1" name="master_passport"> M.P</label></div>
        </div>
        <div class="col-md-2"> 
            <input type="text" name="visa_no[]" class="form-control" placeholder="Visa No">
        </div>
        <div class="col-md-2">
           <div style="float:left;"><input type="text" style="width:70px;" name="stickerNo[]" class="form-control" placeholder="Stic.No"></div><div style="float:right;"><input  style="width:70px;" type="text" name="fee[]" class="form-control" placeholder="Fee"> </div>
        </div>
        <div class="col-md-2"> 
            <input type="text" name="applicant_name[]" class="form-control" placeholder="Applicant Name"></div>
        <div class="col-md-2">   
            <div class="form-group">
                <select class="form-control" name="visaType[]">
                     <option value="">-- Visa Type --</option>
                    @foreach($visatype as $visatype_value)
                     <option value="{{$visatype_value->visa_type}}">{{$visatype_value->visa_type}}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2"> <input type="text" name="contactNo[]" class="form-control" placeholder="Contact No"></div>
     </div>     
 <div class="row">
      <!--<div class="col-md-2"></div>-->
       <div class="col-sm-2"  style="float:right;text-align: right;"> 
            <div class="input-group-btn"> 
                <button class="btn btn-success add-more" type="button" style="border-radius:4px;"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </div>
        </div>
  </div>

</div>  
                                           
                <div class="copy hide">
                    <div class="control-group" style="border-top:1px dashed #ccc;margin-top:15px;">
                        <div class="row" style="margin-top:15px;">
        <div class="col-md-2"> 
            <div style="float:left;width:100px;"><input type="text" name="passportNo[]" class="form-control" placeholder="P.P. No"></div><div style="float:right;width:42px;margin-top:5px;"> <label style="font-weight:normal;"> <input type="radio" value="1" name="master_passport"> M.P</label></div>
        </div>
        <div class="col-md-2"> 
            <input type="text" name="visa_no[]" class="form-control" placeholder="Visa No">
        </div>
        <div class="col-md-2">
           <div style="float:left;"><input type="text" style="width:70px;" name="stickerNo[]" class="form-control" placeholder="Stic.No"></div><div style="float:right;"><input  style="width:70px;" type="text" name="fee[]" class="form-control" placeholder="Fee"> </div>
        </div>
        <div class="col-md-2"> 
            <input type="text" name="applicant_name[]" class="form-control" placeholder="Applicant Name"></div>
        <div class="col-md-2">   
            <div class="form-group">
                <select class="form-control" name="visaType[]">
                     <option value="">-- Visa Type --</option>
                    @foreach($visatype as $visatype_value)
                     <option value="{{$visatype_value->visa_type}}">{{$visatype_value->visa_type}}</option>
                     @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-2"> <input type="text" name="contactNo[]" class="form-control" placeholder="Contact No"></div>
     </div>     
                        <div class="row">                         
                            <div class="col-md-12">
                                <div class="input-group-btn" style="text-align: right;"> 
                                    <button class="btn btn-danger remove" type="button" style="border-radius:4px;"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    


<div class="row" style="margin-top:15px;">
     <div class="col-sm-4">
        <div class="form-group">
            <input type="text" name="reMarks" class="form-control" placeholder="Enter Remarks">
        </div>
    </div>
 </div>
  <div class="row" style="text-align:right;">                              
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Submit</button>&nbsp;
            <button type="reset" class="btn btn-default">Reset </button>
        </div>
    </div>
     {!! Form::close() !!}
<br/>
<br/>
        
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


<script type="text/javascript">

function mydate1()
{
  d=new Date(document.getElementById("dt").value);
  dt=d.getDate();
  mn=d.getMonth();
  mn++;
  yy=d.getFullYear();
  document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
  document.getElementById("ndt").hidden=false;
  document.getElementById("dt").hidden=true;
}
function mydate2()
{
  d=new Date(document.getElementById("dt").value);
  dt=d.getDate();
  mn=d.getMonth();
  mn++;
  yy=d.getFullYear();
  document.getElementById("ndt").value=dt+"/"+mn+"/"+yy
  document.getElementById("ndt").hidden=false;
  document.getElementById("dt").hidden=true;
}



$(document).ready(function() {

///Using for multi select value for routes

//Displying Route Names
function displayRoute() {
  
var multipleRoutes = $( "#multipleRoutes" ).val() || [];

  $( ".routeselected" ).html(  " <b></b> " + multipleRoutes.join( ", " ) );
  $("#routefield").val(multipleRoutes.join( ", " )); 
}
 $( "select" ).change( displayRoute );
displayRoute();

//Displying Port Names

 function displayValsPort() {

var multiplePorts  = $( "#multiplePorts" ).val() || [];
 
  $( ".portselected" ).html(  " <b></b> " + multiplePorts.join( ", " ) );
  $("#portfield").val(multiplePorts.join( ", " ));
}

$( "select" ).change( displayValsPort );
displayValsPort();

///Using for multi select value for routes

//Form submit start
$("#applicant_forms").submit(function(event){
    event.preventDefault(); //prevent default action 
   var post_url = $(this).attr("action"); //get form action url

  //var post_url = 'http://localhost/pts/public/rap/pap/save';
    var request_method = $(this).attr("method"); //get form GET/POST method
    
    var form_data = $(this).serialize(); //Encode form elements for submission
     //alert(post_url);
    $.ajax({
        url : post_url,
        type: request_method,
        data : form_data
    }).done(function(response){ //
        $("#server-results").html(response);
    });
});
        //Form submit end


      $(".add-more").click(function(){ 

          var html = $(".copy").html();

          $(".after-add-more").after(html);

      });


      $("body").on("click",".remove",function(){ 

          $(this).parents(".control-group").remove();

      });


    });


</script>

@include('admin.inc.footer')