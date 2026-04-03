# ============================================
# TASK: PHASE-3.11_VERIFY_FRONTEND.md
# ============================================

GOAL:
Plugin settings ko frontend par safely display karke verify karna

STEP:
Theme file me acme_get_settings() call karke data display karna (with proper escaping)

FILES:
Active theme file (preferably footer.php or page template)

INPUT:
acme_get_settings() output array

EXPECTED_OUTPUT:
- Settings frontend par visible ho
- Proper escaping applied ho
- No PHP error aaye

SECURITY_REQUIREMENTS:
- esc_html() for text fields
- esc_url() for links
- No direct echo of raw data

DUPLICATION_CHECK:
- Agar already frontend usage hai → STOP

STRICT_SCOPE:
- Only temporary display code add karna
- Do NOT modify plugin files
- Do NOT create shortcode/system yet

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.11)
- If mismatch → STOP

CONSTRAINTS:
- No styling required
- No layout change required
- Only verification purpose

# ============================================