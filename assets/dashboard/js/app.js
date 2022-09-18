$(window).on('load', function () {
    var url = window.location.href;
    $('.nav-sidebar a').filter(function () {
        return this.href === url
    }).addClass('active').parents('.nav-sidebar li.has-treeview').addClass('menu-open').find('> a').addClass('active');
});

// https://labs.abeautifulsite.net/jquery-minicolors/index.html#instantiation
// https://github.com/claviska/jquery-minicolors
$('.color-select').minicolors({
    opacity: true,
    format: 'rgb',
    theme: 'bootstrap',
});

$('.conditional').conditionize();

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('.select2').select2();
});
