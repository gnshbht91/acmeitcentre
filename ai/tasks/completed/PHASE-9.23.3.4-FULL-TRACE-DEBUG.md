# ============================================
# TASK: PHASE-9.23.3.4-FULL-TRACE-DEBUG.md
# ============================================

GOAL:
Trace complete execution flow of bulk status update and identify exact failure layer.

STEP:
Add controlled debug logs in JS and validate full request-response cycle.

FILES:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

EDIT_LOCATION:

1. OPEN admin.js

2. FIND:
   fetch(ajaxurl

3. INSERT logs ABOVE this line

4. FIND:
   .then(data => {

5. INSERT log INSIDE block (first line)

--------------------------------------------

PRECONDITION_CHECK:

✔ admin.js exists  
✔ fetch(ajaxurl) exists  
✔ bulk status feature exists  

IF ANY FAIL:
→ STOP

--------------------------------------------

DUPLICATION_CHECK:

Search:

[STEP 1]

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE:

YOU MUST:

✔ Add logs ONLY  

YOU MUST NOT:

❌ Modify logic  
❌ Modify conditions  
❌ Modify flow  

--------------------------------------------

CONSTRAINTS:

ADD EXACT CODE ONLY:

console.log('[STEP 1] CLICK START');

console.log('[STEP 2] DATA PREPARED:', {
    ids: ids,
    status: selectedStatus
});

INSIDE RESPONSE:

console.log('[STEP 3] RESPONSE RECEIVED:', data);

--------------------------------------------

SUCCESS_CRITERIA:

✔ Logs visible in console  
✔ No JS error  
✔ Feature still works  

--------------------------------------------

FAIL_CONDITIONS:

❌ No logs  
❌ Wrong placement  
❌ Code modified  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  

UPDATE:
- TASK_BOARD.md  
- PROJECT_STATE.md  
- DEV_LOG.md  

VERIFY consistency  

# ============================================