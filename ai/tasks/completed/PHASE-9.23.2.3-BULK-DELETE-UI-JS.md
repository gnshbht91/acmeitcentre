# ============================================
# TASK: PHASE-9.23.2.3-BULK-DELETE-UI-JS.md
# ============================================

GOAL:
Add bulk delete button and JavaScript without modifying any existing code.

FILES:
- /wp-content/plugins/acme-core/acme-core.php

EDIT_LOCATION:

1. BUTTON:
   - Immediately BEFORE <table> tag

2. SCRIPT:
   - AFTER closing </table>
   - OUTSIDE any PHP function
   - OUTSIDE any loop

STRICT_SCOPE:

YOU ARE ALLOWED:
✔ Add button
✔ Add <script>

YOU ARE NOT ALLOWED:
❌ Modify any existing PHP code
❌ Modify function structure
❌ Insert JS inside PHP block
❌ Change any existing line

CONSTRAINTS:

SCRIPT MUST:
- Be outside <?php ?> blocks
- Be placed after table HTML ends

FAIL_CONDITIONS:
- JS inside PHP
- existing code changed
- broken layout

SUCCESS:
- button visible
- JS works
- no structure break