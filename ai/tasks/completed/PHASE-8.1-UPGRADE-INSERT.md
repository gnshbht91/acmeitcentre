# ============================================
# TASK: PHASE-8.1-UPGRADE-INSERT.md
# ============================================

GOAL:
Upgrade database table and insert logic to support lead data (URL, UTM, IP, status, parent)

STEP:
Modify existing table using dbDelta and update DAL insert function

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Existing table + insert logic

EXPECTED_OUTPUT:
- Table upgraded with new columns
- Old data preserved
- Insert function supports new fields
- Backward compatible

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.1)
- If mismatch → STOP

DUPLICATION_CHECK:
- Columns must not already exist
- If exists → skip adding

PRECONDITION_CHECK:
- Table exists → YES
- DAL file exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only DB upgrade + insert function update
- No module changes yet

CONSTRAINTS:
- MUST use dbDelta()
- MUST NOT drop table
- MUST NOT remove existing columns

SECURITY_HINT:
- No raw SQL insert

FAIL_CONDITIONS:
- Table overwritten
- Data loss
- SQL error

SUCCESS_CRITERIA:
- New columns added safely
- Insert function updated
- Old system still works

# ============================================