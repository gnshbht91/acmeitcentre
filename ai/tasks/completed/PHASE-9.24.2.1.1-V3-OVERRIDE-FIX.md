# ============================================
# TASK: PHASE-9.24.2.1.1-V3-OVERRIDE-FIX.md
# ============================================

GOAL:
Ensure V3 filter engine has full control over filtering without relying on DOM override.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ ACME_FILTER_ENGINE_V3 exists

IF NOT:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
ACME_FILTER_ENGINE_V3_OVERRIDE_V2

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ MODIFY ONLY V3 BLOCK  
✔ DO NOT modify other code  

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — FIND BLOCK

Search:
ACME_FILTER_ENGINE_V3

---

STEP 3 — FIND FUNCTION

Search:
function applyFilters()

IF NOT FOUND:
→ STOP

---

STEP 4 — MODIFY LOGIC (IMPORTANT)

INSIDE rows.forEach:

REPLACE THIS LINE:

row.style.display = show ? '' : 'none';

WITH:

// FORCE FINAL STATE (V3 HAS FULL CONTROL)
row.dataset.v3Visible = show ? "1" : "0";
row.style.display = show ? '' : 'none';

---

STEP 5 — REMOVE ANY setTimeout OVERRIDE (IF EXISTS)

Search:
FINAL OVERRIDE PASS

DELETE ONLY that block

--------------------------------------------

WHY THIS WORKS

✔ V3 stores decision  
✔ V3 directly controls DOM  
✔ no race condition  
✔ no flicker  

--------------------------------------------

SUCCESS_CRITERIA

✔ consistent filtering  
✔ no flicker  
✔ V3 fully controls UI  

--------------------------------------------

FAIL_CONDITIONS

❌ flicker  
❌ inconsistent results  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  

# ============================================