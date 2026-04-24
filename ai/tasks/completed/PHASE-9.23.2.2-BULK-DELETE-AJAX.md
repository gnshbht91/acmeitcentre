# ============================================
# TASK: PHASE-9.23.2.2-BULK-DELETE-AJAX.md
# ============================================

GOAL:
Delete multiple leads securely using AJAX.

STEP:
Create AJAX handler to validate input and call DAL bulk delete.

FILES:
- /wp-content/plugins/acme-core/modules/module-form.php

EDIT_LOCATION:
- Add new function at end of file
- Do NOT modify any existing code

INPUT:
- $_POST['lead_ids'] (array)
- $_POST['_wpnonce']

EXPECTED_OUTPUT:
- Valid IDs deleted
- JSON response returned

STRICT_SCOPE:
- ONLY add new function
- DO NOT edit existing functions
- DO NOT edit DAL
- DO NOT edit UI

CONSTRAINTS:

SECURITY:
- Verify nonce
- Check admin capability

VALIDATION:
- lead_ids must exist
- lead_ids must be array
- array must not be empty

SANITIZATION:
- Convert all IDs to int
- Remove IDs <= 0

LOGIC:
- If no valid IDs → return error
- Call DAL function

RESPONSE:
- success ONLY if valid IDs exist
- error otherwise

FAIL_CONDITIONS:
- Raw $_POST used
- Missing validation
- Missing security checks

SUCCESS_CRITERIA:
- Secure bulk delete works
- No invalid data processed

# ============================================