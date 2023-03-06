<?php
/**
 * Created by PhpStorm.
 * User: Ludwig
 * Date: 06.03.23
 * Time: 10:18
 * Multiple checkbox customize control class.
 */

class Customize_Control_Multiple_Checkbox extends WP_Customize_Control {

    public $type = 'checkbox-multiple';

    public function render_content() {

        if ( empty( $this->choices ) )
            return; ?>

        <?php if ( !empty( $this->label ) ) : ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif; ?>

        <?php if ( !empty( $this->description ) ) : ?>
            <span class="description customize-control-description"><?php echo $this->description; ?></span>
        <?php endif; ?>

        <?php $multi_values = !is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

        <ul>
            <?php foreach ( $this->choices as $value => $label ) : ?>

                <li>
                    <label>
                        <input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
                        <?php echo esc_html( $label ); ?>
                    </label>
                </li>

            <?php endforeach; ?>
        </ul>

        <input type="hidden" id="sliderPages" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />

        <script>
            ( function( $ ) {
                $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on('change', function() {
                    checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                        function() { return this.value; }
                    ).get().join( ',' );

                    $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
                });
            }( jQuery ) );
        </script>
    <?php }
}