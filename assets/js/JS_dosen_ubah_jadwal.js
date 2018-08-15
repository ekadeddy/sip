
 $(function () {
    var base_url = window.location.origin+'/dosen/ajax_change_jd';
        
    $.ajaxSetup({
        type:"POST",
        url: base_url,
        dataType: "JSON"
    });
    
    //cek tanggal valid
    $("#itanggal").change(function(){
        var itanggal=$('#itanggal').val();
        $.ajax({
                data:{cek:'CEKTANGGAL',itanggal:itanggal},
                success: function(data){
                    //alert(data.hari);
                    if(data.hari == 'SABTU' || data.hari == 'MINGGU')
                    {
                        alert('Tidak boleh hari '+ data.hari);
                        $('#itanggal').val('');
                    }
                    else
                    {
                        if(data.status == true)
                        {                           
                            $('#iharih').val(data.hari);
                             //alert($("#ijadwal_id").val());
                        }
                        else
                        {
                            alert('pengajuan hanya boleh untuk petemuan yang akan datang!');
                            $('#itanggal').val('');
                        }

                    }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
//                                        /alert(base_url);

                            alert('Error get data from ajax');
                    }
                            }
                    );

    });
    
    //cek raungan di jam tertentu
//    $("#djam").change(function(){
//        
//        $.ajaxSetup({
//		type:"POST",
//		url: base_url,
//		cache: false    
//	});
//        
//        var jam=$('#djam').val();
//        var ihari=$('#iharih').val();
//       $.ajax({
//                                        data:{cek:'CEKJAM', djam:jam, ihari:ihari},
//
//                                        success: function(respond){
//                                                $("#druangan").html(respond);
//                                                $("#druangan").val('pilih');
//
//                                        },
//                                        error: function (jqXHR, textStatus, errorThrown)
//                                        {
//                                                //alert(base_url);
//
//                                                alert('Error get data from ajax'+jqXHR+textStatus+errorThrown);
//                                        }
//                                }
//                        );
////        $.ajax({
////                    data:{cek:'CEKJAM',hari:ihari,jam:jam},
////                    success: function(respond){
////                        
////
////                        $("#druangan").html(respond);
////                        $("#druangan").val('pilih');
////
////                    },
////                    error: function (jqXHR, textStatus, errorThrown)
////                    {
////                        alert($('#iharih').val());
////                        alert($('#djam').val());
////                        alert('Error get data from ajax'+jqXHR+textStatus+errorThrown);
////                    }
////                }
////        );
//
//
//        });
        
        //Date picker
    $('#itanggal').datepicker({
      autoclose: true
    });

  });
  


function gantiJadwal(jadwal_id) 
{
    //var base_url = window.location.origin+'/dosen/ajax_dosen_ubah';
    var base_url = window.location.origin+'/dosen/ajax_change_jd';
    
    
    $.ajaxSetup({
        type:"POST",
        url: base_url,
        dataType: "JSON"
    });
    $('#modal-ganti-jadwal').modal('show'); // show bootstrap modal when complete loaded 

    //alert(jadwal_id);
    $.ajax({
                data:{cek:'gantiJadwal', jadwal_id:jadwal_id},

                success: function(data){
                    //alert(data.JADWAL_ID);
                    //var a = JSON.parse(respond);
                    $("#ikelas").val(data.KELAS_NAMA);
                    $("#ijadwal_id").val(jadwal_id);
                    //alert($("#ijadwal_id").val());
                    $("#imatakuliah").val(data.MK_STATUS+' '+data.MATA_KULIAH_NAMA);
                     
//                                            $("#druangan").html(respond[0].JADWAL_ID);
//                                            $("#druangan").val('pilih');

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                        alert(base_url);

                        alert('Error get data from ajax');
                }
        }
);
        //cek tanggal valid
  
}


    