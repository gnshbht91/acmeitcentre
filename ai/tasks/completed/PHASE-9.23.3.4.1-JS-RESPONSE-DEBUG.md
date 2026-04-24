# ============================================
# TASK: PHASE-9.23.3.4.1-JS-RESPONSE-DEBUG.md
# ============================================

GOAL:
Log exact AJAX response in browser console without modifying logic.

TYPE:
DEBUG TASK (SAFE — NO LOGIC CHANGE)

--------------------------------------------

FILES ALLOWED TO MODIFY (STRICT)

ONLY THIS FILE:

/wp-content/plugins/acme-core/assets/js/admin.js

IF ANY OTHER FILE IS MODIFIED:
→ STOP

--------------------------------------------

PRE-VALIDATION

YOU MUST VERIFY:

✔ admin.js file exists
✔ Bulk status JS exists (search: acme-bulk-status-btn)

IF NOT FOUND:
→ STOP

--------------------------------------------

DUPLICATION CHECK

Search:

AJAX RESPONSE:

IF FOUND:
→ STOP (already added)

--------------------------------------------

STEP 1 — OPEN FILE

assets/js/admin.js

---

STEP 2 — FIND CORRECT BLOCK

Search EXACT:

acme-bulk-status-btn

Then find inside same block:

.then(res => res.json())

NEXT LINE:

.then(data => {

---

STEP 3 — INSERT DEBUG LINE

ADD EXACT LINE IMMEDIATELY BELOW:

.then(data => {

INSERT:

console.log('AJAX RESPONSE:', data);

--------------------------------------------

EXPECTED FINAL STRUCTURE

.then(data => {

    console.log('AJAX RESPONSE:', data);

    if (data.success) {

--------------------------------------------

STRICT RULES

YOU MUST:

✔ Add ONLY ONE line  
✔ Insert ONLY at correct location  

YOU MUST NOT:

❌ Modify any existing code  
❌ Move any code  
❌ Add multiple logs  

--------------------------------------------

VALIDATION

✔ No JS error  
✔ Console shows AJAX RESPONSE  
✔ Feature still works  

--------------------------------------------

FAIL CONDITIONS

❌ Log not visible  
❌ Wrong placement  
❌ Logic changed  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md
- PROJECT_STATE.md
- DEV_LOG.md

VERIFY consistency

--------------------------------------------

# DEBUG CLEANUP NOTE (IMPORTANT)

AFTER DEBUG COMPLETE:

REMOVE this console.log in next task

# ============================================