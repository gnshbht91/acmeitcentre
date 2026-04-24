# ============================================
# TASK: PHASE-9.24.3.2-MIME-FINAL-FIX.md
# ============================================

GOAL:
Fix CSV MIME type safely with exact targeting and no risk of wrong replacement.

FILES:
ONLY:
- /wp-content/plugins/acme-core/assets/js/admin.js

--------------------------------------------

PRECONDITION_CHECK

✔ ACME_EXPORT_CSV_V2 block exists

IF NOT:
→ STOP

--------------------------------------------

DUPLICATION_CHECK

Search EXACT:
text/csv;charset=utf-8;

IF FOUND:
→ STOP (already fixed)

--------------------------------------------

STRICT_SCOPE

✔ MODIFY ONLY CSV export block  
✔ DO NOT modify any other code  

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

STEP 3 — FIND FULL TARGET LINE

Search EXACT:

const blob = new Blob(['\uFEFF' + csv.join("\n")], { type: 'text/csv;charset=utf-8' });

IF NOT FOUND:
→ STOP

---

STEP 4 — VERIFY CONTEXT

Ensure this line is inside ACME_EXPORT_CSV_V2 block

IF NOT:
→ STOP

---

STEP 5 — REPLACE FULL LINE

REPLACE ENTIRE LINE WITH:

const blob = new Blob(['\uFEFF' + csv.join("\n")], { type: 'text/csv;charset=utf-8;' });

---

STEP 6 — SAVE FILE

---

STEP 7 — SYNTAX VALIDATION

✔ no missing brackets  
✔ no JS error  

---

STEP 8 — FUNCTION VALIDATION

✔ CSV downloads  
✔ Excel opens correctly  

--------------------------------------------

SUCCESS_CRITERIA

✔ exact line replaced  
✔ no duplicate semicolon  
✔ no wrong modification  

--------------------------------------------

FAIL_CONDITIONS

❌ wrong line replaced  
❌ JS break  

--------------------------------------------

# TASK COMPLETION PROTOCOL

MOVE task → completed  
UPDATE system files  

# ============================================