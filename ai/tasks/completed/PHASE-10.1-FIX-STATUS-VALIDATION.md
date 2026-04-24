# ============================================
# TASK: PHASE-10.1-FIX-STATUS-VALIDATION.md
# ============================================

GOAL:
Ensure only valid statuses are saved in database using acme_get_valid_statuses().

FILES:
ONLY MODIFY:
- /wp-content/plugins/acme-core/dal/form-dal.php

DO NOT MODIFY:
- any other file

--------------------------------------------

PRECONDITION_CHECK

✔ file exists: form-dal.php
✔ function acme_get_valid_statuses() exists

IF NOT:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search EXACT:
ACME_STATUS_VALIDATION_V1

IF FOUND:
→ STOP

--------------------------------------------

STEP 1 — OPEN FILE

form-dal.php

---

STEP 2 — FIND STATUS UPDATE LOGIC

Search ANY of:

$status =
'status'
UPDATE

Locate function where status is passed to $wpdb->update OR $wpdb->query

IF NOT FOUND:
→ STOP

---

STEP 3 — VERIFY CONTEXT

Ensure:

✔ variable named $status exists
✔ used in database update

IF NOT:
→ STOP

---

STEP 4 — INSERT VALIDATION (EXACT LOCATION)

BEFORE the database update line, ADD:

// ACME_STATUS_VALIDATION_V1
$valid_statuses = acme_get_valid_statuses();

if (!in_array($status, $valid_statuses, true)) {
    return new WP_Error('invalid_status', 'Invalid status');
}

---

STEP 5 — ENSURE NO DUPLICATION

Search again:

ACME_STATUS_VALIDATION_V1

Ensure only ONE instance exists

---

STEP 6 — SAVE FILE

---

STEP 7 — VALIDATION

✔ valid status → works  
✔ invalid status → blocked  
✔ no PHP error  

---

--------------------------------------------

SUCCESS_CRITERIA

✔ invalid statuses cannot be saved  
✔ system continues working  

--------------------------------------------

FAIL_CONDITIONS

❌ PHP fatal error  
❌ valid status blocked  
❌ multiple validation blocks  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  

# ============================================