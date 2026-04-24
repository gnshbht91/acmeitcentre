# ============================================
# TASK: PHASE-10.9_FIX_JS_LOCALIZATION.md
# ============================================

GOAL:
Ensure acme_admin object is available in admin.js on all admin pages where the script is loaded.

STEP:
Add wp_localize_script() for admin.js in settings page enqueue function.

FILES:
wp-content/plugins/acme-core/includes/admin/settings-page.php

EXPECTED_OUTPUT:
- acme_admin object defined
- nonce available
- no JS console errors

TASK_VALIDATION:
- Must match TASK_BOARD current task (PHASE-10.9_FIX_JS_LOCALIZATION)
- If mismatch → STOP

DUPLICATION_CHECK:
- If localization already exists → STOP

PRECONDITION_CHECK:
- settings-page.php exists → YES
- admin.js enqueued → YES

STRICT_SCOPE:
- ONLY add wp_localize_script
- Do NOT refactor
- Do NOT modify other logic

CONSTRAINTS:
- Use same object name: acme_admin
- Include nonce

SECURITY_HINT:
- Nonce required? YES

FAIL_CONDITIONS:
- acme_admin undefined
- duplicate localization
- PHP error

SUCCESS_CRITERIA:
- acme_admin available globally
- no console error
- script works

# ============================================

# OUTPUT

FILES MODIFIED:
wp-content/plugins/acme-core/includes/admin/settings-page.php

CODE:
```php
    wp_enqueue_script('acme-admin-script', ACME_URL . 'assets/js/admin.js', array('jquery'), ACME_VERSION, true);
    wp_localize_script(
        'acme-admin-script',
        'acme_admin',
        array(
            'nonce' => wp_create_nonce('acme_admin_nonce')
        )
    );
}
add_action('admin_enqueue_scripts', 'acme_enqueue_admin_scripts');
```

RESULT:
SUCCESS