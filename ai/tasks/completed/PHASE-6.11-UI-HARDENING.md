# ============================================
# TASK: PHASE-6.11-UI-HARDENING.md
# ============================================

GOAL:
Fix UI implementation to follow WordPress standards, remove over-engineering, and ensure stable behavior

STEP:
Refactor UI to minimal, clean, WP-compatible structure

FILES:
- wp-content/plugins/acme-core/includes/admin/settings-page.php
- wp-content/plugins/acme-core/assets/admin.css
- wp-content/plugins/acme-core/assets/js/admin.js

EXPECTED_OUTPUT:
- clean UI
- WP-native look
- no global CSS impact
- stable repeater

STRICT_SCOPE:
- UI only
- REMOVE overdesign
- NO logic change

CONSTRAINTS:
- use WordPress admin styles
- minimal CSS
- no animations
- no fancy effects

FIX AREAS:

1. REMOVE OVERDESIGN
   - remove gradients
   - remove glassmorphism
   - remove heavy shadows
   - remove animations

2. CSS SCOPE FIX
   - wrap all CSS under:
     .acme-settings-page

3. USE WP CLASSES
   - form-table
   - regular-text
   - button button-primary

4. SUCCESS NOTICE FIX
   - use settings_errors()

5. JS CLEANUP
   - remove animation
   - keep only add/remove logic

6. SAFE LAYOUT
   - simple sections
   - no complex containers

FAIL_CONDITIONS:
- UI breaks
- saving breaks
- CSS affects other pages

SUCCESS_CRITERIA:
- simple clean UI
- WP standard look
- stable behavior