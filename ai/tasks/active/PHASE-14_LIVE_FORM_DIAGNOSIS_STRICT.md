# ============================================
# TASK: PHASE-14_LIVE_FORM_DIAGNOSIS_STRICT.md
# ============================================

GOAL:
Identify exact reason why form works locally but fails on live site.

# ============================================
# ENTRYPOINT VALIDATION
# ============================================

TASK_VALIDATION:
- MUST match TASK_BOARD EXACTLY
- IF mismatch → STOP

EXECUTION_STATE:
- local working ✔
- live failing ❌

# ============================================
# PRECHECK (MANDATORY)
# ============================================

VERIFY:

1. same code deployed on live → YES
2. browser cache cleared → YES
3. CDN/cache disabled → YES
4. correct URL tested → YES

IF any NO → STOP

# ============================================
# SCOPE (STRICT)
# ============================================

READ-ONLY ANALYSIS

FILES / LAYERS:

- frontend HTML
- JS load
- AJAX request
- network response

NO CODE MODIFICATION ALLOWED

# ============================================
# EXECUTION RULES
# ============================================

STRICT:

- DO NOT fix
- DO NOT modify code
- ONLY diagnose

FAIL CONDITIONS:

- assumption without proof
- skipping steps

# ============================================
# DIAGNOSTIC FLOW (LAYERED)
# ============================================

LAYER 1 — JS LOAD

CHECK:

- script loaded?
- 404 errors?

IF FAIL → STOP (ROOT CAUSE FOUND)

---

LAYER 2 — CONSOLE

CHECK:

- JS errors
- $ undefined
- ajaxurl undefined

IF FOUND → STOP

---

LAYER 3 — EVENT TRIGGER

CHECK:

form submit click triggers JS?

IF NOT → STOP

---

LAYER 4 — AJAX FIRE

CHECK:

admin-ajax.php request visible?

IF NO → STOP

---

LAYER 5 — AJAX RESPONSE

CHECK:

status:
200 / 403 / 500

IF ERROR → STOP

---

LAYER 6 — NONCE

CHECK:

nonce present & valid

IF FAIL → STOP

---

LAYER 7 — HTTPS / MIXED CONTENT

CHECK:

no blocked requests

IF BLOCKED → STOP

---

# ============================================
# OUTPUT FORMAT (MANDATORY)
# ============================================

JS_LOADED: YES/NO  
CONSOLE_ERROR: (exact message)  
EVENT_TRIGGER: YES/NO  
AJAX_SENT: YES/NO  
AJAX_STATUS: (code)  
NONCE_VALID: YES/NO  
MIXED_CONTENT: YES/NO  

ROOT_CAUSE: (single exact issue)

# ============================================
# SUCCESS CRITERIA
# ============================================

✔ exact failure layer identified  
✔ proof-based result  
✔ no assumption  

# ============================================