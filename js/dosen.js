$(document).ready(function(){
    $("#btn-tambah-soal").click(function(){
        var input = parseInt($("#input-soal").val()); //inputan
        var show = $('#show-soal')[0]; // keluaran

        show.innerHTML = '';
        for(var i = 1; i <= input; i ++) {
            var item = document.createElement('div');
            item.innerHTML = i;
            show.appendChild(item);
        }        
    });
});