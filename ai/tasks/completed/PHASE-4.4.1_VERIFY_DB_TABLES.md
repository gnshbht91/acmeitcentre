# ============================================
# TASK: PHASE-4.4.1_VERIFY_DB_TABLES.md
# ============================================

GOAL:
Ensure karna ki dbDelta execution ke baad database tables successfully create hue hain

STEP:
Plugin re-activate karke given DB URL par jaa kar tables verify karna

FILES:
N/A (verification only)

ACCESS_URL:
http://localhost:10006/?username=root&db=local

EXPECTED_OUTPUT:
- 3 tables present ho:
  - wp_acme_leads
  - wp_acme_logs
  - wp_acme_audit
- Tables visible in database UI
- No error

TASK_VALIDATION:
- Must follow PHASE 4.4
- If tables missing → FAIL

STRICT_SCOPE:
- No code change
- No DB modification
- Only verification

CONSTRAINTS:
- Must use given URL
- Must visually confirm tables
- Guessing not allowed

# ============================================