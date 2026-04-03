# ============================================
# TASK: PHASE-3.7_ADD_BUSINESS_FIELDS.md
# ============================================

GOAL:
Settings page me business fields add karna (including Google Map link)

STEP:
Existing settings form ke table me 3 new fields insert karna

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

INPUT:
None

FIELDS:
- Business Name (text)
- Business Hours (text)
- Google Map Link (url)

EXPECTED_OUTPUT:
- 3 new fields admin UI me visible ho
- Existing fields unchanged rahe
- Proper WP alignment maintain ho
- No PHP error aaye

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- Agar fields already exist → STOP

STRICT_SCOPE:
- Modify ONLY existing <table class="form-table">
- Do NOT create new table
- Do NOT modify save logic
- Do NOT modify other files

CONSTRAINTS:
- Follow WordPress admin UI structure
- No PHP logic add karna
- No validation add karna
- No scope expansion

# ============================================