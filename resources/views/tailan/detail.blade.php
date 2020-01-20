@extends('layouts.master')

@section('style')
    <style>
        .highlight { background-color: lightskyblue }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">


            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">

        <div class="container-fluid">
            <div class="row">


                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="card"  style="margin-top: 20px">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">{{ trans('messages.hailt') }} </h3>
                                </div>

                            </div>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body text-center">
                            <form method="post"  @if($sprojecttype ==1 ) action="detailiz"  @elseif($sprojecttype ==2 ) action="detailib" @endif >
                                @csrf
                                <div class="col-md-12" data-scrollable="true" data-height="400" >
                                    <div class="row" >
                                        <div class="form-group col-md-2">
                                            <label for="inputEmail4">{{ trans('messages.on') }}</label>
                                            <select class="form-control select2" id="syear" name="syear"  onchange="javascript:location.href = 'filter_year/'+this.value;" >
                                                @foreach($year as $years)
                                                    <option value= "{{$years->year_id}}" @if($years->year_id==$syear_id) selected @endif>{{$years->year_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
    {{--     <div class="form-group col-md-2">
              <label for="inputAddress2">{{ trans('messages.ehelsen') }}</label>
              <input class="form-control form-control-inline input-medium date-picker" name="sdate1" id="sdate1"
                     size="16" type="text" value="">
          </div>
          <div class="form-group col-md-2">
              <label for="inputCity">{{ trans('messages.duussan') }}</label>
              <input class="form-control form-control-inline input-medium date-picker" name="sdate2" id="sdate2"
                     size="16" type="text" value="">
          </div>

          <div class="form-group col-md-2">
              <div class="form-group col-md-2">
                  <label for="inputZip"><span>.</span></label><br>
                  <button type="submit" class="btn btn-primary" >{{ trans('messages.haih') }}</button>

              </div>

          </div>
          --}}
      </div>
  </div>
</form>

</div>
<!-- /.card-body -->
</div>
<div class="card">
<div class="card-header">
<div class="row">
  <div class="col-md-6">
      <h3 class="card-title">{{ trans('messages.ibiz') }} </h3>
  </div>

</div>

</div>
<!-- /.card-header -->
<div class="card-body text-center">
<div class="col-md-2 pull-right">
  <button class="btn btn-info" id="export-btn" onclick="tableToExcel('example', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


</div>
<div class="table-responsive">
  <div class="row">
      <div class="col-md-12">
      <h3>{{ trans('messages.ywts') }} </h3>
      </div>
      <div class="col-md-12">
          <table class="table table-bordered" id="example" border="1" style="font-size:12px; border-collapse: collapse;">
              <thead>
              <?php $sum_plan = 0 ?>
              <?php $sum_percent = 0 ?>
              <?php $sum_rpercent = 0 ?>
              <?php $sum_budget = 0 ?>
              <?php $sum_ajliintoo = 0 ?>
              <?php $sum_haasan = 0 ?>
              <?php $sum_duussan = 0 ?>
              <?php $sum_gdag = 0 ?>
              <?php $sum_ghots = 0 ?>
              <?php $sum_gadgeree = 0 ?>
              <?php $sum_nem = 0 ?>
              <?php $sum_boloogui = 0 ?>
              <?php $sum_ehleegui = 0 ?>
              <?php $sum_duus = 0 ?>
              <tr role="row">
                  <th>#</th>
                  <th>{{ trans('messages.alba') }}</th>
                  <th>{{ trans('messages.tuluwluguu') }}</th>
                  <th>{{ trans('messages.guitsetgel') }}</th>
                  <th>{{ trans('messages.biylelt') }}</th>
                  <th>{{ trans('messages.ajliintoo') }}</th>
                  <th>{{ trans('messages.uunees') }}</th>
                  <th>{{ trans('messages.duussant') }}</th>
                  <th>{{ trans('messages.graphdaguu') }}</th>
                  <th>{{ trans('messages.graphhots') }}</th>
                  <th>{{ trans('messages.gadgeree') }}</th>
                  <th>{{ trans('messages.tuvnemelt') }}</th>
                  <th>{{ trans('messages.uliral') }}</th>
                  <th>{{ trans('messages.duus') }}</th>
                  <th>{{ trans('messages.ehleegui') }}</th>
              </tr>
              </thead>
              <tbody>
              <?php $no = 1; ?>
              @foreach($t as $projects)
                  <tr id="{{$projects->department_id}}">
                      <td>{{$no}}</td>
                      <td>{{$projects->department_name}}</td>

                      <td><?php
                          echo number_format($projects->plan)."<br>";
                          ?></td>
                      <?php $sum_plan += ($projects->plan) ?>
                      <td><?php
                          echo number_format($projects->budget)."<br>";
                          ?></td>
                      <?php $sum_budget += ($projects->budget) ?>

                      <td>{{number_format($projects->percent, 2, ',', '.')}}%</td>
                      <?php $sum_percent += ($projects->percent) ?>
                      <td>{{$projects->ajliintoo}}</td>
                      <?php $sum_ajliintoo += ($projects->ajliintoo) ?>
                      <td>{{$projects->haasan}}</td>
                      <?php $sum_haasan += ($projects->haasan) ?>
                      <td>{{$projects->duussan}}</td>
                      <?php $sum_duussan += ($projects->duussan) ?>
                      <td>{{$projects->gdag}}</td>
                      <?php $sum_gdag += ($projects->gdag) ?>
                      <td>{{$projects->ghots}}</td>
                      <?php $sum_ghots += ($projects->ghots) ?>
                      <td>{{$projects->gadgeree}}</td>
                      <?php $sum_gadgeree += ($projects->gadgeree) ?>
                      <td>{{$projects->nem}}</td>
                      <?php $sum_nem += ($projects->nem) ?>
                      <td>{{$projects->boloogui}}</td>
                      <?php $sum_boloogui += ($projects->boloogui) ?>
                      <td>{{$projects->duus}}</td>
                      <?php $sum_duus += ($projects->duus) ?>
                      <td>{{$projects->ehleegui}}</td>
                      <?php $sum_ehleegui += ($projects->ehleegui) ?>

                  </tr>
                  <?php $no++; ?>
              @endforeach
              <tr>
                  <td colspan="2">Нийт </td>
                  <td><?php
                      echo number_format($sum_plan)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_budget)."<br>";
                      ?></td>
                  <td>{{number_format(($sum_budget/$sum_plan)*100, 2, ',', '.')}}%</td>
                  <td><?php
                      echo number_format($sum_ajliintoo)."<br>";
                      ?></td>

                  <td>{{number_format($sum_haasan)}}</td>
                  <td>{{number_format($sum_duussan)}}</td>
                  <td>{{number_format($sum_gdag)}}</td>
                  <td>{{number_format($sum_ghots)}}</td>
                  <td>{{number_format($sum_gadgeree)}}</td>
                  <td>{{number_format($sum_nem)}}</td>
                  <td>{{number_format($sum_boloogui)}}</td>
                  <td>{{number_format($sum_duus)}}</td>
                  <td><?php
                      echo number_format($sum_ehleegui)."<br>";
                      ?></td>
              </tr>
              </tbody>
          </table>
      </div>
      <div class="col-md-2 offset-10">
          <button class="btn btn-info" id="export-btn" onclick="tableToExcel('example2', 'Export HTML Table to Excel')"><i class="fa fa-print" aria-hidden="true"></i> Excel</button>


      </div>
      <div class="col-md-12">
      <h3>{{ trans('messages.ehuwi') }} </h3>
      </div>

      <div class="col-md-12">
          <table class="table table-bordered" id="example2" border="1" style="font-size:12px; border-collapse: collapse;">
              <thead>
              <?php $sum_plan = 0 ?>
              <?php $sum_percent = 0 ?>
              <?php $sum_rpercent = 0 ?>
              <?php $sum_budget = 0 ?>
              <?php $sum_eune = 0 ?>
              <?php $sum_ezurag = 0 ?>
              <?php $sum_etul = 0 ?>
              <?php $sum_emater = 0 ?>
              <?php $sum_esanh = 0 ?>
              <?php $sum_eguits = 0 ?>
              <?php $sum_etusuv = 0 ?>
              <?php $sum_ehleegui = 0 ?>
              <?php $sum_egeree = 0 ?>
              <?php $sum_ealba = 0 ?>
              <?php $sum_esalbar = 0 ?>

              <tr role="row">
                  <th>#</th>
                  <th>{{ trans('messages.alba') }}</th>
                  <th>{{ trans('messages.eune') }}</th>
                  <th>{{ trans('messages.egeree') }}</th>
                  <th>{{ trans('messages.ezurag') }}</th>
                  <th>{{ trans('messages.etul') }}</th>
                  <th>{{ trans('messages.emat') }}</th>
                  <th>{{ trans('messages.esan') }}</th>
                  <th>{{ trans('messages.eguits') }}</th>
                  <th>{{ trans('messages.etusuv') }}</th>
                  <th>{{ trans('messages.guitsalba') }}</th>
                  <th>{{ trans('messages.guitssalbar') }}</th>

              </tr>
              </thead>
              <tbody>
              <?php $no = 1; ?>
              @foreach($t as $projects)
                  <tr id="{{$projects->department_id}}">
                      <td>{{$no}}</td>
                      <td>{{$projects->department_name}}</td>
                      <td>{{$projects->eune}}</td>
                      <?php $sum_eune += ($projects->eune) ?>
                      <td>{{$projects->egeree}}</td>
                      <?php $sum_egeree += ($projects->egeree) ?>
                      <td>{{$projects->ezurag}}</td>
                      <?php $sum_ezurag += ($projects->ezurag) ?>
                      <td>{{$projects->etul}}</td>
                      <?php $sum_etul+= ($projects->etul) ?>
                      <td>{{$projects->emater}}</td>
                      <?php $sum_emater += ($projects->emater) ?>
                      <td>{{$projects->esanh}}</td>
                      <?php $sum_esanh += ($projects->esanh) ?>
                      <td>{{$projects->eguits}}</td>
                      <?php $sum_eguits += ($projects->eguits) ?>
                      <td>{{$projects->etusuv}}</td>
                      <?php $sum_etusuv += ($projects->etusuv) ?>
                      <td>{{$projects->ealba}}</td>
                      <?php $sum_ealba += ($projects->ealba) ?>
                      <td>{{$projects->esalbar}}</td>
                      <?php $sum_esalbar += ($projects->esalbar) ?>
                  </tr>
                  <?php $no++; ?>
              @endforeach
              <tr>
                  <td colspan="2">Нийт </td>
                  <td><?php
                      echo number_format($sum_eune)."<br>";
                      ?></td>

                  <td><?php
                      echo number_format($sum_egeree)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_ezurag)."<br>";
                      ?></td>   <td><?php
                      echo number_format($sum_etul)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_emater)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_esanh)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_eguits)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_etusuv)."<br>";
                      ?></td>

                  <td><?php
                      echo number_format($sum_ealba)."<br>";
                      ?></td>
                  <td><?php
                      echo number_format($sum_esalbar)."<br>";
                      ?></td>

              </tr>
              </tbody>
          </table>

      </div>
      <div class="col-md-5">
          <canvas id="piechart" width="400" height="300"></canvas>

      </div>
      <div class="col-md-5 offset-1">

          <canvas id="visitors-chart" width="400" height="300"></canvas>

      </div>

  </div>
  <br>


</div>
</div>
<!-- /.card-body -->
</div>
</div>




<div class="row">
<div class="col-md-12">


</div>

</div>



</div>
</div>
</div>
</div>

<!-- /.col (right) -->



<!-- row 2 dood-->

</div>
</section>

@endsection

@section('script')

@include('layouts.script')

<?php
$stack = array();
$stack1 = array();
$stackValue = array();
$stackValue2 = array();
$depname = array();



foreach($t2 as $wag)

{array_push($stack,$wag->state_name_mn); array_push($stackValue,$wag->niit);array_push($stack1,$wag->state_name_ru); }


?>
<?php
foreach($t3 as $w)

{array_push($depname ,$w->department_name); array_push($stackValue2,$w->ajliintoo);}

?>
<script>
$(document).ready(function(){

var ticksStyle = {
fontColor: '#495057',
fontStyle: 'bold',
autoSkip: false
}

var mode = 'index'
var intersect = true


var zuuchName = <?php echo json_encode($stack); ?>;
var zuuchQnt = <?php echo json_encode($stackValue); ?>;
var zuuchName1 = <?php echo json_encode($depname); ?>;
var zuuchQnt1 = <?php echo json_encode($stackValue2); ?>;
var salesChart = $('#visitors-chart')
var myChart = new Chart(salesChart, {
type: 'bar',
data: {
labels:  zuuchName1,
datasets: [{
backgroundColor: '#007bff',
borderColor: '#007bff',
data: zuuchQnt1
}
]
},
options: {
title: {
display: true,
text: '{{ trans('messages.ehleeguiajil') }}'
},
maintainAspectRatio: true,

legend: {
display: false
},

scales: {
xAxes: [{
display: true,
    ticks: {
        beginAtZero: true   // minimum value will be 0.
    }
}],
    yAxes: [{
        display: true,
        ticks: {
            beginAtZero: true,
            steps: 10,

        }
    }]
},

}
})

$("#visitors-chart").click(function(e) {

var activePoints = myChart.getElementAtEvent(e);
if(activePoints.length > 0)
{

//get the internal index of slice in pie chart
var clickedElementindex = activePoints[0]["_index"];

//get specific label by index
var label = myChart.data.labels[clickedElementindex];

//get value by index
var value = myChart.data.id[clickedElementindex];

drawchart(value);
/* other stuff that requires slice's label and value */

}

});




var $visitorsChart = $('#percentchart')
var stack = <?php echo json_encode($stack); ?>;
var stack1 = <?php echo json_encode($stack1); ?>;
var stackValue = <?php echo json_encode($stackValue2); ?>;
var visitorsChart = new Chart($visitorsChart, {

data: {
labels: stack1,
datasets: [{
type: 'line',
data: stackValue,
backgroundColor: 'transparent',
borderColor: '#007bff',
pointBorderColor: '#007bff',
pointBackgroundColor: '#007bff',
fill: false
},
]
},
options: {
title: {
display: true
},
maintainAspectRatio: true,
legend: {
display: false
},
scales: {
yAxes: [{
ticks: $.extend({
  beginAtZero: true,
  suggestedMax: 100
}, ticksStyle)
}],
xAxes: [{
display: true,
gridLines: {
  display: false
},
ticks: ticksStyle
}],

}
}
})
var dynamicColors = function() {
var r = Math.floor(Math.random() * 255);
var g = Math.floor(Math.random() * 255);
var b = Math.floor(Math.random() * 255);
return "rgb(" + r + "," + g + "," + b + ")";
};
@if ( Config::get('app.locale') == 'en'){
new Chart(document.getElementById("piechart"), {
type: 'pie',
data: {
labels: stack1,
datasets: [{
label: zuuchName,
backgroundColor:  ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
  "#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
  "#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
  "#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
  "#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
  "#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
  "#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
  "#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
  "#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
  "#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
  "#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
  "#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
  "#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
  "#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
  "#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec"],
data: zuuchQnt
}]
},
options: {
title: {
display: true,
text: '{{ trans('messages.ibiztailbar') }}'
}
}
});
}
@else{new Chart(document.getElementById("piechart"), {
type: 'pie',
data: {
labels: stack,
datasets: [{
label: zuuchName,
backgroundColor:  ["#63b598", "#ce7d78", "#ea9e70", "#a48a9e", "#c6e1e8", "#648177" ,"#0d5ac1" ,
"#f205e6" ,"#1c0365" ,"#14a9ad" ,"#4ca2f9" ,"#a4e43f" ,"#d298e2" ,"#6119d0",
"#d2737d" ,"#c0a43c" ,"#f2510e" ,"#651be6" ,"#79806e" ,"#61da5e" ,"#cd2f00" ,
"#9348af" ,"#01ac53" ,"#c5a4fb" ,"#996635","#b11573" ,"#4bb473" ,"#75d89e" ,
"#2f3f94" ,"#2f7b99" ,"#da967d" ,"#34891f" ,"#b0d87b" ,"#ca4751" ,"#7e50a8" ,
"#c4d647" ,"#e0eeb8" ,"#11dec1" ,"#289812" ,"#566ca0" ,"#ffdbe1" ,"#2f1179" ,
"#935b6d" ,"#916988" ,"#513d98" ,"#aead3a", "#9e6d71", "#4b5bdc", "#0cd36d",
"#250662", "#cb5bea", "#228916", "#ac3e1b", "#df514a", "#539397", "#880977",
"#f697c1", "#ba96ce", "#679c9d", "#c6c42c", "#5d2c52", "#48b41b", "#e1cf3b",
"#5be4f0", "#57c4d8", "#a4d17a", "#225b8", "#be608b", "#96b00c", "#088baf",
"#f158bf", "#e145ba", "#ee91e3", "#05d371", "#5426e0", "#4834d0", "#802234",
"#6749e8", "#0971f0", "#8fb413", "#b2b4f0", "#c3c89d", "#c9a941", "#41d158",
"#fb21a3", "#51aed9", "#5bb32d", "#807fb", "#21538e", "#89d534", "#d36647",
"#7fb411", "#0023b8", "#3b8c2a", "#986b53", "#f50422", "#983f7a", "#ea24a3",
"#79352c", "#521250", "#c79ed2", "#d6dd92", "#e33e52", "#b2be57", "#fa06ec"],
data: zuuchQnt
}]
},
options: {
title: {
display: true,
text: '{{ trans('messages.ibiztailbar') }}'
}
}
});

}
@endif







});

var tableToExcel = (function () {
var uri = 'data:application/vnd.ms-excel;base64,'
, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body>        <p><center><b> @if($sprojecttype ==1 ) {{ trans('messages.tailanbarilga') }}  @elseif($sprojecttype ==2 ){{ trans('messages.tailanzaswar') }}  @endif</b></center> </p><table border="1">{table}</table>   <center><b></b></center> <span> ТАЙЛАН ГАРГАСАН:</span><span style="margin-left: 180px"> {{ Auth::user()->name }}</span></body></html>'
, base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
, format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
return function (table, name) {
if (!table.nodeType) table = document.getElementById(table)
var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
var blob = new Blob([format(template, ctx)]);
var blobURL = window.URL.createObjectURL(blob);

if (ifIE()) {
csvData = table.innerHTML;
if (window.navigator.msSaveBlob) {
var blob = new Blob([format(template, ctx)], {
type: "text/html"
});
navigator.msSaveBlob(blob, '' + name + '.xls');
}
}
else
window.location.href = uri + base64(format(template, ctx))
}
})()
function ifIE() {
var isIE11 = navigator.userAgent.indexOf(".NET CLR") > -1;
var isIE11orLess = isIE11 || navigator.appVersion.indexOf("MSIE") != -1;
return isIE11orLess;
}
</script>

@endsection