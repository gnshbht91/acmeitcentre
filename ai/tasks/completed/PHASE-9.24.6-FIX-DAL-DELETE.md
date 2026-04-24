# ============================================
# TASK: PHASE-9.24.6-FIX-DAL-DELETE.md
# ============================================

GOAL:
Fix delete queries to use correct CRM table with WordPress-safe SQL.

FILES:
ONLY MODIFY:
- /wp-content/plugins/acme-core/dal/form-dal.php

--------------------------------------------

PRECONDITION_CHECK

✔ file exists
✔ delete functions exist

IF FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_DAL_DELETE_FIXED

IF FOUND:
→ STOP

--------------------------------------------

STEP 1 — OPEN FILE

form-dal.php

---

STEP 2 — FIND DELETE FUNCTIONS

Search:

acme_delete_lead
acme_bulk_delete_leads

IF NOT FOUND:
→ STOP

---

STEP 3 — IDENTIFY QUERY

Inside each function find:

$wpdb->query

---

STEP 4 — VERIFY TABLE NAME

IF table:

acme_form_entries

→ CHANGE to:

{$wpdb->prefix}acme_leads

---

STEP 5 — FIX SINGLE DELETE

Ensure:

$wpdb->prepare(
    "DELETE FROM {$wpdb->prefix}acme_leads WHERE id = %d",
    $id
)

---

STEP 6 — FIX BULK DELETE

Ensure:

$ids = implode(',', array_map('intval', $ids));

$query = "DELETE FROM {$wpdb->prefix}acme_leads WHERE id IN ($ids)";

$wpdb->query($query);

---

STEP 7 — ADD ERROR LOG

ADD AFTER QUERY:

if ($wpdb->last_error) {
    error_log("DELETE ERROR: " . $wpdb->last_error);
}

---

STEP 8 — SAVE FILE

---

STEP 9 — VALIDATION

✔ delete single row  
✔ delete multiple rows  
✔ rows removed from DB  

--------------------------------------------

SUCCESS_CRITERIA

✔ correct table used  
✔ no SQL error  
✔ delete works  

--------------------------------------------

FAIL_CONDITIONS

❌ wrong table  
❌ SQL error  
❌ no delete  

--------------------------------------------

# ============================================