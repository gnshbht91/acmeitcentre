# ============================================
# TASK: PHASE-10.12A_RESTORE_CRITICAL_COMMENTS.md
# ============================================

GOAL:
Restore essential comments in admin.js for readability and maintainability without reintroducing dead code.

STEP:
Add minimal descriptive comments above critical logic blocks.

FILES:
wp-content/plugins/acme-core/assets/js/admin.js

TARGET_AREAS:
- Delete handler (capture-mode)
- CSV export block
- Initialization blocks

EXPECTED_OUTPUT:
- critical sections documented
- no dead code restored
- functionality unchanged

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.12A_RESTORE_CRITICAL_COMMENTS)
- If mismatch → STOP

DUPLICATION_CHECK:
- If comments already exist → STOP

PRECONDITION_CHECK:
- admin.js exists → YES
- comments mostly removed → YES

STRICT_SCOPE:
- ONLY add comments
- DO NOT modify logic
- DO NOT reintroduce old code

CONSTRAINTS:
- Keep comments short and meaningful
- No commented-out code blocks

FAIL_CONDITIONS:
- old code comments re-added
- logic modified
- syntax error

SUCCESS_CRITERIA:
- file readable
- logic unchanged
- no dead code

# ============================================