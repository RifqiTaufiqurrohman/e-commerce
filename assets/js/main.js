// ketika btn-menu di klik
const navbarMenu = document.querySelector('.navbar-menu');
document.querySelector('#btn-menu').onclick = () => {
    navbarMenu.classList.toggle('active');
};

// membuat menu sidebar ketika di klik diluar menu navbar, maka navbar tersebut tertutup
const btnMenu = document.querySelector('#btn-menu');
document.addEventListener('click', function (e) {
    if (!btnMenu.contains(e.target) && !navbarMenu.contains(e.target)) {
        navbarMenu.classList.remove('active');
    }
});

// ketika btn-user di klik
const btnUser = document.querySelector('.user');
document.querySelector('#btn-user').onclick = (e) => {
    btnUser.classList.toggle('active');
    e.preventDefault();
};

// Search Form
const searchForm = document.querySelector('.search-form');
const searchBox = document.querySelector('#search-box');
document.querySelector('#btn-serach').onclick = (e) => {
    searchForm.classList.toggle('active');
    searchBox.focus();
    e.preventDefault();
};

// owl-carousel
$(document).ready(function () {
    $('.hero .owl-carousel').owlCarousel({
        autoplay: true,
        nav: true,
        loop: true,
        dots: true,
        inifinite: true,
        speed: 4000,
        autoplay: true,
        slideToShow: 1,
        items: 1,
        navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
        navContainer: '#owl-nav',
    });
});

// detail produk
$(document).ready(function () {
    $('.detail-produk .owl-carousel').owlCarousel({
        autoplay: true,
        nav: true,
        loop: true,
        dots: true,
        inifinite: true,
        speed: 4000,
        autoplay: true,
        slideToShow: 1,
        items: 1,
        navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
        navContainer: '#owl-nav',
    });
});

// DATA BANK
$(document).ready(function () {
    $('#bank').change(function () {
        var namaBank = $(this).val();
        $.ajax({
            url: 'get_rekening.php',
            type: 'POST',
            data: { nama_bank: namaBank },
            dataType: 'json',
            success: function (data) {
                $('#nama_rekening').val(data.nama_rekening);
                $('#norek').val(data.no_rekening);
            },
        });
    });
});

// RAJA ONGKIR
$(document).ready(function () {
    $.ajax({
        url: 'data_provinsi.php',
        type: 'post',
        success: function (data_provinsi) {
            $('select[name=provinsi]').html(data_provinsi);
        },
    });
    $('select[name=provinsi]').on('change', function () {
        var id_provinsi = $('option:selected', this).attr('id_provinsi');

        $.ajax({
            url: 'data_distrik.php',
            type: 'post',
            data: 'id_provinsi=' + id_provinsi,
            success: function (data_distrik) {
                $('select[name=distrik]').html(data_distrik);
            },
        });
    });
    $.ajax({
        url: 'data_ekspedisi.php',
        type: 'post',
        success: function (data_ekspedisi) {
            $('select[name=ekspedisi]').html(data_ekspedisi);
        },
    });
    $('select[name=ekspedisi]').on('change', function () {
        var nama_ekspedisi = $('select[name=ekspedisi]').val();
        var datadistrik = $('option:selected', 'select[name=distrik]').attr('id_distrik');
        var total_berat = $('input[name=total_berat]').val();
        $.ajax({
            url: 'data_paket.php',
            type: 'post',
            data: 'ekspedisi=' + nama_ekspedisi + '&distrik=' + datadistrik + '&berat=' + total_berat,
            success: function (data_paket) {
                $('select[name=paket]').html(data_paket);
                $('input[name=nama_ekspedisi]').val(nama_ekspedisi);
            },
        });
    });
    $('select[name=distrik]').on('change', function () {
        var prov = $('option:selected', this).attr('nama_provinsi');
        var dist = $('option:selected', this).attr('nama_distrik');
        var type = $('option:selected', this).attr('type_distrik');
        var pos = $('option:selected', this).attr('kode_pos');
        $('input[name=nama_provinsi]').val(prov);
        $('input[name=nama_distrik]').val(dist);
        $('input[name=type_distrik]').val(type);
        $('input[name=kode_pos]').val(pos);
    });
    $('select[name=paket]').on('change', function () {
        var paket = $('option:selected', this).attr('paket');
        var ongkir = $('option:selected', this).attr('ongkir');
        var etd = $('option:selected', this).attr('etd');
        $('input[name=paket]').val(paket);
        $('input[name=ongkir]').val(ongkir);
        $('input[name=estimasi]').val(etd);
    });
});

// PAGINATION
function getPageList(totalPage, page, maxLength) {
    function range(start, end) {
        return Array.from(Array(end - start + 1), (_, i) => i + start);
    }

    const sideWidth = maxLength < 9 ? 1 : 2;
    const leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
    const rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

    if (totalPage <= maxLength) {
        return range(1, totalPage);
    }
    if (page <= maxLength - sideWidth - 1 - rightWidth) {
        return range(1, maxLength - sideWidth - 1).concat(0, range(totalPage - sideWidth + 1, totalPage));
    }
    if (page >= totalPage - sideWidth - 1 - rightWidth) {
        return range(1, sideWidth).concat(0, range(totalPage - sideWidth - 1 - rightWidth - leftWidth, totalPage));
    }
    return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPage - sideWidth + 1, totalPage));
}

$(function () {
    const numberOfItems = $('.card-produk .card').length;
    const limitPerPage = 6;
    const totalPage = Math.ceil(numberOfItems / limitPerPage);
    const paginationSize = 5;
    let currentPage;

    function showPage(whichPage) {
        if (whichPage < 1 || whichPage > totalPage) return false;
        currentPage = whichPage;

        $('.card-produk .card')
            .hide()
            .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
            .show();

        $('.pagination li').slice(1, -1).remove();

        getPageList(totalPage, currentPage, paginationSize).forEach((item) => {
            $('<li>')
                .addClass('page-item')
                .addClass(item ? 'halaman' : 'dots')
                .toggleClass('active', item === currentPage)
                .append(
                    $('<a>')
                        .addClass('page-link')
                        .attr({ href: 'javascript:void(0)' })
                        .text(item || '...')
                )
                .insertBefore('.next');
        });
        $('.prev').toggleClass('disabled', currentPage === 1);
        $('.next').toggleClass('disabled', currentPage === totalPage);
        return true;
    }

    $('.pagination').append(
        $('<li>')
            .addClass('page-item prev')
            .append($('<a>').addClass('page-link').attr({ href: 'javascript:void(0)' }).text('Prev')),
        $('<li>')
            .addClass('page-item next')
            .append($('<a>').addClass('page-link').attr({ href: 'javascript:void(0)' }).text('Next'))
    );

    $('.card-produk .card').hide();
    showPage(1);

    $(document).on('click', '.pagination li.halaman:not(.active)', function () {
        return showPage(+$(this).text());
    });
    $('.next').on('click', function () {
        return showPage(currentPage + 1);
    });
    $('.prev').on('click', function () {
        return showPage(currentPage - 1);
    });
});
