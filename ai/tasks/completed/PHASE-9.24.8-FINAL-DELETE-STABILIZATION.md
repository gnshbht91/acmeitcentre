# ============================================
# TASK: PHASE-9.24.8-FINAL-DELETE-STABILIZATION.md
# ============================================

GOAL:
Create a fully safe, deterministic delete system without breaking any existing behavior.

FILES:
ONLY MODIFY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ window.ajaxurl exists
✔ window.acme_admin.nonce exists

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_DELETE_SYSTEM_FINAL

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ MODIFY ONLY admin.js  
✔ DO NOT touch backend  

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — SCROLL TO END

---

STEP 3 — ADD SAFE SYSTEM

// ACME_DELETE_SYSTEM_FINAL (DO NOT DUPLICATE)
jQuery(function($) {

    const ajaxUrl = window.ajaxurl || '';
    const nonce = window.acme_admin?.nonce || '';

    if (!ajaxUrl || !nonce) {
        console.error("ACME: Missing config");
        return;
    }

    // SAFE UNBIND (SCOPED)
    $(document).off('click.acmeDelete', '#acme-bulk-delete-btn');
    $(document).off('click.acmeDelete', '.acme-delete-btn');

    // BULK DELETE
    $(document).on('click.acmeDelete', '#acme-bulk-delete-btn', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        const $btn = $(this);
        if ($btn.data('loading')) return;

        const originalText = $btn.text();

        const selectedIds = [];

        $('.acme-select-row:checked').each(function() {
            const val = parseInt($(this).val());
            if (val) selectedIds.push(val);
        });

        if (!selectedIds.length) {
            alert('No rows selected');
            return;
        }

        if (!confirm('Delete selected leads?')) return;

        $btn.data('loading', true).text('Deleting...');

        $.post(ajaxUrl, {
            action: 'acme_bulk_delete_leads',
            lead_ids: selectedIds,
            _wpnonce: nonce
        })
        .done(function(response) {

            if (response && response.success === true) {
                location.reload();
            } else if (response === "1") {
                location.reload();
            } else {
                console.error("Delete failed:", response);
                alert('Delete failed');
                $btn.data('loading', false).text(originalText);
            }

        })
        .fail(function(err) {
            console.error("AJAX ERROR:", err);
            alert('Server error');
            $btn.data('loading', false).text(originalText);
        });

    });

    // SINGLE DELETE
    $(document).on('click.acmeDelete', '.acme-delete-btn', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        const $btn = $(this);
        if ($btn.data('loading')) return;

        const originalText = $btn.text();

        const id = parseInt($btn.data('id'));
        if (!id) return;

        if (!confirm('Delete lead #' + id + '?')) return;

        $btn.data('loading', true).text('Deleting...');

        $.post(ajaxUrl, {
            action: 'acme_delete_lead',
            lead_id: id,
            _wpnonce: nonce
        })
        .done(function(response) {

            if (response && response.success === true) {
                location.reload();
            } else if (response === "1") {
                location.reload();
            } else {
                console.error("Delete failed:", response);
                alert('Delete failed');
                $btn.data('loading', false).text(originalText);
            }

        })
        .fail(function(err) {
            console.error("AJAX ERROR:", err);
            alert('Server error');
            $btn.data('loading', false).text(originalText);
        });

    });

});

--------------------------------------------

SUCCESS_CRITERIA

✔ popup stable  
✔ delete works  
✔ bulk works  
✔ no duplicate events  
✔ UI restores on failure  

--------------------------------------------

FAIL_CONDITIONS

❌ flicker  
❌ delete fail  
❌ console error  

--------------------------------------------

# ============================================