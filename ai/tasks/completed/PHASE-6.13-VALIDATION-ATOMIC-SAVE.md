# ============================================
# TASK: PHASE-6.13-VALIDATION-ATOMIC-SAVE.md
# ============================================

GOAL:
Prevent partial data saving by enforcing atomic validation (all fields must be valid to save)

STEP:
Modify sanitize function to block entire save if any validation error occurs

FILES:
- wp-content/plugins/acme-core/includes/admin/settings-page.php

EXPECTED_OUTPUT:
- if any field invalid → nothing saved
- if all valid → full save

STRICT_SCOPE:
- validation logic only
- no UI change

CONSTRAINTS:
- must use WordPress error system
- must not break existing validation

FIX LOGIC:

1. TRACK ERROR STATE
   - use $has_error = false

2. ON ANY VALIDATION FAIL
   - set $has_error = true
   - add_settings_error()

3. AFTER ALL VALIDATION

IF $has_error === true:

→ return OLD SETTINGS

ELSE:

→ return sanitized new data

IMPORTANT:
- use get_option('acme_settings') for fallback

FAIL_CONDITIONS:
- partial save still happens
- valid data not saving

SUCCESS_CRITERIA:
- atomic save working