# ============================================
# TASK: PHASE-9.23.3.3-BULK-STATUS-UI-JS.md
# ============================================

GOAL:
Add bulk status dropdown + button and connect it with existing AJAX system.

--------------------------------------------

FILES ALLOWED TO MODIFY (STRICT)

ONLY THESE 2 FILES:

1. /wp-content/plugins/acme-core/acme-core.php
2. /wp-content/plugins/acme-core/assets/js/admin.js

IF ANY OTHER FILE IS MODIFIED:
→ STOP

--------------------------------------------

PART 1 — UI (acme-core.php)

STEP 1 — OPEN FILE

acme-core.php

---

STEP 2 — FIND SAFE ANCHOR

Search EXACT:

id="acme-bulk-delete-btn"

---

STEP 3 — INSERT LOCATION

INSERT IMMEDIATELY AFTER this button

---

STEP 4 — ADD THIS EXACT CODE

<select id="acme-bulk-status">
    <option value="">Select Status</option>
    <option value="new">New</option>
    <option value="contacted">Contacted</option>
    <option value="converted">Converted</option>
</select>

<button id="acme-bulk-status-btn">Update Status</button>

---

STRICT RULES (UI)

✔ DO NOT modify existing HTML  
✔ DO NOT move elements  
✔ ONLY add below delete button  

--------------------------------------------

PART 2 — JS (admin.js)

STEP 5 — OPEN FILE

assets/js/admin.js

---

STEP 6 — DUPLICATION CHECK

Search:

acme-bulk-status-btn

IF FOUND:
→ STOP (already implemented)

---

STEP 7 — FIND END OF FILE

Scroll to LAST LINE

---

STEP 8 — ADD CODE (NO NEW DOMContentLoaded)

ADD ONLY THIS BLOCK:

const statusBtn = document.getElementById('acme-bulk-status-btn');

if (statusBtn) {

    statusBtn.addEventListener('click', function() {

        const selectedStatus = document.getElementById('acme-bulk-status').value;

        if (!selectedStatus) {
            alert('Please select a status');
            return;
        }

        const checkboxes = document.querySelectorAll('.acme-select-row:checked');

        if (checkboxes.length === 0) {
            alert('Select at least one lead');
            return;
        }

        if (!confirm('Update status for selected leads?')) {
            return;
        }

        const ids = [];

        checkboxes.forEach(cb => {
            ids.push(cb.value);
        });

        const formData = new FormData();

        formData.append('action', 'acme_bulk_status_update');
        formData.append('_wpnonce', acme_admin.nonce);
        formData.append('status', selectedStatus);

        ids.forEach(id => {
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

                checkboxes.forEach(cb => {
                    cb.checked = false;
                });

            } else {
                alert(data.data.message || 'Error');
            }

        })
        .catch(() => {
            alert('Request failed');
        });

    });

}

---

STRICT RULES (JS)

✔ DO NOT wrap in DOMContentLoaded  
✔ DO NOT modify existing JS  
✔ ONLY append at end  
✔ DO NOT overwrite file  

--------------------------------------------

VALIDATION CHECK

✔ Dropdown visible  
✔ Button visible  
✔ Click works  
✔ AJAX fires  
✔ No console error  

--------------------------------------------

FAIL CONDITIONS

❌ JS wrapped incorrectly  
❌ Existing code changed  
❌ Wrong placement  
❌ Duplicate handler  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed

UPDATE:
- TASK_BOARD.md
- PROJECT_STATE.md
- DEV_LOG.md

VERIFY consistency

IF mismatch → STOP

# ============================================