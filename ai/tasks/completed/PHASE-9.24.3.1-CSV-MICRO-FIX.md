# ============================================
# TASK: PHASE-9.24.3.1-CSV-MICRO-FIX.md
# ============================================

GOAL:
Fix CSV encoding safely without affecting any other code.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ ACME_EXPORT_CSV_V2 exists

IF NOT:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search:
charset=utf-8

IF FOUND:
→ STOP

--------------------------------------------

STRICT_SCOPE

✔ MODIFY ONLY CSV BLOCK  
✔ DO NOT touch other logic  

--------------------------------------------

STEP 1 — OPEN FILE

admin.js

---

STEP 2 — FIND BLOCK

Search:
ACME_EXPORT_CSV_V2

IF NOT FOUND:
→ STOP

---

STEP 3 — FIND TARGET LINE (STRICT)

Search EXACT:

const blob = new Blob([csv.join("\n")]

IF NOT FOUND:
→ STOP

---

STEP 4 — VERIFY CONTEXT

Ensure this line is inside ACME_EXPORT_CSV_V2 block

IF NOT:
→ STOP

---

STEP 5 — REPLACE LINE

REPLACE:

const blob = new Blob([csv.join("\n")], { type: 'text/csv' });

WITH:

const blob = new Blob(['\uFEFF' + csv.join("\n")], { type: 'text/csv;charset=utf-8;' });

---

STEP 6 — SAVE FILE

---

STEP 7 — VALIDATION

✔ CSV opens correctly  
✔ no syntax error  
✔ export works  

--------------------------------------------

SUCCESS_CRITERIA

✔ Excel safe  
✔ Unicode safe  
✔ no regression  

--------------------------------------------

FAIL_CONDITIONS

❌ wrong line replaced  
❌ JS break  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  

# ============================================