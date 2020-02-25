// Catch all events related to changes
jQuery(document).ready(
    function () {
        jQuery('.qty_select').on('change keyup', function () {
            console.log('test');
            // Remove invalid characters
            var sanitized = jQuery(this).val().replace(/[^-.0-9]/g, '');
            // Remove non-leading minus signs
            sanitized = sanitized.replace(/(.)-+/g, '$1');
            // Remove the first point if there is more than one
            sanitized = sanitized.replace(/\.(?=.*\.)/g, '');
            // Update value
            jQuery(this).val(sanitized);
        });
    }
);