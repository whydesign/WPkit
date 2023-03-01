<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 28.02.23
 * Time: 12:44
 */
?>

<a class="uk-navbar-toggle" href="#modal-full" uk-search-icon uk-toggle></a>

<div id="modal-full" class="uk-modal-full uk-modal" uk-modal>
    <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
        <button class="uk-modal-close-full" type="button" uk-close></button>
        <form class="uk-search uk-search-large" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
            <input class="search-field uk-search-input uk-text-center" type="search" placeholder="Search" name="s" aria-label="Search" autofocus>
        </form>
    </div>
</div>
