
var base_url = window.location.origin+'/admin/ajax-approval';
    //var dkelas=$('#dkelas').val();


    $.ajaxSetup({
            type:"POST",
            url: base_url,
            cache: false,
    });

    function approvalSave(jadwal_ganti_id,jadwal_id,approval_status) 
    {
        
            $('#modal-default').modal('show'); // show bootstrap modal when complete loaded
            if(approval_status == 'Y')
            {
                $('.modal-title').text('Approve Form'); // Set title to Bootstrap modal title
                $('.kata-kata').text('Apakah anda yakin ingin melakukan Approv terhadap jadwal ganti ini?'); // Set title to Bootstrap modal title
                $('#btnSave').removeClass();
                $('#btnSave').addClass('btn btn-success');
                $('#btnSave').val('Approve');
                
                //$('#modal-default').removeClass();
                //$('#modal-default').addClass('modal fade');
            }
            else
            {
                $('.modal-title').text('Reject Form'); // Set title to Bootstrap modal title
                $('#btnSave').removeClass();
                $('#btnSave').addClass('btn btn-danger');
                $('#btnSave').val('Reject');
                
                $('.kata-kata').text('Apakah anda yakin ingin melakukan Reject terhadap jadwal ganti ini?'); // Set title to Bootstrap modal title
                
            }
            //alert(jadwal_ganti_id);
            
            $.ajax({
                            data:{cekApproval:'ApprovalConfirm',jadwal_ganti_id:jadwal_ganti_id,jadwal_id:jadwal_id},

                            success: function(data){
                                var a = JSON.parse(data); 
                                //alert(jadwal_ganti_id);
                                $('.kata-dosen').text(': '+a['dosen_nama']); // Set title to Bootstrap modal title
                                $('.kata-matakuliah').text(': '+a['mata_kuliah_nama']); // Set title to Bootstrap modal title
                                $('.kata-tanggal').text(': '+a['tanggal']); // Set title to Bootstrap modal title
                                $('.kata-ruangan').text(': '+a['ruangan_id']); // Set title to Bootstrap modal title
                                 $('[name="jadwal_ganti_id"]').val(jadwal_ganti_id);
                                 $('[name="approval_status"]').val(approval_status);
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                    //alert(base_url);

                                    alert('Error get data from ajax');
                            }
                    }
            )
    }


