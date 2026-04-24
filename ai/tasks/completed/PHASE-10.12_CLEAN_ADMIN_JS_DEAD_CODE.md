# ============================================
# TASK: PHASE-10.12_CLEAN_ADMIN_JS_DEAD_CODE.md
# ============================================

GOAL:
Remove dead commented-out code from admin.js to reduce clutter and prevent confusion.

STEP:
Delete only commented code blocks.

FILES:
wp-content/plugins/acme-core/assets/js/admin.js

TARGET:
- old delete handler versions
- commented bulk delete blocks
- unused commented logic

EXPECTED_OUTPUT:
- admin.js reduced in size
- active code unchanged
- delete system still works

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.12_CLEAN_ADMIN_JS_DEAD_CODE)
- If mismatch → STOP

DUPLICATION_CHECK:
- If already cleaned → STOP

PRECONDITION_CHECK:
- admin.js exists → YES

STRICT_SCOPE:
- ONLY remove commented code
- DO NOT modify active code
- DO NOT refactor

CONSTRAINTS:
- Keep all working logic
- No new code

FAIL_CONDITIONS:
- delete stops working
- active code removed
- syntax error

SUCCESS_CRITERIA:
- no commented blocks remain
- file smaller
- functionality unchanged

# ============================================