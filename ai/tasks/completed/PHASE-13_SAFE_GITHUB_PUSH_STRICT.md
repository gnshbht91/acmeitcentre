# ============================================
# TASK: PHASE-13_SAFE_GITHUB_PUSH_STRICT.md
# ============================================

GOAL:
Safely push stable ACME Core plugin to GitHub with strict validation and zero-risk deployment.

# ============================================
# ENTRYPOINT VALIDATION
# ============================================

TASK_VALIDATION:
- MUST match TASK_BOARD EXACTLY
- IF mismatch → STOP

EXECUTION_STATE:
- form working ✔
- delete working ✔
- system stable ✔

# ============================================
# PRECHECK (MANDATORY)
# ============================================

VERIFY:

1. Form submission working → YES
2. Delete working → YES
3. No console errors → YES
4. No PHP errors → YES

IF any NO → STOP

---

VERIFY REPO:

1. git initialized → YES
2. remote origin exists → YES
3. branch identified → YES

IF any NO → STOP

# ============================================
# ROOT RISK IDENTIFICATION
# ============================================

RISKS:

- debug code push ❌
- test files push ❌
- wrong branch push ❌
- unintended file push ❌

# ============================================
# SCOPE (STRICT)
# ============================================

INCLUDE ONLY:

wp-content/plugins/acme-core/*

EXCLUDE STRICT:

- wp-content/debug.log ❌
- test-* ❌
- *.log ❌
- .env ❌
- node_modules ❌
- temp files ❌

# ============================================
# EXECUTION RULES
# ============================================

STRICT:

- NO blind commit
- NO full repo add
- NO push without diff check

FAIL CONDITIONS:

- unexpected files staged
- repo dirty
- diff mismatch

# ============================================
# TASK STEPS
# ============================================

STEP 1 — CLEAN CODEBASE

REMOVE:

- error_log
- debug code
- test files

VERIFY:
no unwanted files

---

STEP 2 — VERIFY BUILD

TEST:

- form submit
- delete

IF FAIL → STOP

---

STEP 3 — CHECK REPO STATUS

RUN:

git status

VERIFY:
only expected files changed

IF unexpected → STOP

---

STEP 4 — DIFF CHECK

RUN:

git diff

VERIFY:
only intended changes

IF mismatch → STOP

---

STEP 5 — STAGE FILES

RUN:

git add wp-content/plugins/acme-core

---

STEP 6 — VERIFY STAGING

RUN:

git status

VERIFY:
only plugin files staged

IF mismatch → STOP

---

STEP 7 — FINAL DIFF CHECK

RUN:

git diff --cached

VERIFY:
no debug/test code

IF found → STOP

---

STEP 8 — COMMIT

git commit -m "FINAL: CRM system stable (form + delete fixed)"

---

STEP 9 — PUSH

git push origin main

IF error → STOP

---

# ============================================
# POST VALIDATION
# ============================================

VERIFY:

- commit visible on GitHub
- correct files pushed
- no unwanted files

---

# ============================================
# ROLLBACK PLAN
# ============================================

IF issue:

git reset --hard HEAD~1

# ============================================
# SUCCESS CRITERIA
# ============================================

✔ clean repo
✔ correct files only
✔ stable system
✔ safe deployment

# ============================================