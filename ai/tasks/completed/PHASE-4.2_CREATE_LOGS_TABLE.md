# ============================================
# TASK: PHASE-4.2_CREATE_LOGS_TABLE.md
# ============================================

GOAL:
WordPress database ke liye logs table ka SQL structure define karna

STEP:
Logs table ka dbDelta-compatible SQL function create karna

FILES:
wp-content/plugins/acme-core/includes/db/logs-table.php

EXPECTED_OUTPUT:
- Logs table SQL defined ho
- dbDelta compatible syntax ho
- No execution (only structure)

TABLE NAME:
{$wpdb->prefix}acme_logs

COLUMNS:
- id (primary key)
- lead_id (relation to leads table)
- action (log type)
- message (log message)
- created_at

TASK_VALIDATION:
- Must match PHASE 4.2
- If mismatch → STOP

STRICT_SCOPE:
- Only SQL structure define karna
- No db execution
- No activation hook

CONSTRAINTS:
- Use BIGINT for id and lead_id
- Use TEXT for message
- Use VARCHAR for action
- Use DATETIME for created_at
- Primary key required

# ============================================