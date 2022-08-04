<form class="search-form" action="<?php  echo esc_url(home_url('/')); ?>/" method="get">
    <fieldset>
        <input type="text" name="s" id="s" />
        <input type="submit" id="searchsubmit" />
        <div class="search-icon"><?php echo textron_enovathemes_svg_icon('search.svg'); ?></div>
    </fieldset>
</form>