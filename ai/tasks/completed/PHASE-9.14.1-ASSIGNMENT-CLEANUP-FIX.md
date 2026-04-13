# ============================================
# TASK: PHASE-9.14.1-ASSIGNMENT-CLEANUP-FIX.md
# ============================================

GOAL:
Fix assignment safety implementation by restoring strict scope compliance and ensuring safe handling of unassigned leads (user_id = 0).

STEP:
Revert unauthorized structural changes and ensure system safely handles unassigned leads.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/modules/module-crm.php
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- CRM menu and handler remain in original location (no structural move)
- Assignment logic remains intact
- user_id = 0 handled safely without breaking UI or queries
- No regression in CRM functionality

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.14.1-ASSIGNMENT-CLEANUP-FIX)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already compliant → STOP

PRECONDITION_CHECK:
- Assignment logic exists → YES
- CRM UI functional → YES

STRICT_SCOPE:
- ONLY fix structure and safety
- DO NOT change assignment logic
- DO NOT introduce new features

CONSTRAINTS:
- Restore original file responsibility (no module move)
- Ensure DAL queries support user_id = 0
- Ensure no WHERE user_id = 0 filtering issue

SECURITY_HINT:
- No new security required
- Maintain existing validation

FAIL_CONDITIONS:
- CRM menu breaks
- Assignment fails
- user_id = 0 causes errors
- Hooks not firing

SUCCESS_CRITERIA:
- System stable
- No structural violation
- Unassigned leads safe
- No UI or DB errors

# ============================================