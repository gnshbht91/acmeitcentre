jQuery(document).ready(function($) {
    if ($('#acme-social-links-container').length === 0) {
        return;
    }

    let rowIndex = $('#acme-social-links-container .acme-social-item').length;

    $('#acme-add-social-row').on('click', function() {
        const rowHTML = `
            <div class="acme-social-item" style="margin-bottom: 10px;">
                <input type="text" name="acme_settings[social_links][${rowIndex}][type]" placeholder="Platform" value="" class="regular-text" style="width: 150px;">
                <input type="url" name="acme_settings[social_links][${rowIndex}][url]" placeholder="URL" value="" class="regular-text" style="width: 250px;">
                <button type="button" class="button acme-remove-social-row">Remove</button>
            </div>
        `;
        $('#acme-social-links-container').append(rowHTML);
        rowIndex++;
    });

    $(document).on('click', '.acme-remove-social-row', function() {
        $(this).closest('.acme-social-item').remove();
    });
});
