<?php

function form_subscribtion()
{
    if (isset($_POST['subscriber_form_submit'])) {
        $full_name = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
        $email     = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
        $user_phone   = isset($_POST['user_phone']) ? sanitize_textarea_field($_POST['user_phone']) : '';
        $user_age   = isset($_POST['user_age']) ? sanitize_textarea_field($_POST['user_age']) : '';
        $program_list   = isset($_POST['program_list']) ? sanitize_textarea_field($_POST['program_list']) : '';
        $product_id   = isset($_POST['product_id']) ? sanitize_textarea_field($_POST['product_id']) : '';
        $program_title   = isset($_POST['program_title']) ? sanitize_textarea_field($_POST['program_title']) : '';

        if (strlen($full_name) === 0) {
            $validation_messages[] = esc_html__('Please enter a valid name.');
        }

        if (strlen($email) === 0 or !is_email($email)) {
            $validation_messages[] = esc_html__('Please enter a valid email address.');
        }

        if (strlen($user_phone) === 0 or !preg_match('/^[0-9]{10}+$/', $user_phone)) {
            $validation_messages[] = esc_html__('Please enter a valid phone number');
        }
        if ( ! empty( $validation_messages ) ) {
            foreach ( $validation_messages as $validation_message ) {
                echo '<div class="validation-message">' . esc_html( $validation_message ) . '</div>';
            }
        }
    }
}
