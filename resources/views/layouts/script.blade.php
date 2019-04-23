<script type="text/javascript">

    $('.money').inputmask("numeric", {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,

        rightAlign: false,
        oncleared: function () { self.Value(''); }
    });
    $(".year").inputmask('9999');
    $(".month").inputmask('99');
</script>
<script>
    function updateproj($id){

        var title = document.getElementById("modal-title");
        title.innerHTML = "Их барилга, их засварын ажил засварлах цонх";
        document.getElementById('form1').action = "updateproject";
        document.getElementById('form1').method ="post"
        var itag=$id;

        $.get('projectfill/'+itag,function(data){
            $.each(data,function(i,qwe){

                $('#id').val(qwe.project_id);
                $('#project_name').val(qwe.project_name);
                $('#budget').val(qwe.budget);
                $('#estimation').val(qwe.estimation);
                $('#plan').val(qwe.plan);
                $('#constructor_id').val(qwe.department_id);
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
            });

        });
        $('#deleteproj').show();
    };
    function updateproc($id){

        var title = document.getElementById("modal-title2");
        title.innerHTML = "Их барилга, их засварын ажлын гүйцэтгэл засварлах цонх";
        document.getElementById('form3').action = "updateprocess";
        document.getElementById('form3').method ="post"
        var itag=$id;
        $.get('processfill/'+itag,function(data){
            $.each(data,function(i,qwe){
                $('#eprocess_id').val(qwe.process_id);
                $('#eproject_id').val(qwe.project_id);
                $('#ebudget').val(qwe.budget);
                $('#emonth').val(qwe.month);
                $('#edescription').val(qwe.description);
                $('#eyear').val(qwe.year);
                $('#estate_id').val(qwe.state_id);
            });

        });
        $('#deleteprocess').show();
    };
    $('.process').on('click',function(){
        var itag=$(this).attr('tag');
        $.get('projectfill/'+itag,function(data){
            $("#projecttable tbody").empty();
            $.each(data,function(i,qwe){
                $('#gproject_id').val(qwe.project_id);
                var sHtml = " <tr class='table-row' >" +

                    "   <td class='m1'>" + qwe.department_name + "</td>" +
                    "   <td class='m1'>" + qwe.executor_abbr + "</td>" +
                    "   <td class='m1'>" + qwe.project_name + "</td>" +
                    "   <td class='m1'>" + number_format( qwe.plan ) + "</td>" +
                    "   <td class='m1'>" + number_format( qwe.estimation ) + "</td>" +
                    "   <td class='m1'>" + number_format( qwe.estimation )+ "</td>" +
                    "   <td class='m1'>" + number_format( qwe.economic ) + "</td>" +
                    "   <td class='m1'>" + qwe.percent + "</td>" +
                    "   <td class='m1'>" + qwe.firstname + "</td>" +
                    "   <td class='m1'>" + qwe.start_date + "</td>" +
                    "   <td class='m1'>" + qwe.end_date + "</td>" +
                    "   <td class='m1'>" + qwe.state_name_mn + "</td>" +
                    "</tr>";

                $("#projecttable tbody").append(sHtml);


            });

        });
        getproc(itag);
    });
</script>
<script>

    $('#addproj').on('click',function(){
        var title = document.getElementById("modal-title");
        title.innerHTML = "Их барилга, их засварын ажил бүртгэх цонх";
        document.getElementById('form1').action = "addproject"
        document.getElementById('form1').method ="post"
        $('#id').val('');
        $('#budget').val('');
        $('#estimation').val('');
        $('#plan').val('');
        $('#constructor_id').val('1');
        $('#project_type').val('1');
        $('#respondent_emp_id').val('1');
        $('#state_id').val('1');
        $('#method_code').val('1');
        $('#percent').val('');
        $('#executor_id').val('1');
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
    $('#deleteproj').on('click',function(){
        var itag = $('#id').val();

        $.ajax(
            {
                url: "project/delete/" + itag,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": itag,
                    "_method": 'DELETE',
                },
                success: function () {
                    alert('Их барилга, их засварын ажил устгагдлаа');
                }

            });
        alert('Их барилга, их засварын ажил устгагдлаа');
        location.reload();
    });
    $('#deleteprocess').on('click',function(){

        var itag = $('#eprocess_id').val();
        var tag = $('#eproject_id').val();

        $.ajax(
            {
                url: "process/delete/" + itag,
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
        getproc(tag);
        $('#eprocessmodal').modal('hide');
    });
    function getproc($id){
        $.get('projectprocessfill/'+$id,function(data){
            $("#processtable tbody").empty();
            $.each(data,function(i,qwe){

                var sHtml = " <tr class='table-row' >" +

                    "   <td class='m1'>" + qwe.year + " - " + qwe.month+"</td>" +
                    "   <td class='m1'>" + qwe.budget+ "</td>" +
                    "   <td class='m1'>" + qwe.description + "</td>" +
                    "   <td class='m1'>" + qwe.image_b+ "</td>" +
                    "   <td class='m1'> <button id='updateproc' class='btn btn-xs btn-success' data-toggle='modal' data-target='#eprocessmodal' data-id=" + qwe.process_id + " tag=" + qwe.process_id + " onclick='updateproc("+qwe.process_id+")'>  <i class='fa fa-pencil' style='color: rgb(255, 255, 255);'></i></button></td>" +

                    "</tr>";

                $("#processtable tbody").append(sHtml);


            });

        });
    }
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    $('#addprocessbutton').on('click',function(){
        event.preventDefault();
        var itag = $('#gproject_id').val();
        $.ajax({
            type: 'POST',
            url: 'addprocess',
            data: $('#form2').serialize(),
            success: function(){
                alert('Их барилга, их засварын ажлын гүйцэтгэл бүртгэгдлээ');//this will alert you the last_id
                getproc(itag);
                $('#processmodal').modal('hide');
            }
        })

    });
    $('#form3').submit(function(event){
        event.preventDefault();

        var itag = $('#gproject_id').val();
        $.ajax(
            {
                type: 'POST',
                url: 'updateprocess',
                data: $('form#form3').serialize(),
                success: function ()
                {
                    alert('Ажлын гүйцэтгэл засагдлаа');
                    getproc(itag);
                    $('#eprocessmodal').modal('hide');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    }
                }
            });



    });
</script>