 $(function () {
    //var base_url = window.location.origin+'/dosen/ajax_g_jad';
//    $.ajaxSetup({
//            type:"POST",
//            url: base_url,
//            cache: false,
//            dataType: "JSON"
//    });
    var ihari = $("#iharih").val();
    var djam = $("#djam").val();
    $("#djam").change(function(){
        
         $.ajax({
        url: "/dosen/ajax_g_jad", 
        type: "POST",             
        data: {cek: 'CEKJAM',ihari:ihari,djam:djam},
        dataType: 'json',
        cache: false,
        success: function(data)
        {
            //alert(data[0].RUANGAN_ID+ ' '+ data[0].KETERANGAN);
//                    if(dataObj){
//                        $(dataObj).each(function(){
//                            var option = $('<option />');
//                            option.attr('value', this.id).text(this.name);           
//                            $('#city').append(option);
//                        });
//                    }else{
//                        $('#city').html('<option value="">City not available</option>');
//                    }
//             
             $('#druangan').html('<option value="pilih">Select Ruangan</option>'); 
//             
            $("#druangan").val('pilih');
//            var a;
             for(   a=0; a < data.length;a++)
             {
                var opt = document.createElement("option");
                 document.getElementById("druangan").innerHTML += '<option id="'+data[a].RUANGAN_ID+'">'+ data[a].RUANGAN_ID +' '+data[a].KETERANGAN + '</option>';
//                 alert(data.length);
//                 alert(data[0].RUANGAN_ID+ ' '+ data[0].KETERANGAN);
             }
        },
        error: function (request, status, status) {
//            /alert(count(data.length));
//             $("#druangan").html(respond);
//            $("#druangan").val('pilih');
            //console.log(error);
//           /alert(request+status+' '+status);
        }
    });
        
//        $.ajax({
//            data:{cek:'cekJam'},
//            success: function(respond){
//                    $("#druangan").html(respond);
//                    $("#druangan").val('pilih');
//                },
//                error: function (jqXHR, textStatus, errorThrown)
//                {
//                alert(jqXHR+' '+textStatus+' '+errorThrown);
//
//                alert('Error get data from ajax');
//                }
//                }
//		);

    });
 });