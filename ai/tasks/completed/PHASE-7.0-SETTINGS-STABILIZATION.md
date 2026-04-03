# ============================================
# TASK: PHASE-7.0-SETTINGS-STABILIZATION.md
# ============================================

GOAL:
Stabilize ACME settings system by fixing data structure, ensuring backward compatibility, and hardening repeater + sanitization without breaking existing data

STEP:
Implement safe migration, fallback logic, and validation for settings system

FILES:
- wp-content/plugins/acme-core/includes/admin/settings-page.php
- wp-content/plugins/acme-core/includes/admin/settings.php (if exists)

EXPECTED_OUTPUT:
- Old settings still visible
- New settings structure working
- No data loss
- Social links repeater stable

TASK_VALIDATION:
- Must match TASK_BOARD (PHASE 7.0)
- If mismatch → STOP

DUPLICATION_CHECK:
- If stabilization already done → STOP

PRECONDITION_CHECK:
- Settings system implemented → YES

STRICT_SCOPE:
- Only settings system stabilization
- No menu changes
- No DAL changes
- No frontend work

CONSTRAINTS:
- Must support old + new data
- Must not overwrite existing options
- Use WordPress standards only

DATA_STRUCTURE:

OPTION NAME:
acme_settings

STRUCTURE:
[
  phone,
  email,
  address,
  whatsapp,
  business_name,
  business_hours,
  map_link,
  social_links => [
    { type: "", url: "" }
  ]
]

FIX AREAS:

1. BACKWARD COMPATIBILITY
   - fallback to old get_option keys

2. SAFE MIGRATION
   - convert old options → new array (one-time)

3. SANITIZATION
   - sanitize_text_field
   - sanitize_email
   - esc_url_raw

4. REPEATER HARDENING
   - remove empty entries
   - validate structure
   - fix indexing

5. SAFE OUTPUT
   - prevent undefined index errors

FAIL_CONDITIONS:
- data loss
- settings reset
- PHP warnings/errors

SUCCESS_CRITERIA:
- stable settings system
- no data loss
- clean saving behavior