# ============================================
# TASK: PHASE-9.24.7-FIX-DELETE-FULL-SYSTEM.md
# ============================================

GOAL:
Fix delete system by:
1. Disabling old conflicting event handlers
2. Ensuring correct AJAX + backend delete

FILES:
ONLY MODIFY:
- /wp-content/plugins/acme-core/assets/js/admin.js
- /wp-content/plugins/acme-core/dal/form-dal.php

--------------------------------------------

PRECONDITION_CHECK

✔ delete buttons exist
✔ AJAX working

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_DELETE_SYSTEM_V3

IF FOUND:
→ STOP

--------------------------------------------

PART 1 — JS EVENT CONTROL (CRITICAL)

OPEN:
admin.js

---

STEP 1 — SCROLL TO END

---

STEP 2 — ADD CONTROL BLOCK

// ACME_DELETE_SYSTEM_V3 (DO NOT DUPLICATE)
jQuery(document).ready(function($) {

    const ajaxUrl = ajaxurl;

    // REMOVE OLD HANDLERS
    $(document).off('click', '#acme-bulk-delete-btn');
    $(document).off('click', '.acme-delete-btn');

    // BULK DELETE
    $(document).on('click', '#acme-bulk-delete-btn', function(e) {
        e.preventDefault();

        const selectedIds = [];

        $('.acme-select-row:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert('No rows selected');
            return;
        }

        if (!confirm('Delete selected leads?')) return;

        $.post(ajaxUrl, {
            action: 'acme_bulk_delete_leads',
            lead_ids: selectedIds
        }, function(response) {

            if (response.success) {
                location.reload();
            } else {
                alert('Delete failed');
                console.log(response);
            }

        });

    });

    // SINGLE DELETE
    $(document).on('click', '.acme-delete-btn', function(e) {
        e.preventDefault();

        const id = $(this).data('id');

        if (!confirm('Delete lead #' + id + '?')) return;

        $.post(ajaxUrl, {
            action: 'acme_delete_lead',
            lead_id: id
        }, function(response) {

            if (response.success) {
                location.reload();
            } else {
                alert('Delete failed');
                console.log(response);
            }

        });

    });

});

--------------------------------------------

PART 2 — DAL SAFE FIX

OPEN:
form-dal.php

---

STEP 3 — FIND DELETE FUNCTIONS

Search:
acme_delete_lead
acme_bulk_delete_leads

---

STEP 4 — VERIFY TABLE USAGE

ONLY IF FOUND:

acme_form_entries

THEN REPLACE:

{$wpdb->prefix}acme_leads

---

STEP 5 — KEEP ORIGINAL STRUCTURE

✔ DO NOT change function names
✔ DO NOT change hooks

---

STEP 6 — SAVE FILES

---

STEP 7 — VALIDATION

✔ popup stable (no blink)
✔ delete works
✔ bulk works
✔ no console error

--------------------------------------------

SUCCESS_CRITERIA

✔ single handler active
✔ correct DB delete
✔ stable UI

--------------------------------------------

FAIL_CONDITIONS

❌ popup flicker
❌ delete fail
❌ duplicate event

# ============================================