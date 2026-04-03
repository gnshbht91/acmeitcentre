jQuery(document).ready(function($) {
    if ($('#acme-social-links-container').length === 0) {
        return;
    }

    let rowIndex = $('#acme-social-links-container .acme-social-row').length;

    $('#acme-add-social-row').on('click', function() {
        const rowHTML = `
            <div class="acme-social-row" style="margin-bottom: 10px;">
                <input type="text" name="acme_settings[social_links][${rowIndex}][type]" placeholder="Platform (e.g. Facebook)" value="" class="regular-text">
                <input type="url" name="acme_settings[social_links][${rowIndex}][url]" placeholder="URL" value="" class="regular-text">
                <button type="button" class="button acme-remove-social-row">Remove</button>
            </div>
        `;
        $('#acme-social-links-container').append(rowHTML);
        rowIndex++;
    });

    $(document).on('click', '.acme-remove-social-row', function() {
        $(this).closest('.acme-social-row').remove();
    });
});
