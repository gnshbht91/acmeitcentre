# ============================================
# TASK: PHASE-9.23.2.3-FIX-SCRIPT-STRUCTURE.md
# ============================================

GOAL:
Move inline bulk delete JavaScript from PHP file to dedicated JS file.

STEP:
Remove inline script and move logic to admin.js file.

FILES:
- /wp-content/plugins/acme-core/acme-core.php
- /wp-content/plugins/acme-core/assets/js/admin.js

EDIT_LOCATION:

1. acme-core.php:
   - Locate inline <script> related to bulk delete
   - REMOVE entire script block

2. admin.js:
   - ADD bulk delete JS logic at end of file

INPUT:
None

EXPECTED_OUTPUT:
- JS moved to admin.js
- No inline script remains
- Feature continues working

TASK_VALIDATION:
- Must match TASK_BOARD current task

DUPLICATION_CHECK:
- If script already in admin.js → STOP

PRECONDITION_CHECK:
- admin.js file exists → YES

STRICT_SCOPE:
- ONLY move JS
- DO NOT change logic
- DO NOT modify PHP structure except removing script

CONSTRAINTS:

IN admin.js:

- Use document.addEventListener('DOMContentLoaded', ...)
- Use same logic as existing script
- Use ajaxurl
- Use same action name

FAIL_CONDITIONS:
- JS logic changed
- PHP structure broken
- Script partially removed

SUCCESS_CRITERIA:
- Bulk delete works
- No JS error
- Clean separation achieved

# ============================================