# ============================================
# TASK: PHASE-7.3.1-HONEYPOT-FIX.md
# ============================================

GOAL:
Improve honeypot implementation to prevent advanced bot bypass

STEP:
Replace existing honeypot field with off-screen hidden field

FILES:
- wp-content/plugins/acme-core/modules/module-form.php

INPUT:
None

EXPECTED_OUTPUT:
- Honeypot field wrapped inside off-screen container
- Field not visible to users
- Field present in DOM
- No duplicate honeypot fields
- No PHP errors

TASK_VALIDATION:
- Must follow PHASE 7.3
- If honeypot missing → STOP

DUPLICATION_CHECK:
- Only ONE honeypot field allowed
- If multiple → FAIL

PRECONDITION_CHECK:
- module-form.php exists → YES
- Honeypot field exists → YES
- If ANY missing → STOP

STRICT_SCOPE:
- Only replace honeypot field
- No new logic
- No structural change
- No JS

CONSTRAINTS:
- Must NOT use display:none
- Must be hidden via off-screen positioning
- No modification to other fields

SECURITY_HINT:
- Honeypot required? YES
- Must be bot-trappable

FAIL_CONDITIONS:
- display:none still present
- Multiple honeypots
- Wrong field name
- PHP error

SUCCESS_CRITERIA:
- Honeypot uses off-screen technique
- Field name = acme_hp_field
- Only one honeypot exists
- No errors

# ============================================