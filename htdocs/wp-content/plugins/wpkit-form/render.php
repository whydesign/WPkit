<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 27.02.23
 * Time: 16:34
 */

$policy_id = (int) get_option( 'wp_page_for_privacy_policy' );

if ( $policy_id && get_post_status( $policy_id ) === 'publish' ) {
    $policy_url = esc_url( get_permalink( $policy_id ) );
}
?>

<form class="uk-form-stacked">
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">Name</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="Name" aria-label="Input" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">E-Mail</label>
        <div class="uk-form-controls">
            <input class="uk-input" type="text" placeholder="E-Mail" aria-label="Input" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-text">Nachricht</label>
        <div class="uk-form-controls">
            <textarea class="uk-textarea" rows="5" placeholder="Nachricht" aria-label="Textarea" required></textarea>
        </div>
    </div>
    <div class="uk-margin">
        <label><input class="uk-checkbox" type="checkbox" required> Ich stimme der Verarbeitung meiner Daten lt. <?= ($policy_id) ? '<a href="' . $policy_url . '" target="_blank">' : '' ?>Datenschutzerklärung<?= ($policy_id) ? '</a>' : '' ?> zu.</label>
    </div>
    <div class="uk-margin">
        <button class="uk-button uk-button-primary" type="submit">Submit</button>
    </div>
</form>