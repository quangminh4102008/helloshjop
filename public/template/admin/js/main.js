$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url){
    if (confirm('Xoa')){
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result){
                if (result.error == false){
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xoa loi vui long thu lai')
                }
            }
        })
    }
}
