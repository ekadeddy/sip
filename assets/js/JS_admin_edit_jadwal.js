var base_url = window.location.origin+'/admin/ajax_edit_jadwal';
        //var dkelas=$('#dkelas').val();
       
        
	$.ajaxSetup({
		type:"POST",
		url: base_url,
		cache: false,
	});
  //var dkelas=$('#dkelas').val();
  
 
 $("#djam").change(function(){
		//alert("Hello! I am an alert box!!");
		var jam=$('#djam').val();
		var hari=$('#dhari').val();
		tampilRuangan();
		$.ajax({
				data:{cek:'cekJam', jam:jam, hari:hari},

				success: function(respond){
					$("#druangan").html(respond);
					$("#druangan").val('pilih');


				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert(base_url);

					alert('Error get data from ajax');
				}
			}
		);


	});

    function editJadwal(jadwal_id,hari,modul) 
    {
         if(modul == 'S')
         {
            $('#modal-simpan').modal('show'); // show bootstrap modal when complete loaded     
         }
         else
         {

              $('#modal-delete').modal('show'); // show bootstrap modal when complete loaded     
         }
            
            
            $.ajax({
                    data:{cek:'cekEditJadwal', jadwal_id:jadwal_id,hari:hari},

                    success: function(respond){
                        var a = JSON.parse(respond);
                        
                        //alert(a['jadwal_id']);
                         
                        if(modul == 'S')
                        {
                            $('#ijadwal_id').val(a['jadwal_id']);  
                            $('#ikelas').val(a['kelas_id']);
                            $('#dhari').val(a['hari']);
                            $('#dmatakuliah').val(a['mata_kuliah_id']);
                            $('#djam').val(a['jam']);
                            $('#druangan').val(a['ruangan_id']);
                            $('#ddosen').val(a['dosen_id']);
                            
                        }
                        else
                        {
                            $('#ijadwal_id2').val(a['jadwal_id']);
                            var ket = 'Kelas '+a['kelas_id']+', '+'Hari '+a['hari'];
                            $('#iket').val(ket);
                             
                        }

                       
                        
                       
                        
                        
                      
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                            //alert(base_url);

                            alert('Error get data from ajax');
                    }
			}
		);
            
    }
    
    //cek ruangan valilable
   
    
    

