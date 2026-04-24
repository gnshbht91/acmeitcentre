# ============================================
# TASK: PHASE-9.23.3.3-FIX-STRICT-COMPLIANCE.md
# ============================================

GOAL:
Remove all non-deterministic logic and restore exact static UI and JS behavior.

--------------------------------------------

FILES ALLOWED TO MODIFY (STRICT)

ONLY THESE FILES:

1. /wp-content/plugins/acme-core/acme-core.php
2. /wp-content/plugins/acme-core/assets/js/admin.js

IF ANY OTHER FILE IS MODIFIED:
→ STOP

--------------------------------------------

PART 1 — FIX UI (acme-core.php)

STEP 1 — OPEN FILE

acme-core.php

---

STEP 2 — FIND START POINT

Search EXACT:

<select id="acme-bulk-status"

---

STEP 3 — FIND END POINT

Find corresponding closing button:

</button>

(for Update Status button)

---

STEP 4 — DELETE EXACT BLOCK

Delete from:

<select id="acme-bulk-status"

TO:

</button>

(ONLY this block)

---

STEP 5 — INSERT EXACT CODE AT SAME POSITION

<select id="acme-bulk-status">
    <option value="">Select Status</option>
    <option value="new">New</option>
    <option value="contacted">Contacted</option>
    <option value="converted">Converted</option>
</select>

<button id="acme-bulk-status-btn">Update Status</button>

---

STRICT RULES (UI)

✔ ONLY this block replaced  
✔ DO NOT touch anything else  
✔ NO PHP allowed inside options  

--------------------------------------------

PART 2 — FIX JS (admin.js)

STEP 6 — OPEN FILE

assets/js/admin.js

---

STEP 7 — FIND START OF OLD LOGIC

Search EXACT:

acme-bulk-status-btn

---

STEP 8 — IDENTIFY FULL BLOCK

From:

const statusBtn = document.getElementById('acme-bulk-status-btn');

TO:

end of its closing bracket }

---

STEP 9 — DELETE ONLY THIS BLOCK

DO NOT delete any other JS

---

STEP 10 — SCROLL TO END OF FILE

---

STEP 11 — ADD EXACT NEW CODE

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

✔ ONLY this block replaced  
✔ DO NOT wrap in DOMContentLoaded  
✔ DO NOT modify existing JS  

--------------------------------------------

VALIDATION CHECK

✔ No page reload exists  
✔ No dynamic PHP exists  
✔ JS matches exact block  
✔ No console error  

--------------------------------------------

FAIL CONDITIONS

❌ Partial delete  
❌ Wrong block replaced  
❌ Extra code modified  

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