# ============================================
# TASK: PHASE-3.9_CREATE_GETTER.md
# ============================================

GOAL:
Central function create karna jo plugin settings safely return kare

STEP:
acme_get_settings() function create karna jo get_option se data fetch kare

FILES:
wp-content/plugins/acme-core/includes/admin/settings.php

INPUT:
Option name: acme_settings

EXPECTED_OUTPUT:
- Function defined ho
- Settings array return kare
- Agar data invalid ho to empty array return kare
- Koi PHP error na aaye

SECURITY_REQUIREMENTS:
- Ensure returned data is always array

DUPLICATION_CHECK:
- Agar function already exist karta hai → STOP

STRICT_SCOPE:
- Modify ONLY settings.php
- Do NOT modify other files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.9)
- If mismatch → STOP

CONSTRAINTS:
- Do NOT add caching (next phase me aayega)
- Do NOT add escaping (frontend phase me aayega)
- Do NOT expand scope

# ============================================