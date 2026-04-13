# ============================================
# TASK: PHASE-9.14-ASSIGNMENT-SAFETY.md
# ============================================

GOAL:
Ensure safe and valid user assignment by validating user_id before assignment and removing unsafe fallback logic.

STEP:
Validate user_id before assignment and prevent assignment if user does not exist or is invalid.

FILES:
- /wp-content/plugins/acme-core/modules/module-crm.php
- /wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
None

EXPECTED_OUTPUT:
- Assignment only allowed to valid existing users
- No assignment to deleted or invalid users
- No hardcoded fallback user_id used
- Invalid assignment request safely rejected
- Existing valid assignment continues to work

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-9.14-ASSIGNMENT-SAFETY)
- If mismatch → STOP

DUPLICATION_CHECK:
- If validation already implemented → STOP

PRECONDITION_CHECK:
- Assignment logic exists → YES
- user_id field exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- ONLY add validation
- DO NOT change assignment logic flow
- DO NOT modify unrelated code

CONSTRAINTS:
- Use get_user_by('id', $user_id) to validate
- Reject assignment if user not found
- Do NOT fallback to user_id = 1
- Use safe exit (return / wp_send_json_error)

SECURITY_HINT:
- Validation required → YES
- Capability already handled → NO CHANGE
- Nonce already handled → NO CHANGE

FAIL_CONDITIONS:
- Assignment allowed to invalid user
- Fallback user still exists
- System breaks on valid assignment

SUCCESS_CRITERIA:
- Only valid users assigned
- No fallback assignment
- Invalid input blocked
- System stable

# ============================================