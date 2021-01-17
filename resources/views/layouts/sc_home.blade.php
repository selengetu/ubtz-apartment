<script>
    $("#method_code").on('change', function() {
        var itag =$(this).val();
        checkgeree(itag);

        var dep = $("#childabbr_id").val();
       console.log(dep);
        if(itag == 1) {
            $('#executor_id').val(dep).prop('selected', true);
        }
    });
    $("#childabbr_id").on('change', function() {
        var itag =$(this).val();
        var type = $("#method_code").val();
        if(type == 1) {

            $('#executor_id').val(itag).prop('selected', true);

        }
    });
    function preview_imagedet($id){
        $('#pprocess_id').val($id);

        $.get('getimagedet/'+$id,function(data){
            $("#imagetable tbody").empty();
            $.each(data,function(i,qwe){
                var sHtml = " <tr class='table-row' >" +

                    "   <td class='m1'> <img width='100%' src='profile_images/img/"+ qwe.img_bname +"'/></td>" +
                    "   <td class='m1'> <button class='btn btn-danger' onclick=deletepicture(" + qwe.img_id+ ","+ qwe.process_id+")><i class='fa fa-trash' aria-hidden='true'></i></button></td>" +

                    "</tr>";
                $("#imagetable tbody").append(sHtml);
            });

        });
    }
    function checkgeree($id) {
        if($id == 3){

            $('#gereediv').show();
        }
        else{
            $('#gereediv').hide();
        }
        $.get('getexec/'+$id,function(data){
            $('#executor_id').empty();

            $.each(data,function(i,qwe){
                $('#executor_id').append($('<option>', {
                    value: qwe.executor_id,
                    text: qwe.executor_abbr
                }));
            });
        });

    }
    function deletepicture($id,$id1)
    {


        $.ajax(
            {
                url: "picture/delete/"+$id+"/"+$id1,
                type: 'GET',
                dataType: "JSON",
                data: {
                    "id": $id,
                    "_method": 'DELETE',

                },
                success: function ()
                {
                    alert('Зураг устгагдлаа');
                    preview_imagedet($id1);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status == 500) {
                        alert('Internal error: ' + jqXHR.responseText);
                    } else {
                        alert('Unexpected error.');
                    }
                }
            });
    }
    $(function() {
        $("#date1").datepicker({
            format: 'yyyy-mm-dd',
            todayBtn:  1,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#date2').datepicker('setStartDate', minDate);
        });

        $("#date2").datepicker({
            format: 'yyyy-mm-dd',
        })
            .on('changeDate', function (selected) {
                var minDate = new Date(selected.date.valueOf());
                $('#date1').datepicker('setEndDate', minDate);
            });
    });
    $(document).ready(function() {

        const gproject_id = {{ $gproject_id }};
        if(gproject_id != 0){
            processClicked( gproject_id);
        }
        $('#example').dataTable( {
            stateSave: true,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            "language": {
                "lengthMenu": " _MENU_ бичлэг",
                "zeroRecords": "Бичлэг олдсонгүй",
                "info": "_PAGE_ ээс _PAGES_ хуудас" ,
                "infoEmpty": "Бичлэг олдсонгүй",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "Хайлт:",
                "paginate": {
                    "first":      "Эхнийх",
                    "last":       "Сүүлийнх",
                    "next":       "Дараагийнх",
                    "previous":   "Өмнөх"
                },
            },
            "pageLength": 10
        } );
        $('.plans').change( function() {
            var a = ($('#plan1').val()).replace(/[_\W]+/g, "");
            var b = ($('#plan2').val()).replace(/[_\W]+/g, "");
            var c = ($('#plan3').val()).replace(/[_\W]+/g, "");
            var d = ($('#plan4').val()).replace(/[_\W]+/g, "");          
            var sum= Number(a)+Number(b)+Number(c)+Number(d);
            $('#plan').val(sum);
            });
        $('#export-btn').on('click', function(e){
            $("#example").table2excel({

                exclude: ".noExl",
                name: "Worksheet Name",
                filename: "SomeFile" //do not include extension
            });
        });
        function printDiv() {

            var divToPrint=document.getElementById("example");
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        }

    } );
</script>
<script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
