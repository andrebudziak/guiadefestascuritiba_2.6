<div class="col-md-12">
    <div class="page-nav row">

    <?php

        if (function_exists("wpthemess_paginate")) {
            wpthemess_paginate();
        }
        else {

            previous_posts_link();

            wp_link_pages();

            next_posts_link();

        }

    ?>

    </div>
</div>