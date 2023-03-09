<?php

global $directorys_options;

if (isset($directorys_options['color_theme'])) {

    $theme_color = $directorys_options['color_theme'];

}

if (isset($directorys_options['second_color_theme'])) {

    $second_color_theme = $directorys_options['second_color_theme'];

}

?>

<style type="text/css">

.main-text-color {
    color: <?php echo $theme_color  ?>;
}

.side-menu .active {
    color: <?php echo $theme_color  ?>;
}

.side-menu a:hover {
    color: <?php echo $theme_color  ?>;
}

header.head-1 .menu-bar .utilities-buttons a i, header.custom-1 .utilities-buttons a i {
    color: <?php echo $theme_color  ?>;
}

header .navbar-nav > li.active > .dropdown > a, header .navbar-nav > li.active > a {
    color: <?php echo $theme_color  ?>;
}

header .menu-5.navbar-nav > li > a:after, header .menu-5.navbar-nav > li > .dropdown > a:after {
    color: <?php echo $theme_color  ?>;
}

header .navbar-nav a.active, header .navbar-nav .uber-menu a.active{
    color: <?php echo $theme_color  ?>;
}

header .navbar-nav li a:hover {
    color: <?php echo $theme_color  ?>;
}

header .navbar-nav .uber-menu a:hover {
    color: <?php echo $theme_color  ?>;
}

header .menu-1 li.active.dropdown > a, header .menu-1 li.active > a {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

header .menu-1 > li.dropdown > a:hover, header .menu-1 > li > a:hover {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

header .menu-2 li.active a span {
    color: <?php echo $theme_color  ?>;
}

header .menu-3 li.active a:after {
    background: <?php echo $theme_color  ?>;
}

header .menu-3 li:hover > .dropdown > a:after, header .menu-3 li:hover > a:after, header .menu-3 li:hover > .dropdown > a:after {
    background: <?php echo $theme_color  ?>;
}

header .menu-3 .navbar-nav > li:hover > a:after{
    background: <?php echo $theme_color  ?>;
}

header .menu-4 li.active {
    border-bottom: 2px solid <?php echo $theme_color  ?>;
}

header.custom-4 .navbar-header a {
    background: <?php echo $theme_color  ?>;
}

header.custom-4 .navbar-nav > li {
    background: <?php echo $theme_color  ?>;
}

header .dropdown li a.active {
    color: <?php echo $theme_color  ?>;
}

header .dropdown li:hover {
    color: <?php echo $theme_color  ?>;
}

header .dropdown li.menu-parent > a:after {
    color: <?php echo $theme_color  ?>;
}

.main-menu a.active {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

header .main-menu.expandable li .active .exp, header .main-menu.expandable li a:hover .exp {
    color: #fff;
}

.main-menu a:hover {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

.main-menu button {
    color: <?php echo $theme_color  ?>;
    background: #fff;
}

#search button.btn.btn-default {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

#search ul.dropdown-menu > li > a:hover {
    color: <?php echo $theme_color  ?>;
}


header.custom-1.navbar-fixed-top {
    background: <?php echo $theme_color  ?>;
}

header.custom-1 .menu-cont {
    background: <?php echo $theme_color  ?>;
}

header.custom-2 .navbar-nav a.v-al-container i {
    color: <?php echo $theme_color  ?>;
}

header.custom-5 .navbar-nav > li > a{
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

header.custom-5 .navbar-nav > li > a:hover {
    background: <?php echo $theme_color  ?>;
}

header.custom-3 .navbar-nav a.v-al-container i {
    color: <?php echo $theme_color  ?>;
}

ul.basic.minus li:before {
    color: <?php echo $theme_color  ?>;
}

.overlay {
    background: <?php echo $theme_color  ?>;
    background-color: <?php echo get_transparent_color($theme_color, 0.75); ?>;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0.75)";
}

.banner-over {
    background: <?php echo $theme_color  ?>;
    background-color: <?php echo get_transparent_color($theme_color, 0.75); ?>;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0.75)";
}


.shop-panel .cart-list .line .icon a:hover {
    color: <?php echo $theme_color  ?>;
}

.clear {
    color: <?php echo $theme_color  ?>;
}

.clear:hover {
    color: <?php echo $theme_color  ?>;
}

.contact-location .mail a:hover {
    color: <?php echo $theme_color  ?>;
}

.contact-location .phone a:hover {
    color: <?php echo $theme_color  ?>;
}

.calendar .day.current {
    background-color: <?php echo $theme_color  ?>;
}

.calendar .day.event .number {
    color: <?php echo $theme_color  ?>;
}

.calendar .day.event .time {
    color: <?php echo $theme_color  ?>;
}

.calendar .day:hover {
    background: <?php echo $theme_color  ?>;
}

.calendar .navigator a:hover {
    color: <?php echo $theme_color  ?>;
}

#botbar .socials a:hover {
    color: #fff;
    background: <?php echo $theme_color  ?>;
}

.breadcrumb > .active {
    color: <?php echo $theme_color  ?>;
}

.breadcrumb a:hover {
    color: <?php echo $theme_color  ?>;
}

.accordion .panel-heading a:not(.collapsed) i {
    color: <?php echo $theme_color  ?>;
}

.accordion .panel-heading a:not(.collapsed) {
    color: <?php echo $theme_color  ?>;
}

.breadcrumb.accordion-filter li:hover {
    color: <?php echo $theme_color  ?>;
}

.preview.gallery .navigation .control:hover {
    color: <?php echo $theme_color  ?>;
}

.table.pricing.highlight .price {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

.tab > ul > li.ui-state-active a h6, .tab > ul > li a:hover h6 {
    color: <?php echo $theme_color  ?>;
}

.portfolio-isotope-filters li:hover a{
    color: <?php echo $theme_color  ?>;
}

.blog-wrapper .page-nav .pages .page:hover, .forum .page-nav .pages .page:hover {
    background: <?php echo $theme_color  ?>;
}

.blog-wrapper .page-nav .pages .page.active, .forum .page-nav .pages .page.active {
    background: <?php echo $theme_color  ?>;
}

.blog-wrapper .stats i.fa-heart:hover, .blog-wrapper .stats i.fa-share:hover {
    color: <?php echo $theme_color  ?>;
}


a.list-group-item:hover {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

.sidebar .tweet-box a {
    color: <?php echo $theme_color  ?>;
}

.advertising .variants .element .inside:hover {
    background: <?php echo $theme_color  ?>;
}

.flickr-container a .overlay {
    background-color: rgba(33,154,200,0.75);
}

.liked-posts .element {
    background: rgba(33,159,209,1);
}

.liked-posts .element.op1 {
    background: rgba(33,159,209,0.8);
}

.liked-posts .element.op2 {
    background: rgba(33,159,209,0.7);
}

.liked-posts .element.op3 {
    background: rgba(33,159,209,0.6);
}

.liked-posts .element.op4 {
    background: rgba(33,159,209,0.5);
}

.liked-posts .element.op5 {
    background: rgba(33,159,209,0.4);
}

.background-overlay{
    background: <?php echo $theme_color  ?>;
    background-color: rgba(33,154,200,0.85);
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0.75)";
}

.modal-header .close{
    background: <?php echo $theme_color  ?>;
}

.widget-posts-list .list-item:hover {
    background-color: <?php echo $theme_color  ?>;
}

.button.solid {
    background-color: <?php echo $theme_color  ?>;
}

.button.solid:hover {
    background-color: <?php echo blend_alpha(hex2rgb($theme_color)) ?>
}

.button.solid.inactive {
    background-color: #bdbdbd;
}

.button.solid.inactive:hover {
    background-color: #bdbdbd;
}

.button.striped {
    border: 1px solid <?php echo $theme_color  ?>;
    color: <?php echo $theme_color  ?>;
}

.main-bg-color, .button.main-bg-color, .button.solid.main-bg-color {
    background-color: <?php echo $theme_color  ?>;
}

.pricing.table.highlight .button {
    background-color: <?php echo $theme_color  ?>;
}

.progress-bar {
    background-color: <?php echo $theme_color  ?>;
}

.box.counter.main {
    background-color: <?php echo $theme_color  ?>;
    color: #fff;
}

.box.counter.alt .count {
    color: <?php echo $theme_color  ?>;
}

.box-8.highlight {
    background-color: <?php echo $theme_color  ?>;
}

.comment-respond a:hover {
    color: <?php echo $theme_color  ?>;
}

.divider-1 h3, .divider-1 h1 {
    border-color: <?php echo $theme_color  ?>;
}

#wp-calendar caption, #wp-calendar tfoot {
    color: <?php echo $theme_color  ?>;
}
#wp-calendar #today {
    background: <?php echo $theme_color  ?>;
    color: #fff;
}

.post-tab-widget ul li a:hover, .post-tab-widget > ul > li.active a, #footer .post-tab-widget > ul > li.active a {
    color: <?php echo $theme_color  ?>;
}

.widget li:hover {
    background: <?php echo $theme_color  ?>;
}

.register-form-sc .ht-select-options li:hover {
    background: <?php echo $theme_color  ?>;
}

.box-8.highlight .arrow {
    border-color: transparent transparent transparent <?php echo $theme_color  ?>;
}

input[type="submit"] {
    background-color: <?php echo $theme_color  ?>;
}

a.main-bg-color:hover, input.main-bg-color:hover, .button.main-bg-color:hover, .pricing.table.highlight .head, input[type="submit"]:hover {
    background-color: <?php echo blend_alpha(hex2rgb($theme_color)) ?>
}

.pricing.table.highlight .head {
    border-bottom: 1px solid <?php echo blend_alpha(hex2rgb($theme_color)) ?>
}

.form-submit input {
    background-color: <?php echo $theme_color  ?>;
}

.form-submit input:hover {
    background-color: <?php echo blend_alpha(hex2rgb($theme_color)) ?>
}

a[data-parent="true"]:after, .parent.element a:after {
    color: <?php echo $theme_color  ?>;
}

/* Second Color Theme */

footer #footer {
    background-color: <?php echo $second_color_theme; ?>
}

footer #botbar {
    background-color: <?php echo blend_alpha(hex2rgb($second_color_theme), array(0, 0, 0, 0.2)) ?>
}

#totop:hover {
    background-color: <?php echo $theme_color; ?>
}

.bgheader {
    background-color: <?php echo get_transparent_color($second_color_theme, 0.6); ?>
}

.bgheader .header {
    background-color: <?php echo $second_color_theme; ?>
}

.ui-slider-handle {
    border-color: <?php echo $theme_color  ?>;
}

.descriptioninfo .contact-info {
    color: <?php echo $theme_color  ?>;
}

.carousel-indicators .item.active, .carousel-indicators .item:hover {
    background-color: <?php echo $theme_color; ?>
}

.nav.navbar-nav button {
    color: <?php echo $theme_color  ?>;
}

.login-widget .form-1 .button.active-form {
    background-color: <?php echo $second_color_theme; ?>
}

header .nav.navbar-nav a.active {
    color: <?php echo $theme_color  ?>;
}

.fa-check-empty, .fa-check {
    color: <?php echo $theme_color  ?>;
}

.fa-check {
    display: none;
}

.post-media .carousel .controls a:hover {
    background-color: <?php echo $theme_color  ?>;
}

</style>