$(function (){

load_data();

function load_data(fakultas = '', jurusan = '', kelas = '')
{
    $("#data-mahasiswa").DataTable({
    // "processing": true,
    "serverSide": true,
    "ajax": {
        url : "{{ route('placement-test.index') }}",
        data : {
        fakultas: fakultas,
        jurusan: jurusan,
        kelas: kelas
        }
    },
    "columns": [
        {
        data: 'DT_RowIndex',
        name: 'id'
        },
        {
        data: "nim" ,
        name: "nim"
        },
        {
        data: "name",
        name: "name"
        },
        {
        data: "jurusan",
        name: "jurusan"
        },
        {
        data: "nilai_placement",
        name: "nilai_placement" 
        },
        {
        data: "action",
        name: "action"
        }
    ],
    });
}

$('#filter').click(function() {
    var fakultas = $('#fakultas').val();
    var jurusan = $('#jurusan').val();
    var kelas = $('#kelas').val();

    $('#data-mahasiswa').DataTable().destroy();
    load_data(fakultas, jurusan, kelas);
});

$('#reset-filter').click(function() {
    $('#fakultas').empty();
    $('#fakultas').append("<option value=''>Select Fakultas</option>");

    var fakultas = {!! json_encode($fakultas) !!};
    
    for (i = 0; i < fakultas.length; i++)
    {
        $('#fakultas').append("<option value='" + fakultas[i].id + "'>" + fakultas[i].slug + "</option>");
    }

    $('#jurusan').empty();       
    $('#jurusan').append("<option value=''>Select Jurusan</option>");
    $('#kelas').empty();       
    $('#kelas').append("<option value=''>Select Kelas</option>");

    $('#data-mahasiswa').DataTable().destroy();
    load_data();

});


// When an option is changed, search the above for matching choices
$('#fakultas').on('change', function() {
    // Set selected option as variable
    var fakultas_id = $(this).val();

    if(fakultas_id)
    {
    // Empty the target field
    $('#jurusan').empty();
    $('#jurusan').append("<option value=''>Select Jurusan</option>");
    $('#kelas').empty();        
    $('#kelas').append("<option value=''>Select Kelas</option>");

    var jurusan = {!! json_encode($jurusans) !!};
    // For each chocie in the selected option
    for (i = 0; i < jurusan[fakultas_id].length; i++)
    {
        $('#jurusan').append("<option value='" + jurusan[fakultas_id][i].id + "'>" + jurusan[fakultas_id][i].slug + "</option>");
    }

    }
    else
    {
    $('#jurusan').empty();        
    $('#jurusan').append("<option value=''>Select Jurusan</option>");
    $('#kelas').empty();        
    $('#kelas').append("<option value=''>Select Kelas</option>");
    }      
});    

// When an option is changed, search the above for matching choices
$('#jurusan').on('change', function() {
    // Set selected option as variable
    var jurusans_id = $(this).val();

    if(jurusans_id)
    {
    // Empty the target field
    $('#kelas').empty();       
    $('#kelas').append("<option value=''>Select Kelas</option>");

    var kelas = {!! json_encode($kelas) !!};
    // For each chocie in the selected option
    for (i = 0; i < kelas[jurusans_id].length; i++)
    {
        $('#kelas').append("<option value='" + kelas[jurusans_id][i].id + "'>" + kelas[jurusans_id][i].name + "</option>");
    }

    }
    else
    {
    $('#kelas').empty();        
    $('#kelas').append("<option value=''>Select Kelas</option>");
    }      
});    

});
