# ============================================
# TASK: PHASE-5.7_REMOVE_THEME_QUERIES.md
# ============================================

GOAL:
Remove direct database queries from theme and use wrapper functions

STEP:
Replace $wpdb queries with DAL wrapper functions

FILES:
wp-content/themes/ (scan all theme files)

EXPECTED_OUTPUT:
- No $wpdb queries in theme
- Wrapper functions used instead
- No PHP errors

TASK_VALIDATION:
- Must match PHASE 5.7
- If mismatch → STOP

DUPLICATION_CHECK:
- If already replaced → STOP

STRICT_SCOPE:
- Only replace queries
- No UI change
- No logic change

CONSTRAINTS:
- Use wrapper functions only
- Do not modify plugin files
- Maintain same output

# ============================================