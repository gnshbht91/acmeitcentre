# ============================================
# TASK: PHASE-4.3_CREATE_AUDIT_TABLE.md
# ============================================

GOAL:
Audit tracking ke liye database table ka SQL structure define karna

STEP:
Audit table ka dbDelta-compatible SQL function create karna

FILES:
wp-content/plugins/acme-core/includes/db/audit-table.php

EXPECTED_OUTPUT:
- Audit table SQL defined ho
- dbDelta compatible syntax ho
- No execution (only structure)
- No PHP error aaye

TABLE NAME:
{$wpdb->prefix}acme_audit

COLUMNS:
- id (primary key)
- user_id (WordPress user)
- action
- target
- ip_address
- created_at

TASK_VALIDATION:
- Must match PHASE 4.3
- If mismatch → STOP

STRICT_SCOPE:
- Only SQL structure define karna
- No db execution
- No hooks
- No other files modify

CONSTRAINTS:
- Use BIGINT for id and user_id
- Use VARCHAR for action, target, ip_address
- Use DATETIME for created_at
- Primary key required
- dbDelta compatible syntax

# ============================================