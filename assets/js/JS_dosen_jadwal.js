$(function () {
    
	var base_url = window.location.origin+'/dosen/ajax_dosen_ubah';
        //var dkelas=$('#dkelas').val();
       
        
	$.ajaxSetup({
		type:"POST",
		url: base_url,
		cache: false,
	});

        $("#dkelas").change(function(){
		var dkelas=$('#dkelas').val();
		
                tampilMataKuliah();
		$.ajax({
				data:{cek:'cekKelas', dkelas:dkelas},

				success: function(respond){
                                  $("#dmatakuliah").html(respond);
                                  $('#dmatakuliah').val('pilih');
                                //alert("2");
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					//alert(base_url);

					alert('Error get data from ajax');
				}
			}
		);


	});
	

	$("#dmatakuliah").change(function(){
		
                var dkelas=$('#dkelas').val();
                var dmatakuliah=$('#dmatakuliah').val();
                tampilHari();
		$.ajax({
                        data:{cek:'cekMatkul', dkelas:dkelas, dmatakuliah:dmatakuliah},

                        success: function(respond){
                                $("#dhari").html(respond);
                                $("#dhari").val('pilih');

                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                                alert(base_url);

                                alert('Error get data from ajax');
                        }
                    }
            )


	});
        
         $("#dhari").change(function(){
                        //alert("Hello! I am an alert box!!");
                       
                        tampilTanggal();


                });
        
        
        $("#itanggal").change(function(){
		//alert("Hello! I am an alert box!!");
		//var kelas=$('#dkelas').val();
                
                var itanggal=$('#itanggal').val();
                var dkelas=$('#dkelas').val();
                var dmatakuliah=$('#dmatakuliah').val();
                var dhari=$('#dhari').val();
                tampilKeterangan()

                $.ajax({
                            data:{cek:'cekTanggal', itanggal:itanggal,dkelas:dkelas,dmatakuliah:dmatakuliah,dhari:dhari},
                            success: function(respond){
                                var a = JSON.parse(respond);
                                
                                if(a['hari'] == 'sabtu' || a['hari'] == 'minggu')
                                {
                                    alert('tanggal ga boleh b '+ a['hari']);
                                    $('#itanggal').val('');
                                    $('#djam').addClass('hidden');
                                }
                                else
                                {
                                    if(a['status'] == true)
                                    {
                                        tampilJam();
                                        //status
                                        //alert('tanggal Boleh '+a['jadwal_id']);
                                        $('#ihari').val(a['hari']);
                                        $('#ijadwal_id').val(a['jadwal_id']);
                                        
                                        
                                        alert($('#itanggal').val());
                                    }
                                    else
                                    {
                                        alert('Pengajuan Maksimal 3 hari sebelum jam pergantian '+ a['hari']);
                                    }
                                        
                                    
                                    
                                    
                                }
                                 
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                    alert(base_url);

                                    alert('Error get data from ajax');
                            }
                        }
                )

	});

        
        $("#djam").change(function(){
                        //alert("Hello! I am an alert box!!");
                        var jam=$('#djam').val();
                        var ihari=$('#ihari').val();
                        tampilRuangan();
                        
                        $.ajax({
                                        data:{cek:'cekJam', djam:jam, ihari:ihari},

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
                        )


                });
        
	


	//funtion
	function tampilMataKuliah() {
		$("#gmatakuliah").removeClass('hidden');
		$("#gmatakuliah").addClass('form-group');
	}
	function tampilDosen() {
		$("#gdosen").removeClass('hidden');
		$("#gdosen").addClass('form-group');
	}
         function tampilHari() {
		$("#ghari").removeClass('hidden');
		$("#ghari").addClass('form-group');
	}
	function tampilJam() {
		$("#gjam").removeClass('hidden');
		$("#gjam").addClass('form-group');
	}
	function tampilRuangan() {
		$("#gruangan").removeClass('hidden');
		$("#gruangan").addClass('form-group');
	}
        function tampilTanggal() {
		$("#gtanggal").removeClass('hidden');
		$("#gtanggal").addClass('form-group');
	}
        function tampilKeterangan() {
		$("#gket").removeClass('hidden');
		$("#gket").addClass('form-group');
	}
        
        
   $(function () {
    //Initialize Select2 Elements

    //Date picker
    $('#itanggal').datepicker({
      autoclose: true
    })

  });


});


