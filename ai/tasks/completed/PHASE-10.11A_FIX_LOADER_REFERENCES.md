# ============================================
# TASK: PHASE-10.11A_FIX_LOADER_REFERENCES.md
# ============================================

GOAL:
Clean loader.php by removing references to deleted stub files.

STEP:
Remove require/include statements referencing deleted files.

FILES:
wp-content/plugins/acme-core/core/loader.php

TARGET_REFERENCES:
- class-batch-dal.php
- module-crm.php
- module-course-engine.php

EXPECTED_OUTPUT:
- no references to deleted files
- loader.php clean
- plugin loads without error

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.11A_FIX_LOADER_REFERENCES)
- If mismatch → STOP

DUPLICATION_CHECK:
- If references already removed → STOP

PRECONDITION_CHECK:
- loader.php exists → YES
- references exist → YES

STRICT_SCOPE:
- ONLY remove require/include lines for deleted files
- DO NOT modify any other code

CONSTRAINTS:
- No refactoring
- No new logic
- No file creation

FAIL_CONDITIONS:
- wrong require removed
- syntax error
- plugin break

SUCCESS_CRITERIA:
- loader.php loads clean
- no missing file error
- no unused references

# ============================================