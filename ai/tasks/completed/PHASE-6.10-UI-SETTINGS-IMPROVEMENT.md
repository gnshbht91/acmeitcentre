# ============================================
# TASK: PHASE-6.10-UI-SETTINGS-IMPROVEMENT.md
# ============================================

GOAL:
Improve admin settings UI for better usability, clarity, and user experience

STEP:
Enhance form layout, add validation feedback, and improve repeater UI

FILES:
- wp-content/plugins/acme-core/includes/admin/settings-page.php
- wp-content/plugins/acme-core/assets/admin.css (create if not exists)
- wp-content/plugins/acme-core/assets/admin.js (optional)

EXPECTED_OUTPUT:
- structured UI
- better spacing
- clear labels
- improved repeater UX

STRICT_SCOPE:
- UI only
- no data logic change

CONSTRAINTS:
- WordPress admin style compatible
- lightweight CSS only

UI IMPROVEMENTS:

1. FORM STRUCTURE
   - group fields into sections:
     - Contact Info
     - Business Info
     - Social Links

2. LABEL IMPROVEMENT
   - add descriptions under fields

3. SPACING
   - proper margins between fields

4. BUTTON UI
   - styled "Add Social Link"
   - styled "Remove"

5. EMPTY STATE
   - show message if no social links

6. SUCCESS MESSAGE
   - show "Settings Saved" notice

FAIL_CONDITIONS:
- form breaks
- save stops working

SUCCESS_CRITERIA:
- clean admin UI
- better UX
- no functional break