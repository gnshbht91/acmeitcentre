# ============================================
# TASK: PHASE-4.1_CREATE_LEADS_TABLE.md
# ============================================

GOAL:
WordPress database me leads table create karna

STEP:
Leads table ka SQL structure define karna (dbDelta compatible)

FILES:
wp-content/plugins/acme-core/includes/db/leads-table.php

EXPECTED_OUTPUT:
- Leads table SQL defined ho
- dbDelta compatible syntax ho
- No execution yet (only structure)

TABLE NAME:
{$wpdb->prefix}acme_leads

COLUMNS:
- id (primary key)
- name
- phone
- email
- course
- source
- status
- created_at

TASK_VALIDATION:
- Must match PHASE 4.1
- If mismatch → STOP

STRICT_SCOPE:
- Only SQL structure define karna
- No dbDelta execution
- No activation hook

CONSTRAINTS:
- Use correct WordPress charset/collation
- Use BIGINT for ID
- Use DATETIME for created_at
- Primary key required

# ============================================