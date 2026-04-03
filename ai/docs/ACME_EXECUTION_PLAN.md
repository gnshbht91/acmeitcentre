# 🚀 ACME EXECUTION PLAN (GOVERNANCE SYNCED — FINAL V3)

SYSTEM TYPE: STRICT PHASE-BASED EXECUTION
CONTROL: TASK_BOARD DRIVEN
EXECUTION: ONE TASK ONLY

---

# 🔒 CORE EXECUTION RULES

* Each task = ONE STEP only
* Each task = Separate file
* Do NOT combine steps
* Do NOT skip sequence
* Follow TASK_BOARD.md as source of truth

---

# 🧭 SYSTEM STATE

CURRENT PHASE: 5
CURRENT TASK: 5.4 Get batches
LAST COMPLETED: 5.3 Get course

---

# 📋 TASK NAMING FORMAT (MANDATORY)

ALL TASK FILES MUST FOLLOW:

PHASE-{X.X}-{TASK-NAME}.md

EXAMPLE:

PHASE-3.5-ADD-WHATSAPP-SETTINGS.md

---

# 🔗 DEPENDENCY LAW

BEFORE EXECUTION:

* Previous task MUST be completed
* Required files MUST exist
* Required system MUST be initialized

IF ANY MISSING:

→ STOP

---

# 🔐 SYSTEM ENFORCEMENT LINK

ALL TASKS MUST FOLLOW:

* STACK_RULES.md
* SECURITY_RULES.md
* PLUGIN_RULES.md
* THEME_RULES.md
* TASK_RULES.md
* CODE_QUALITY_RULES.md

---

# 🧱 PHASE STRUCTURE

---

## PHASE 1 — FOUNDATION

1.1 Create plugin folder
1.2 Create plugin file
1.3 Add plugin header
1.4 Define constants
1.5 Create folder structure
1.6 Load core files
1.7 Create theme
1.8 Create theme files
1.9 Enqueue styles
1.10 Verify setup

---

## PHASE 2 — CONTENT SYSTEM

2.1 Register course CPT
2.2 Register instructor CPT
2.3 Register FAQ CPT
2.4 Register testimonial CPT
2.5 Register batch CPT
2.6 Add course fields
2.7 Add instructor fields
2.8 Add FAQ fields
2.9 Add testimonial fields
2.10 Add batch fields
2.11 Link batch to course
2.12 Link instructor to course
2.13 Verify admin

---

## PHASE 3 — SETTINGS SYSTEM

3.1 Create settings option
3.2 Create admin menu
3.3 Create settings UI
3.4 Add contact fields
3.5 Add WhatsApp settings ← CURRENT
3.6 Add social fields
3.6.1 HARDEN_SAVE_LOGIC
3.6.2 STRICT_INPUT_CHECK
3.6.3 SYSTEM-GIT_INITIAL_PUSH
3.7 Add business fields (with Google Map link)
3.8 Save settings (extend existing)
3.9 Create getter
3.10 Add caching
3.11 Verify frontend
3.11.1 Verify frontend (final QA)
3.11.1.1 FIX_SETTINGS_VALUE_BINDING

## TASK → FILE MAPPING (EXECUTION CONTROL)

PHASE-3.1 → includes/admin/settings.php
PHASE-3.2 → includes/admin/menu.php
PHASE-3.3 → includes/admin/settings.php
PHASE-3.4 → includes/admin/settings.php

PHASE-3.5 → includes/admin/settings.php
PHASE-3.6 → includes/admin/settings.php
PHASE-3.7 → includes/admin/settings.php
PHASE-3.8 → includes/admin/settings.php
PHASE-3.9 → includes/admin/settings.php
PHASE-3.10 → includes/admin/settings.php
PHASE-3.11 → theme files (frontend)

---

RULE:

Agent MUST modify ONLY mapped files
NO EXTRA FILE ACCESS


---

## PHASE 4 — DATABASE

4.1 Create leads table
4.2 Create logs table
4.3 Create audit table
4.4 Setup dbDelta
4.4.1 VERIFY_DB_TABLES
4.5 Activation hook
4.6 Store DB version
4.7 Migration check
4.8 Verify tables
5.6.2_FIX_INSERT_VALIDATION.md
---

## PHASE 5 — DATA ACCESS LAYER (DAL)

5.1 Create DAL class
5.2 Get courses
5.3 Get course
5.4 Get batches
5.5 Get leads
5.6 Wrapper functions
5.6.0 CREATE_HELPERS_FOLDER
5.7 Remove theme queries
5.8 Migration check
5.9 Verify

---

## PHASE 6 — COURSE ENGINE

6.1 Define structure
6.1.1 LOAD-CORE-LOADER
6.1.3 REMOVE LOADER CONDITION
6.2 Batch query
6.3 Instructor link
6.4 Optimize queries
6.5 Add caching
6.6 Invalidate cache
6.7 Verify
6.8 GIT-CHECKPOINT
6.9 FIX-ADMIN-MENU-ORDER
6.10 UI-SETTINGS-IMPROVEMENT
6.11 UI-HARDENING
6.12 SETTINGS-VALIDATION
6.13 VALIDATION-ATOMIC-SAVE
6.14 GIT-CHECKPOINT
---

## PHASE 7 — FORM SYSTEM

7.1 Create form
7.2 Add nonce
7.3 Add honeypot
7.4 AJAX handler
7.5 Validate input
7.6 Sanitize input
7.7 Rate limit
7.8 Insert DB
7.9 Transaction
7.10 JSON response
7.11 JS
7.12 Verify

---

## PHASE 8 — LEADS

8.1 Insert lead
8.2 Capture URL
8.3 Capture UTM
8.4 Capture IP
8.5 Duplicate check
8.6 Parent lead
8.7 Status
8.8 Cleanup cron
8.9 GDPR export
8.10 GDPR erase
8.11 Verify

---

## PHASE 9 — CRM

9.1 Menu
9.2 Table
9.3 Pagination
9.4 Filters
9.5 Status update
9.6 Notes
9.7 Assign
9.8 Manual assign
9.9 Auto assign
9.10 Restrict view
9.11 Verify

---

## PHASE 10 — AUDIT

10.1 Audit log
10.2 Track changes
10.3 Track status
10.4 Track settings
10.5 UI
10.6 Link request
10.7 Verify

---

## PHASE 11 — BACKUP

11.1 Export CSV
11.2 Button
11.3 Filters
11.4 Backup system
11.5 Cron backup
11.6 Store files
11.7 Manual backup
11.8 Verify
11.9 Verify export
11.10 Verify analytics

---

## PHASE 12 — FRONTEND

12.1 Header
12.2 Footer
12.3 Homepage
12.4 Course archive
12.5 Single course
12.6 Contact
12.7 Forms
12.8 CTA
12.9 Responsive
12.10 Verify

---

## PHASE 13 — EMAIL

13.1 Template
13.2 Send function
13.3 Admin email
13.4 User email
13.5 Retry
13.6 Logging
13.7 Verify

---

## PHASE 14 — SEO

14.1 Schema
14.2 FAQ schema
14.3 Breadcrumb
14.4 Images
14.5 Lazy load
14.6 Optimize
14.7 Speed
14.8 Verify

---

## PHASE 15 — FINAL

15.1 Form test
15.2 Edge cases
15.3 Rate limit
15.4 Duplicate
15.5 Roles
15.6 Backup
15.7 Export
15.8 Cache
15.9 Security audit
15.10 Production

---

# 🧠 EXECUTION HARDENING RULES

---

## ✅ TASK COMPLETION DEFINITION

A TASK IS COMPLETE ONLY IF:

* Required files created / modified
* No rule violation
* Output matches expected behavior
* No error occurs

IF ANY CONDITION FAILS:

→ TASK NOT COMPLETE

---

## 📊 OUTPUT STANDARD

EVERY TASK MUST PRODUCE:

1. Files created / modified
2. Functional result
3. No error

YOU MUST NOT:

* Return partial output

---

## 🧩 TASK TYPE CLASSIFICATION

TASK TYPES:

* SETUP → structure creation
* DATA → DB / DAL
* LOGIC → processing
* UI → theme rendering

YOU MUST:

* Follow correct execution approach

---

## 🔁 SAFE RE-RUN RULE

IF TASK FAILED:

* DO NOT re-run blindly
* VERIFY system state first

---

## 🔐 CRITICAL TASK ZONE

HIGH-RISK TASKS:

* Database
* Settings
* Migration

YOU MUST:

* Execute carefully
* Avoid partial execution

---

## 🔍 PHASE COMPLETION VALIDATION

AFTER EACH PHASE:

YOU MUST:

* Verify system stability
* Confirm no broken feature

IF FAILURE:

→ STOP NEXT PHASE

---

# 🛑 FAILURE CONDITIONS

STOP IF:

* Task out of order
* Dependency missing
* Rule violation
* System mismatch

---

# 🔚 END OF PLAN
