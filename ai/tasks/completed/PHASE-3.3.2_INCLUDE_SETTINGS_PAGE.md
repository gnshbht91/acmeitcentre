# ============================================
# TASK: PHASE-3.3.2_INCLUDE_SETTINGS_PAGE.md
# ============================================

GOAL:
settings-page.php file ko properly load karna taaki acme_render_settings_page() available ho

STEP:
Plugin loader me settings-page.php ko include karna

FILES:
wp-content/plugins/acme-core/acme-core.php

INPUT:
None

EXPECTED_OUTPUT:
- acme_render_settings_page() function available ho
- Fatal error resolve ho jaye
- Settings page properly load ho

TASK_VALIDATION:
- Must match current system state (post callback fix)
- If mismatch → STOP

STRICT_SCOPE:
- Modify ONLY acme-core.php
- Do NOT modify other files
- Do NOT change existing includes

CONSTRAINTS:
- Follow WordPress plugin structure
- Use require_once
- Do NOT duplicate includes
- Do NOT expand scope

# ============================================