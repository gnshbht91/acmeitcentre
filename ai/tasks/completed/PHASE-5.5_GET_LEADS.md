# ============================================
# TASK: PHASE-5.5_GET_LEADS.md
# ============================================

GOAL:
Create DAL method to fetch leads with optional limit

STEP:
Add get_leads($limit = 20) method

FILES:
wp-content/plugins/acme-core/includes/dal/class-acme-dal.php

EXPECTED_OUTPUT:
- Method get_leads() created
- Returns array of leads OR empty array
- Supports limit
- No PHP error

TASK_VALIDATION:
- Must match PHASE 5.5
- If mismatch → STOP

DUPLICATION_CHECK:
- If method exists → STOP

STRICT_SCOPE:
- Only method creation
- No UI
- No external calls

CONSTRAINTS:
- Use $wpdb
- Use prepare for limit
- Return array

# ============================================