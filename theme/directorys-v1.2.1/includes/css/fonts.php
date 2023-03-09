<?php

global $directorys_options;

if (isset($directorys_options['typography'])) {

    $typography = $directorys_options['typography'];

}

?>

<style type="text/css">

    body{
        margin: 0;
        font-family: <?php echo $typography['font-family'] ?>, sans-serif;
        font-weight: 400;
        background: rgb(239, 239, 239);
    }

    h1, h2, h3, h4, h5, h6, p, a {
        font-family: <?php echo $typography['font-family'] ?>, sans-serif;
    }

    .search-form input, .search-form .ht-select {
        font-family: <?php echo $typography['font-family'] ?>, sans-serif;
    }

    @media screen and (-webkit-min-device-pixel-ratio:0) {
        @font-face {
            font-family: Daniel;
            src: url(<?php echo HOLO_INCLUDES_DIR_URI . '/vendors/fonts/daniel.svg' ?>) format('svg');
        }
    }

    @font-face {
        font-family: Daniel;
        src: url(<?php echo HOLO_INCLUDES_DIR_URI . '/vendors/fonts/daniel.ttf' ?>);
    }

/*    body, p,*/
/*    .read-link,*/
/*    a.list-group-item*/
/*    #search,*/
/*    header.custom-2 .navbar-nav a.v-al-container .text,*/
/*    .main-slider .title,*/
/*    .main-slider .text,*/
/*    .shop-panel .cart-list .price,*/
/*    .shop-panel .totals,*/
/*    .form input,*/
/*    .form-3 input,*/
/*    .form-3 textarea,*/
/*    input.form-control.main-form,*/
/*    .date,*/
/*    .calendar .days,*/
/*    .calendar .day .number,*/
/*    .calendar .day .description,*/
/*    .table.pricing .price,*/
/*    .table .field,*/
/*    .data .field,*/
/*    .table.data td,*/
/*    .blog-wrapper.grid .bot .date,*/
/*    .blog-wrapper.grid .bot .stats,*/
/*    .timeline .bot .date,*/
/*    .timeline .bot .stats,*/
/*    .blog-wrapper.personal .meta .author,*/
/*    .author-box .text .about,*/
/*    .blog-wrapper.single .comment,*/
/*    .boxes-4 ul li,*/
/*    .tooltip-inner {*/
/*        font-family: */<?php //echo $content_typography['font-family'] ?>/*, Arial, sans-serif;*/
/*    }*/
/**/
/*    h1, h2, h3, h4, h5, h6,*/
/*    .advertising .info .title,*/
/*    #countdown .counters .value,*/
/*    #countdown .counters .unit,*/
/*    header .navbar-nav a*/
/*    .bubble,*/
/*    .wrap-404,*/
/*    .shop-promo .title,*/
/*    .shop-panel .cart-list .name,*/
/*    .shop-panel .cart-list .head,*/
/*    .clear,*/
/*    .shop-panel .shipping .head,*/
/*    .shop-panel .totals .head,*/
/*    .shop-panel .totals .cart-total .value,*/
/*    .login-form .head,*/
/*    .register-form .head,*/
/*    .login-form .buttons .lost,*/
/*    .auth .buttons .main-text,*/
/*    .auth .buttons .lost,*/
/*    .event .time,*/
/*    .calendar .head,*/
/*    .button,*/
/*    .box.counter,*/
/*    .breadcrumb,*/
/*    .alert .text,*/
/*    .table.data thead td,*/
/*    .blog-wrapper .page-nav .pages .page,*/
/*    .forum .page-nav .pages .page,*/
/*    .blog-wrapper .stats,*/
/*    .blog-wrapper.grid .head .text,*/
/*    .timeline .head .text,*/
/*    .blog-wrapper .quote .text,*/
/*    .blog-wrapper .quote .author,*/
/*    .blog-wrapper.personal .meta .symbol .date,*/
/*    .blog-wrapper.personal .body .more,*/
/*    .author-box .text .author,*/
/*    .blog-wrapper.single .comment .reply,*/
/*    .forum .head,*/
/*    .item .overlay .title,*/
/*    .single .sg-controls .preview .title,*/
/*    .list.portfolio .visit,*/
/*    .post-tab-widget ul,*/
/*    #calendar_wrap th,*/
/*    #calendar_wrap tfoot,*/
/*    .big-subscribe input,*/
/*    .preview-grid .item-title,*/
/*    #options-panel .head,*/
/*    .progress .tooltip-inner {*/
/*        font-family: */<?php //echo $heading_typography['font-family'] ?>/*, sans-serif;*/
/*    }*/
</style>