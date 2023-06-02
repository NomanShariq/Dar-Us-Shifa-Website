<?php

/**
 * Class Pix_Customize_Textarea_Control
 */
class Pix_Customize_Textarea_Control extends Pix_Customize_Control {
	public $type    = 'textarea';
	public $live    = false;

	/**
	 * Render the control's content.
	 */
	public function render_content() { ?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<textarea id="<?php echo esc_attr( $this->id ); ?>" rows="5" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
	<?php

	}
}
