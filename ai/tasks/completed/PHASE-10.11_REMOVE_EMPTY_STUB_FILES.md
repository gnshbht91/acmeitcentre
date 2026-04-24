# ============================================
# TASK: PHASE-10.11_REMOVE_EMPTY_STUB_FILES.md
# ============================================

GOAL:
Remove unused stub files that contain no functional code.

STEP:
Identify and delete files that only contain ABSPATH guard and no logic.

FILES:
wp-content/plugins/acme-core/

TARGET_FILES:
- includes/dal/class-batch-dal.php
- modules/module-crm.php
- modules/module-course-engine.php

EXPECTED_OUTPUT:
- stub files removed
- plugin unaffected
- no PHP errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.11_REMOVE_EMPTY_STUB_FILES)
- If mismatch → STOP

DUPLICATION_CHECK:
- If files already removed → STOP

PRECONDITION_CHECK:
- files exist → YES
- files contain ONLY ABSPATH guard → VERIFY

STRICT_SCOPE:
- ONLY delete confirmed empty stub files
- DO NOT delete any file with logic

CONSTRAINTS:
- No code changes
- No refactoring

FAIL_CONDITIONS:
- file with logic deleted
- plugin breaks

SUCCESS_CRITERIA:
- only empty files removed
- system stable

# ============================================