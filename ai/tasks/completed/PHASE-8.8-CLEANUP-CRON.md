# ============================================
# TASK: PHASE-8.8-CLEANUP-CRON.md
# ============================================

GOAL:
Automatically delete old duplicate leads using WP Cron

STEP:
Create cron job and cleanup function

FILES:
- wp-content/plugins/acme-core/dal/form-dal.php
- wp-content/plugins/acme-core/acme-core.php

INPUT:
- status = duplicate
- created_at

EXPECTED_OUTPUT:
- Old duplicate leads removed
- Parent leads untouched
- No errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 8.8)
- If mismatch → STOP

DUPLICATION_CHECK:
- Cron must not already exist

PRECONDITION_CHECK:
- status column exists → YES
- created_at exists → YES

STRICT_SCOPE:
- Only cleanup logic
- No insert/update change

CONSTRAINTS:
- Must use wp_schedule_event
- Must use wp_clear_scheduled_hook on deactivation
- No full table delete

SECURITY_HINT:
- Safe query only

FAIL_CONDITIONS:
- Wrong records deleted
- Cron not running
- SQL error

SUCCESS_CRITERIA:
- Old duplicates deleted
- System stable

# ============================================