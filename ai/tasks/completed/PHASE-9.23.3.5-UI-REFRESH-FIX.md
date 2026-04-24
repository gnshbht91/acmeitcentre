# ============================================
# TASK: PHASE-9.23.3.5-UI-REFRESH-FIX.md
# ============================================

GOAL:
Reload page after successful bulk status update to reflect updated data.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

EDIT_LOCATION (STRICT)

STEP 1:

Search EXACT:

action', 'acme_bulk_status_update'

(This ensures correct block)

---

STEP 2:

Within same block find:

.then(data => {

---

STEP 3:

Inside this block find:

if (data.success)

---

PRECONDITION_CHECK

✔ fetch(ajaxurl) exists  
✔ bulk status action exists  
✔ success block exists  

IF ANY FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:

location.reload();

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

YOU MUST:

✔ Add ONLY ONE LINE  

YOU MUST NOT:

❌ Modify any existing line  
❌ Move any code  
❌ Change conditions  

--------------------------------------------

INSERT LOGIC (SAFE)

INSIDE:

if (data.success) {

ADD THIS LINE AS FIRST EXECUTION AFTER ALERT IF EXISTS  
OR as FIRST LINE IF ALERT NOT FOUND

--------------------------------------------

ADD EXACT CODE:

location.reload();

--------------------------------------------

FINAL STRUCTURE (REFERENCE ONLY)

if (data.success) {

    alert('Status updated');  // may exist

    location.reload();

    // existing code continues

}

--------------------------------------------

VALIDATION

✔ page reload happens  
✔ updated data visible  
✔ no console error  

--------------------------------------------

FAIL_CONDITIONS

❌ reload outside block  
❌ multiple reload  
❌ wrong block  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md  
- PROJECT_STATE.md  
- DEV_LOG.md  

VERIFY consistency  

# ============================================