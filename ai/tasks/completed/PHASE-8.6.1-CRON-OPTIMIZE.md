# ============================================
# TASK: PHASE-8.6.1-CRON-OPTIMIZE.md
# ============================================

GOAL:
Optimize cron frequency to reduce unnecessary server load.

STEP:
Change cron schedule from hourly to daily.

FILES:
/wp-content/plugins/acme-core/acme-core.php

EXPECTED_OUTPUT:
- Cron runs once per day
- Reduced server load
- No functionality break

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-8.6.1-CRON-OPTIMIZE)
- If mismatch → STOP

STRICT_SCOPE:
- ONLY change cron frequency

CONSTRAINTS:
- Must not break scheduling logic

SUCCESS_CRITERIA:
- Cron scheduled daily
- Cleanup still works

# ============================================