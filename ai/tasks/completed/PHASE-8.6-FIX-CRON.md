# ============================================
# TASK: PHASE-8.6-FIX-CRON.md
# ============================================

GOAL:
Fix and validate cron cleanup system to properly handle duplicate and old lead data.

STEP:
Ensure cron job is scheduled, runs correctly, and deletes/cleans intended records safely.

FILES:
/wp-content/plugins/acme-core/modules/module-cron.php
/wp-content/plugins/acme-core/acme-core.php
/wp-content/plugins/acme-core/dal/form-dal.php

INPUT:
Existing lead data (including duplicates)

EXPECTED_OUTPUT:
- Cron job scheduled
- Cleanup logic working
- No accidental deletion
- System performance improved

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.6-FIX-CRON)
- If mismatch → STOP

DUPLICATION_CHECK:
- If cron already verified → STOP

PRECONDITION_CHECK:
- Duplicate system working → YES
- DB schema correct → YES

STRICT_SCOPE:
- ONLY cron + cleanup fix
- NO schema change
- NO UI change

CONSTRAINTS:
- Must use wp_schedule_event
- Must not delete valid leads
- Must use safe queries

SECURITY_HINT:
- Avoid mass deletion
- Always filter conditions

FAIL_CONDITIONS:
- Cron not running
- Wrong data deleted
- SQL error

SUCCESS_CRITERIA:
- Cron scheduled
- Cleanup working
- No data loss

# ============================================