<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
<script type="text/javascript">

    $('#gstate_id').change(function() {
        var item=$(this).val();

        if(item == 1 || item == 2){
            $('#gpercentdiv').show();
            $('#gdatediv').show();
        }
        else{
            $('#gpercentdiv').hide();
            $('#gdatediv').hide();
        }
    });
    $('.money').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,

        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
    $(".year").inputmask('9999');

</script>
<script>
    function updateproj($id){

        var title = document.getElementById("modal-title");
        title.innerHTML = "{{ trans('messages.tsonhzas') }}";

        $('#type').val('2');
        var itag=$id;

        $.get('projectfill/'+itag,function(data){
            $.each(data,function(i,qwe){

                $('#id').val(qwe.project_id);
                $('#project_name').val(qwe.project_name);
                $('#project_name_ru').val(qwe.project_name_ru);
                $('#budget').val(qwe.budget);
                $('#estimation').val(qwe.estimation);
                $('#plan').val(qwe.plan);
                $('#geree').val(qwe.contract);
                $('#gereenum').val(qwe.contract_num);
                $('#constructor_id').val(qwe.department_id);
                $('#childabbr_id').val(qwe.department_child);
                if(qwe.method_code == 3){
                    checkgeree(3);
                }
                $('#project_type').val(qwe.project_type);

                $('#respondent_emp_id').val(qwe.respondent_emp_id);
                $('#state_id').val(qwe.state_id);
                $('#method_code').val(qwe.method_code);
                $('#percent').val(qwe.percent);
                $('#executor_id').val(qwe.executor_id);
                $('#economic').val(qwe.economic);
                $('#description').val(qwe.description);
                $('#date1').val(qwe.start_date);
                $('#date2').val(qwe.end_date);
                $('#prdate1').val(qwe.prstart_date);
                $('#prdate2').val(qwe.prend_date);
                $('#plan1').val(qwe.plan1);
                $('#plan2').val(qwe.plan2);
                $('#plan3').val(qwe.plan3);
                $('#plan4').val(qwe.plan4);
                $('#season').val(qwe.planseason);
            });

        });
        $('#deleteproj').show();
    };
    function updateproc($id){

        var title = document.getElementById("modal-title1");
        title.innerHTML = "{{ trans('messages.guitszas') }}";
        document.getElementById('form2').action = "updateprocess";
        document.getElementById('form2').method ="post"
        var itag=$id;

        $.get('processfill/'+itag,function(data){
            $.each(data,function(i,qwe){

                $('#gprocess_id').val(qwe.process_id);
                $('#gproject_id').val(qwe.project_id);
                $('#gbudget').val(qwe.budget);
                $('#gdate').val(qwe.prend_date);
                $('#gmonth').val(qwe.month);
                $('#gdescription').val(qwe.description);
                $('#gyear').val(qwe.year);
                $('#gstate_id').val(qwe.state_id);
                $("#gimage").attr("src", qwe.image_s);


            });

        });
        $('#deleteprocess').show();
    };
    function getproject($id){
        var itag = $id;
        $.get('projectfill/'+itag,function(data){
            $("#projecttable tbody").empty();
            $("#plantable tbody").empty();
            $.each(data,function(i,qwe){
                var $type;
                var $type1;
                var $type2;
                var $type3;
                var $type4;
                var $type5;
                var $type6;
                if(qwe.plan == null){
                    $type= ''
                }
                else{
                    $type= qwe.plancomma;
                }
                if(qwe.estimation == null){
                    $type1= ''
                }
                else{
                    $type1= qwe.estimationcomma;
                }
                if(qwe.budget == null){
                    $type2= ''
                }
                else{
                    $type2= qwe.budgetcomma;
                }
                if(qwe.economic == null){
                    $type3= ''
                }
                else{
                    $type3= qwe.economiccomma;
                }
                if(qwe.percent == null){
                    $type4= ''
                }
                else{
                    $type4= qwe.percent;
                }
                if(qwe.start_date == null){
                    $type5= ''
                }
                else{
                    $type5= qwe.start_date;
                }
                if(qwe.end_date == null){
                    $type6= ''
                }
                else{
                    $type6= qwe.end_date;
                }
                $('#gproject_id').val(qwe.project_id);
                var sHtml = " <tr class='table-row' >" +

                    "   <td class='m1'>" + qwe.department_name + " - "+ qwe.childabbr + "</td>" +
                    "   <td class='m1'>" + qwe.executor_abbr + "</td>" +
                    "   <td class='m1'>" + qwe.project_name + "</td>" +
                    "   <td class='m1'>" + $type+ "</td>" +
                    "   <td class='m1'>" + $type1 + "</td>" +
                    "   <td class='m1'>" + $type2+ "</td>" +
                    "   <td class='m1'>" + $type3 + "</td>" +
                    "   <td class='m1'>" + $type4 + "</td>" +
                    "   <td class='m1'>" + qwe.firstname + "</td>" +
                    "   <td class='m1'>" + $type5 + "</td>" +
                    "   <td class='m1'>" + $type6 + "</td>" +
                    "   <td class='m1'>" + qwe.state_name_mn + "</td>" +
                    "</tr>";

                $("#projecttable tbody").append(sHtml);
                var sHtml1 = " <tr class='table-row' >" +

                    "   <td class='m1'>" + qwe.plancomma + "</td>" +
                    "   <td class='m1'>" + qwe.plan1comma + "</td>" +
                    "   <td class='m1'>" + qwe.plan2comma + "</td>" +
                    "   <td class='m1'>" + qwe.plan3comma + "</td>" +
                    "   <td class='m1'>" + qwe.plan4comma + "</td>" +
                    "</tr>";

                $("#plantable tbody").append(sHtml1);

            });

        });
    }
    $('.process').on('click',function(){
        var itag=$(this).attr('tag');
        getproject(itag);
        getproc(itag);
    });
    $('#nav-home-tab').on('click',function(){
        $( "#nav-profile-tab" ).addClass("disabled disabledTab");
    });
    function processClicked(processid) {
        $( "#nav-profile-tab" ).removeClass("disabled disabledTab");
        $('#nav-profile-tab').trigger('click');

        getproject(processid);
        getproc(processid);
    }
</script>
<script>

    $('#addproj').on('click',function(){
        var title = document.getElementById("modal-title");
        $('#type').val('1');
        title.innerHTML = "Их барилга, их засварын ажил бүртгэх цонх";

        $('#id').val('');
        $('#budget').val('');
        $('#project_name_ru').val('');
        $('#project_name').val('');
        $('#estimation').val('');
        $('#plan').val('');
        $('#constructor_id').val('999');
        $('#childabbr_id').val('999');
        $('#project_type').val('1');
        $('#respondent_emp_id').val('999');
        $('#state_id').val('1');
        $('#season').val('1');
        $('#method_code').val('1');
        $('#percent').val('');
        $('#executor_id').val('999');
        $('#economic').val('');
        $('#description').val('');
        $('.delete').hide();

    });
    $('#addproc').on('click',function(){
        $('#gprocess_id').val('');
        $('#gbudget').val('');
        $('#gmonth').val('');
        $('#gdescription').val('');
        $('#grespondent_emp_id').val('1');
        $('#gyear').val('');
        $('#gstate_id').val('1');
        $('.delete').hide();
    });
    function deleteproj($id){

        $.ajax(
            {
                url: "project/delete/" + $id,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": $id,
                    "_method": 'DELETE',
                },
                success: function () {
                    alert('Их барилга, их засварын ажил устгагдлаа');
                }

            });
        alert('Их барилга, их засварын ажил устгагдлаа');
        location.reload();

    }


    $('#deleteproc').on('click',function(){

        var itag = $('#gprocess_id').val();
        var tag = $('#gproject_id').val();

        $.ajax(
            {
                url: "process/delete/" + itag+"/"+ tag,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": itag,
                    "_method": 'DELETE',
                },
                success: function () {
                    alert('Их барилга, их засварын ажлын гүйцэтгэл устгагдлаа');
                }

            });
        alert('Их барилга, их засварын ажлын гүйцэтгэл устгагдлаа');
        getproject(tag);
        getproc(tag);
        $('#processmodal').modal('hide');
    });
    $('#approveproj').on('click',function(){

        event.preventDefault();
        var itag = $('#gprocess_id').val();
        var tag = $('#gproject_id').val();

        $.ajax(
            {
                type: 'POST',
                url: 'approveproj',
                data: $('form#form1').serialize(),
                success: function ()
                {
                    alert(' Баталгаажилт хийгдлээ.');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    }
                }
            });


        location.reload();
    });
    $('#approveproc').on('click',function(){

        event.preventDefault();
        var itag = $('#gprocess_id').val();
        var tag = $('#gproject_id').val();

        $.ajax(
            {
                type: 'POST',
                url: 'approveproc',
                data: $('form#form2').serialize(),
                success: function ()
                {
                    alert(' Баталгаажилт хийгдлээ.');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    }
                }
            });
        getproject(tag);
        getproc(tag);
        $('#processmodal').modal('hide');
    });
    $('#form1').submit(function(event){
        var itag = $('#type').val();

        event.preventDefault();


        if(itag == 1){
            $.ajax({
                type: 'POST',
                url: 'addproject',
                data: $('form#form1').serialize(),
                success: function(){
                    alert('Ажил нэмэгдлээ');
                    location.reload();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })

        }
        if(itag == 2){
            $.ajax({
                type: 'POST',
                url: 'updateproject',
                data: $('form#form1').serialize(),
                success: function(){
                    alert('Ажил засварлагдлаа');
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            })

        }



    });
    function getproc($id){
        $.get('projectprocessfill/'+$id,function(data){
            $("#processtable tbody").empty();
            $.each(data,function(i,qwe){
                var $approve;
                var $date;
                if(qwe.is_lock == 1){
                    $approve=''
                }
                if(qwe.is_lock == 0){
                    $approve= "<button id='updateproc' class='btn btn-xs btn-warning' data-toggle='modal' data-target='#processmodal' data-id=" + qwe.process_id + " tag=" + qwe.process_id + " onclick='updateproc("+qwe.process_id+")'>  <i class='fa fa-pencil' style='color: rgb(255, 255, 255);'></i></button>"
                }

                var $type;
                var $im;
                var $bud;
                if(qwe.description == null){
                    $type= ''
                }
                else{
                    $type= qwe.description;
                }
                if(qwe.budgetcomma == null){
                    $bud= ''
                }
                else{
                    $bud= qwe.budgetcomma;
                }
                if(qwe.image_b == null || qwe.image_b == 0){
                    $im= ''
                }
                else{
                    $im="<button type='button' class='btn btn-primary add' data-toggle='modal' data-target='#processimagemodal' onclick='preview_imagedet("+qwe.process_id+")'><i class='fa fa-picture-o' aria-hidden='true'></i></button>";
                }
                if(qwe.state_id != 1 || qwe.prend_date == null){
                    $date= ''
                }
                else{

                    $date= qwe.prend_date;
                }
                var sHtml = " <tr class='table-row' >" +

                    "   <td class='m1'>" + qwe.year + " - " + qwe.month+"</td>" +
                    "   <td class='m1'>" + $bud+ "</td>" +
                    "   <td class='m1'>" + qwe.state_name_mn+ " "+ $date+"</td>" +
                    "   <td class='m1'>" + $type + "</td>" +
                    "   <td class='m1'>" + $im + "</td>" +
                    "   <td class='m1'>"+ $approve + "</td>" +

                    "</tr>";

                $("#processtable tbody").append(sHtml);


            });

        });
    }
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

</script>