# ============================================
# TASK: PHASE-9.24.5-FIX-DELETE-SYSTEM.md
# ============================================

GOAL:
Fix both single delete and bulk delete by creating one stable and complete delete pipeline.

FILES:
ONLY MODIFY:
- /wp-content/plugins/acme-core/assets/js/admin.js

READ ONLY:
- acme-core.php (to confirm selectors)

--------------------------------------------

PRECONDITION_CHECK

✔ delete button selector exists
✔ checkbox class exists

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_DELETE_SYSTEM_V1

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ ADD new system
✔ DO NOT delete existing code

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — SCROLL TO END

---

STEP 3 — ADD FULL DELETE SYSTEM

// ACME_DELETE_SYSTEM_V1 (DO NOT DUPLICATE)
jQuery(document).ready(function($) {

    const ajaxUrl = ajaxurl;

    // BULK DELETE
    $(document).on('click', '#acme-bulk-delete-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();

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
            ids: selectedIds
        }, function(response) {
            console.log("RESPONSE:", response);
            location.reload();
        });

    });

    // SINGLE DELETE
    $(document).on('click', '.acme-delete-btn', function(e) {
        e.preventDefault();
        e.stopPropagation();

        const id = $(this).data('id');

        if (!confirm('Delete lead #' + id + '?')) return;

        $.post(ajaxUrl, {
            action: 'acme_delete_lead',
            id: id
        }, function(response) {
            console.log("DELETE RESPONSE:", response);
            location.reload();
        });

    });

});

--------------------------------------------

SUCCESS_CRITERIA

✔ bulk delete works
✔ single delete works
✔ confirm shows
✔ page reloads

--------------------------------------------

FAIL_CONDITIONS

❌ click not working
❌ AJAX not firing
❌ delete not happening

--------------------------------------------