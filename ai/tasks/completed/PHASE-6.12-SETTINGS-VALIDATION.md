# ============================================
# TASK: PHASE-6.12-SETTINGS-VALIDATION.md
# ============================================

GOAL:
Add validation layer to settings form to prevent invalid data and improve data integrity

STEP:
Implement field-level validation using WordPress Settings API

FILES:
- wp-content/plugins/acme-core/includes/admin/settings-page.php

EXPECTED_OUTPUT:
- invalid data blocked
- error messages shown
- valid data saved

STRICT_SCOPE:
- validation only
- no UI redesign
- no DB changes

VALIDATION RULES:

1. PHONE
   - required
   - only numbers + optional + sign

2. EMAIL
   - must be valid email format

3. WHATSAPP
   - same as phone

4. MAP LINK
   - must be valid URL

5. SOCIAL LINKS
   - URL must be valid
   - empty rows ignored

ERROR HANDLING:

- use add_settings_error()
- show via settings_errors()

FAIL_CONDITIONS:
- invalid data saved
- no error message shown

SUCCESS_CRITERIA:
- validation working
- clear errors visible