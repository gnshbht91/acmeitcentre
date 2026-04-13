# ============================================
# TASK: SYSTEM-7.3.2-CLEANUP-BACKUP.md
# ============================================

GOAL:
Remove unauthorized backup file created during honeypot fix

STEP:
Delete backup file from modules directory

FILES:
- wp-content/plugins/acme-core/modules/module-form-backup.php

INPUT:
None

EXPECTED_OUTPUT:
- Backup file deleted
- No duplicate module file exists
- No PHP errors

TASK_VALIDATION:
- File must exist before deletion
- If not found → STOP

DUPLICATION_CHECK:
- Ensure no other backup files remain
- If found → FAIL

PRECONDITION_CHECK:
- module-form-backup.php exists → YES
- module-form.php exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only delete backup file
- No modification to other files
- No refactor

CONSTRAINTS:
- Do NOT touch module-form.php
- Do NOT modify loader.php
- No additional cleanup

SECURITY_HINT:
- N/A

FAIL_CONDITIONS:
- Wrong file deleted
- module-form.php affected
- PHP error

SUCCESS_CRITERIA:
- Backup file removed
- Only original module remains
- System stable

# ============================================