# ============================================
# TASK: PHASE-5.3_INSERT_LEAD_DB.md
# ============================================

GOAL:
Form se aaya hua sanitized data database me insert karna

STEP:
$wpdb->insert() use karke lead data store karna

FILES:
wp-content/plugins/acme-core/includes/frontend/lead-form.php

DEPENDENCIES:
acme_leads table (already created)

EXPECTED_OUTPUT:
- Form submit par data DB me insert ho
- No PHP error
- No SQL error

TASK_VALIDATION:
- Must match PHASE 5.3
- If mismatch → STOP

STRICT_SCOPE:
- Only DB insert logic add karna
- Existing processing code untouched
- No redirect

CONSTRAINTS:
- Use $wpdb->insert()
- Use $wpdb->prefix
- No raw SQL
- Only sanitized variables

# ============================================