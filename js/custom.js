$(document).ready(function() {
    verificar_height_auto()
    $(window).resize(function() {
        verificar_height_auto();
    });



    function verificar_height_auto() {
        var windows_width = $(window).width();
        var windows_height = $(window).height();
        if (windows_width < 1182) {
            var heigth_intro;
            if (windows_width < 980 && windows_width > 600) {
                heigth_intro = 500;
            } else if (windows_width < 600 && windows_width > 450) {
                heigth_intro = 550;
            } else {
                heigth_intro = 450;
            }
            $(".heigth-auto").css("height", heigth_intro);
            $(".heigth-auto-view").css("height", "100%");

        } else {
            if (windows_height > 599) {
                $(".heigth-auto").css("height", windows_height);
                $(".heigth-auto-view").css("height", windows_height - 56 - 70 - 30);
            } else {
                $(".heigth-auto").css("height", '600');
                $(".heigth-auto-view").css("height", 600 - 56 - 70 - 30);
            }
        }
    }
});
function alert_open(msg) {
    $('#alert_msg').html(msg);
    $('#alert').fadeIn(1000);
    setTimeout(function() {
        $('#alert').fadeOut(1000);
    }, 4000);
}
function loading(ativo) {
    if (ativo) {
        $("#loading").show();
        $("body").css('overflow', 'hidden');
    } else {
        $("#loading").fadeOut('4s');
        $("body").css('overflow', 'auto');
    }
}
preloader = new $.materialPreloader({
    element_intro: '.container-navbar',
    position: 'top',
    height: '5px',
    col_1: '#ffc200',
    col_2: '#455a64',
    col_3: '#8dc2dc',
    col_4: '#f1ad00',
    fadeIn: 200,
    fadeOut: 200
});
