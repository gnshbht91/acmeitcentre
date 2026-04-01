# ============================================
# TASK: PHASE-3.3_BUILD_SETTINGS_UI.md
# ============================================

GOAL:
Admin panel me "Acme Settings" page par basic UI structure render ho (empty form layout visible ho)

STEP:
Settings page ke liye basic HTML form UI render karna (no save logic)

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php (create if not exists)

CONTEXT:
Rendered via existing admin menu callback (DO NOT create new menu)

INPUT:
None

UI_REQUIREMENTS:
- Use <div class="wrap">
- Use <h1> for page title
- Use <form method="post">
- No input fields yet

EXPECTED_OUTPUT:
- Admin me "Acme Settings" page open hone par form UI visible ho
- Page me heading + empty form structure ho
- Koi PHP error na aaye

DUPLICATION_CHECK:
- If UI already exists → STOP

STRICT_SCOPE:
- Modify ONLY this file
- Do NOT modify headers, TASK_BOARD, or other system files

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE 3.3)
- If mismatch → STOP

CONSTRAINTS:
- Follow WordPress rules
- Do NOT add save functionality
- Do NOT add validation
- Do NOT add nonce
- Do NOT modify other files
- Do NOT expand scope

# ============================================