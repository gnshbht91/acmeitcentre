# ============================================
# TASK: PHASE-6.7-FIX-ADMIN-DASHBOARD-SETTINGS.md
# ============================================

GOAL:
Fix incorrect admin menu mapping and implement proper ACME Dashboard + Settings system using WordPress Options API with repeater support

STEP:
Separate Dashboard and Settings pages, replace incorrect structure, and implement scalable settings system

FILES:
- wp-content/plugins/acme-core/includes/admin/menu.php
- wp-content/plugins/acme-core/includes/admin/settings-page.php (create if not exists)
- wp-content/plugins/acme-core/assets/js/admin.js (create if not exists)

EXPECTED_OUTPUT:
- Dashboard opens correctly (not settings)
- Settings page works separately
- Social links repeater works (add/remove/save)
- Data stored using get_option('acme_settings')

TASK_VALIDATION:
- Must match TASK_BOARD (PHASE 6.7)
- If mismatch → STOP

DUPLICATION_CHECK:
- If dashboard already separate → skip that part

PRECONDITION_CHECK:
- ACME menu exists → YES

STRICT_SCOPE:
- Only admin menu + settings system
- No DAL changes
- No frontend changes

CONSTRAINTS:
- Use WordPress Settings API
- No CPT for settings
- No custom DB tables
- Repeater must store as array

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

FEATURES TO IMPLEMENT:

1. ADMIN MENU FIX
   - Dashboard page (main)
   - Settings page (submenu)

2. DASHBOARD PAGE
   - simple placeholder (heading only)

3. SETTINGS PAGE
   - existing fields migrated
   - social links repeater

4. REPEATER SYSTEM
   - add new row
   - remove row
   - dynamic index handling

5. SAVE/LOAD
   - use get_option / update_option

SECURITY_HINT:
- sanitize_text_field
- esc_url for links

FAIL_CONDITIONS:
- dashboard still opens settings
- settings not saving
- repeater not working

SUCCESS_CRITERIA:
- clean admin UX
- scalable settings
- no PHP errors