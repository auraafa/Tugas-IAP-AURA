function tampilkanSemuaMenu() {
    $.getJSON('coba.json', function (data) {
        let menu = data.menu;
        $.each(menu, function (i, data) {
            $('#daftar-menu').append('<div class="col-md-4"><div class="card  mb-3"><img src="img/'+ data.gambar +'" class="card-img-top" ><div class="card-body"><h5 class="card-title">'+  data['Nama pesanan'] +'</h5><p class="card-text">'+  data.Topping +'</p><h5 class="card-title">Rp. '+  data.Harga +'</h5><a href="#" class="btn btn-primary">Pesan</a></div></div></div>')
        });
    });
}

tampilkanSemuaMenu();

$('.nav-link').on('click', function () {
    $('.nav-link').removeClass('active');
    $(this).addClass('active');

    let kategori = $(this).html();
    $('h1').html(kategori);

    if( kategori == 'All Menu' ) {
        tampilkanSemuaMenu();
        return;
    }


    $.getJSON('coba.json', function (data) {
        let menu = data.menu;
        let content = '';

        $.each(manu, function (i, data) {
            if( data.kategori == kategori.toLowerCase()) {
                content += '<div class="col-md-4"><div class="card  mb-3"><img src="img/'+ data.gambar +'" class="card-img-top" ><div class="card-body"><h5 class="card-title">'+  data['Nama pesanan'] +'</h5><p class="card-text">'+  data.Topping +'</p><h5 class="card-title">Rp. '+  data.Harga +'</h5><a href="#" class="btn btn-primary">Pesan</a></div></div></div>'
            }
        });

        $('#daftar-menu').html(content);
    });

});