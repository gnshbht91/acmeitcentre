# ============================================
# TASK: PHASE-8.1-FIX-DUPLICATE.md
# ============================================

GOAL:
Fix duplicate detection system by properly integrating acme_check_duplicate() into AJAX handler.

STEP:
Update form handler to:
- Check for existing lead using acme_check_duplicate()
- Assign parent_id if duplicate found
- Set status accordingly (new / duplicate)

FILES:
/wp-content/plugins/acme-core/modules/module-form.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Form submission (email + phone)

EXPECTED_OUTPUT:
- Duplicate leads detected
- parent_id correctly assigned
- status set to 'duplicate' when needed

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.1-FIX-DUPLICATE)
- If mismatch → STOP

DUPLICATION_CHECK:
- If duplicate logic already connected → STOP

PRECONDITION_CHECK:
- acme_check_duplicate() exists → YES
- DAL insert working → YES

STRICT_SCOPE:
- ONLY connect duplicate logic
- NO DB changes
- NO tracking changes

CONSTRAINTS:
- Must not break insert flow
- Must not modify unrelated logic

SECURITY_HINT:
- No raw input usage
- Use sanitized values

FAIL_CONDITIONS:
- Duplicate not detected
- parent_id incorrect
- status incorrect

SUCCESS_CRITERIA:
- Duplicate properly identified
- Parent-child relationship working
- No errors

# ============================================