# ============================================
# TASK: PHASE-8.4-FIX-ASSIGNMENT.md
# ============================================

GOAL:
Fix unsafe lead assignment by restricting assignment to authorized user roles only.

STEP:
Update user selection logic to only include allowed roles (admin/editor).

FILES:
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Lead insert process

EXPECTED_OUTPUT:
- Leads assigned only to authorized users
- No random subscriber/customer assignment
- Stable assignment logic

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.4-FIX-ASSIGNMENT)
- If mismatch → STOP

DUPLICATION_CHECK:
- If role-based filtering already exists → STOP

PRECONDITION_CHECK:
- get_users() used → YES

STRICT_SCOPE:
- ONLY assignment logic fix
- NO DB change
- NO UI change

CONSTRAINTS:
- Must use role__in filter
- Must not break insert flow

SECURITY_HINT:
- Prevent unauthorized assignment
- Protect CRM data

FAIL_CONDITIONS:
- Subscriber assigned
- Empty user list crash

SUCCESS_CRITERIA:
- Only admin/editor assigned
- No errors

# ============================================