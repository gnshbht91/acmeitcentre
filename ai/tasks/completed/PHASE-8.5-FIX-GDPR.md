# ============================================
# TASK: PHASE-8.5-FIX-GDPR.md
# ============================================

GOAL:
Fix GDPR logic to correctly match user data using OR condition instead of AND.

STEP:
Update SQL queries in GDPR export and erase functions to ensure correct data retrieval and deletion.

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
User request (email or phone)

EXPECTED_OUTPUT:
- Data matched using email OR phone
- Export returns correct data
- Erase deletes correct data

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.5-FIX-GDPR)
- If mismatch → STOP

DUPLICATION_CHECK:
- If OR logic already implemented → STOP

PRECONDITION_CHECK:
- GDPR functions exist → YES

STRICT_SCOPE:
- ONLY SQL condition fix
- NO UI change
- NO schema change

CONSTRAINTS:
- Must use OR condition
- Must not break query structure

SECURITY_HINT:
- Prevent partial data exposure
- Ensure complete data handling

FAIL_CONDITIONS:
- Data not found when exists
- Partial delete
- SQL error

SUCCESS_CRITERIA:
- Export works correctly
- Erase works correctly
- No errors

# ============================================