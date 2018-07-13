$(function () {
	var base_url = window.location.origin+'/admin/ajax_edit';
	$.ajaxSetup({
		type:"POST",
		url: base_url,
		cache: false,
	});


	$("#dkelas").change(function(){
		//alert("Hello! I am an alert box!!");
		tampilMataKuliah();

		var hari=$('#hari').val();

		//alert(base_url+'/eka/');

		// var h_1=$('#header1').val();
		// var h_akun=g_akun+'-'+h_1+h_2;

		// $("#kode_akun").val(h_akun);
		$.ajax({
				data:{modul:'cekNoAkun', h_akun:h_akun},

				success: function(respond){

					alert(base_url);
					if(respond>9){
						$("#kode_akun").val(h_akun+'0'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else if(respond>99){
						$("#kode_akun").val(h_akun+''+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else{
						$("#kode_akun").val(h_akun+'00'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
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

	$("#dmatakuliah").change(function(){
		//alert("Hello! I am an alert box!!");
		tampilDosen();

		var hari=$('#hari').val();

		//alert(base_url+'/eka/');

		// var h_1=$('#header1').val();
		// var h_akun=g_akun+'-'+h_1+h_2;

		// $("#kode_akun").val(h_akun);
		$.ajax({
				data:{modul:'cekNoAkun', h_akun:h_akun},

				success: function(respond){
					if(respond>9){
						$("#kode_akun").val(h_akun+'0'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else if(respond>99){
						$("#kode_akun").val(h_akun+''+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else{
						$("#kode_akun").val(h_akun+'00'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}

				},
				error: function (jqXHR, textStatus, errorThrown)
				{

					alert('Error get data from ajax');
				}
			}
		)


	});

	$("#ddosen").change(function(){
		//alert("Hello! I am an alert box!!");
		var jam=$('#djam').val();
		var hari=$('#hari').val();
		tampilJam();

		// var h_1=$('#header1').val();
		// var h_akun=g_akun+'-'+h_1+h_2;

		// $("#kode_akun").val(h_akun);
		$.ajax({
				data:{modul:'cekNoAkun', h_akun:h_akun},

				success: function(respond){
					if(respond>9){
						$("#kode_akun").val(h_akun+'0'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else if(respond>99){
						$("#kode_akun").val(h_akun+''+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}else{
						$("#kode_akun").val(h_akun+'00'+respond);
						$("#ceklis").removeClass('hidden');
						$("#header").val(h_akun);
						$("#alias").val(respond);
					}

				},
				error: function (jqXHR, textStatus, errorThrown)
				{

					alert('Error get data from ajax');
				}
			}
		)


	});

	$("#djam").change(function(){
		//alert("Hello! I am an alert box!!");
		var jam=$('#djam').val();
		var hari=$('#hari').val();
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
	function tampilJam() {
		$("#gjam").removeClass('hidden');
		$("#gjam").addClass('form-group');
	}
	function tampilRuangan() {
		$("#gruangan").removeClass('hidden');
		$("#gruangan").addClass('form-group');
	}


});


