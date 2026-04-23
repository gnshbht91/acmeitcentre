jQuery(document).ready(function ($) {
    if ($('#acme-social-links-container').length === 0) {
        return;
    }

    let rowIndex = $('#acme-social-links-container .acme-social-item').length;

    $('#acme-add-social-row').on('click', function () {
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

    $(document).on('click', '.acme-remove-social-row', function () {
        $(this).closest('.acme-social-item').remove();
    });
});

jQuery(document).ready(function ($) {

    $(document).on('change', '#acme-select-all', function () {
        $('.acme-select-row').prop('checked', this.checked);
    });

    $(document).on('click', '#acme-bulk-status-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const selectedStatus = $('#acme-bulk-status').val();
        if (!selectedStatus) {
            alert('Please select a status');
            return;
        }

        const checkboxes = $('.acme-select-row:checked');
        if (checkboxes.length === 0) {
            alert('Select at least one lead');
            return;
        }

        if (!confirm('Update status for selected leads?')) {
            return;
        }

        const lead_ids = [];
        checkboxes.each(function () {
            lead_ids.push(this.value);
        });

        const formData = new FormData();
        formData.append('action', 'acme_bulk_status_update');
        formData.append('_wpnonce', acme_admin.nonce);
        formData.append('status', selectedStatus);

        lead_ids.forEach(id => {
            formData.append('lead_ids[]', id);
        });

        fetch(ajaxurl, {
            method: 'POST',
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated');
                    location.reload();
                } else {
                    alert(data.data.message || 'Error');
                }
            })
            .catch(() => {
                alert('Request failed');
            });
    });


    const searchInput = $('#acme-search');
    const statusFilter = $('#acme-filter-status');
    const dateFilter = $('#acme-filter-date');
    const emptyMsg = $('#acme-search-empty');
    const table = $('#acme-leads-table');

    function applyUnifiedFilters() {
        const searchVal = searchInput.val() ? searchInput.val().trim().toLowerCase() : "";
        const statusVal = statusFilter.val() ? statusFilter.val().toLowerCase() : "";
        const dateVal = dateFilter.val() ? dateFilter.val() : "";

        const rows = table.find('tbody tr');
        let visibleCount = 0;

        rows.each(function () {
            const row = $(this);
            if (row.children().length < 5) return;

            const cells = row.children();
            const nameText = cells.eq(2).text().toLowerCase();
            const emailText = cells.eq(4).text().toLowerCase();
            const statusSelect = row.find('select[name="status"]');
            const rowStatus = statusSelect.val() ? statusSelect.val().toLowerCase() : "";
            const dateText = cells.eq(9).text();

            let show = true;

            if (searchVal && !(nameText.includes(searchVal) || emailText.includes(searchVal))) {
                show = false;
            }
            if (statusVal && rowStatus !== statusVal) {
                show = false;
            }
            if (dateVal && !dateText.includes(dateVal)) {
                show = false;
            }

            row.toggle(show);
            if (show) visibleCount++;
        });

        if (emptyMsg.length) {
            emptyMsg.toggle(visibleCount === 0 && (searchVal !== "" || statusVal !== "" || dateVal !== ""));
        }
    }

    $(document).on('input', '#acme-search', applyUnifiedFilters);
    $(document).on('change', '#acme-filter-status, #acme-filter-date', applyUnifiedFilters);
});


// Initialize CSV export
(function () {

    const btn = document.getElementById('acme-export-csv');
    const table = document.getElementById('acme-leads-table');

    if (!btn || !table) return;

    // Prevent duplicate handler binding
    if (btn.dataset.bound === "true") return;
    btn.dataset.bound = "true";

    btn.addEventListener('click', function () {

        const thead = table.querySelector('thead');
        const tbody = table.querySelector('tbody');

        if (!thead || !tbody) return;

        let csv = [];

        const headers = thead.querySelectorAll('th');
        let headerRow = [];

        headers.forEach(th => {
            headerRow.push('"' + th.innerText.replace(/"/g, '""') + '"');
        });

        csv.push(headerRow.join(','));

        const rows = tbody.querySelectorAll('tr');

        rows.forEach(row => {

            if (row.dataset.v3Visible === "0") return;

            const cols = row.querySelectorAll('td');
            if (!cols.length) return;

            let rowData = [];

            cols.forEach(col => {
                rowData.push('"' + col.innerText.replace(/"/g, '""') + '"');
            });

            csv.push(rowData.join(','));

        });

        if (csv.length <= 1) {
            alert('No data to export');
            return;
        }

        const today = new Date().toISOString().split('T')[0];

        const blob = new Blob(['\uFEFF' + csv.join("\n")], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);

        const a = document.createElement('a');
        a.href = url;
        a.download = `leads-${today}.csv`;

        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);

        URL.revokeObjectURL(url);

    });

})();


jQuery(function ($) {

    // Prevent duplicate handler binding
    if (window.ACME_DELETE_SYSTEM_ACTIVE === true) return;
    if (window.ACME_DELETE_HARDENED === true) return;
    window.ACME_DELETE_HARDENED = true;

    const ajaxUrl = window.ajaxurl;
    const nonce = window.acme_admin?.nonce;

    const table = document.getElementById('acme-leads-table');
    if (!table) return;


    // Handle delete action (capture mode)
    document.addEventListener('click', function (e) {

        const bulkBtn = e.target.closest('#acme-bulk-delete-btn');
        const deleteBtn = e.target.closest('.acme-delete-btn');

        if (!bulkBtn && !deleteBtn) return;

        e.preventDefault();
        e.stopImmediatePropagation();


        if (bulkBtn) {

            if (bulkBtn.dataset.loading === "1") return;

            const selected = document.querySelectorAll('.acme-select-row:checked');
            const ids = [];

            selected.forEach(cb => {
                const val = parseInt(cb.value);
                if (val) ids.push(val);
            });

            if (!ids.length) {
                alert('No rows selected');
                return;
            }

            // if (!confirm('Delete selected leads?')) return;
            console.log('Bulk delete clicked:', ids);

            bulkBtn.dataset.loading = "1";
            const original = bulkBtn.innerText;
            bulkBtn.innerText = "Deleting...";

            const params = new URLSearchParams();
            params.append('action', 'acme_bulk_delete_leads');
            params.append('_wpnonce', nonce);
            ids.forEach(id => {
                params.append('lead_ids[]', id);
            });

            fetch(ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params
            })
                .then(res => res.json())
                .then(res => {
                    console.log('Bulk delete response:', res);

                    if (res.success === true) {
                        selected.forEach(cb => {
                            const row = cb.closest('tr');
                            if (row) row.remove();
                        });
                        bulkBtn.dataset.loading = "0";
                        bulkBtn.innerText = original;
                    } else {
                        alert('Delete failed');
                        bulkBtn.dataset.loading = "0";
                        bulkBtn.innerText = original;
                    }

                })
                .catch(() => {
                    alert('Server error');
                    bulkBtn.dataset.loading = "0";
                    bulkBtn.innerText = original;
                });

        }


        if (deleteBtn) {

            if (deleteBtn.dataset.loading === "1") return;

            const id = parseInt(deleteBtn.dataset.id);
            if (!id) return;

            // if (!confirm('Delete lead #' + id + '?')) return;
            console.log('Single delete clicked:', id);

            deleteBtn.dataset.loading = "1";
            const original = deleteBtn.innerText;
            deleteBtn.innerText = "Deleting...";

            fetch(ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                    action: 'acme_delete_lead',
                    lead_id: id,
                    _wpnonce: nonce
                })
            })
                .then(res => res.json())
                .then(res => {
                    console.log('Single delete response:', res);

                    if (res.success === true) {
                        const row = deleteBtn.closest('tr');
                        if (row) row.remove();
                    } else {
                        alert('Delete failed');
                        deleteBtn.dataset.loading = "0";
                        deleteBtn.innerText = original;
                    }

                })
                .catch(() => {
                    alert('Server error');
                    deleteBtn.dataset.loading = "0";
                    deleteBtn.innerText = original;
                });

        }

    }, true); // CAPTURE MODE

});
