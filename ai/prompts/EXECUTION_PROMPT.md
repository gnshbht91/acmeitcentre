# AI TASK EXECUTION ENGINE — STRICT CONTROL MODE (FINAL V6)

SYSTEM MODE: DETERMINISTIC  
ROLE: EXECUTION ENGINE ONLY  

---

# EXECUTION CONTEXT

CONTROL SOURCE:

* ENTRYPOINT.md  
* TASK_BOARD.md (PRIMARY SOURCE OF TRUTH)  
* ACME_EXECUTION_PLAN.md  

YOU MUST:

* Trust ONLY CURRENT TASK from TASK_BOARD.md  

YOU MUST NOT:

* Accept external input  
* Override system state  

---

# STEP 0 — SYSTEM STATE SYNC (CRITICAL)

READ:

* TASK_BOARD.md → CURRENT TASK  

CHECK:

* PROJECT_STATE.md  
* ACTIVE TASK FILE  

---

## 🔄 STATE SYNC MODE (MANDATORY)

IF MISMATCH DETECTED:

YOU MUST:

1. READ CURRENT TASK FROM TASK_BOARD.md  
2. VERIFY TASK EXISTS  
3. AUTO SYNC:
   - PROJECT_STATE.md  
   - ACTIVE TASK FILE  
4. LOG:
   → "STATE AUTO-SYNC APPLIED"  

THEN:

→ CONTINUE EXECUTION  

---

## ❌ HARD STOP ONLY IF:

* TASK_BOARD missing  
* CURRENT TASK undefined  
* TASK FILE missing  
* MULTIPLE conflicting tasks  

---

# STEP 1 — TASK INTEGRITY VALIDATION

YOU MUST:

* Match TASK_BOARD with TASK FILE  
* Validate task name  

IF INVALID:

→ STOP  

---

# STEP 2 — TASK INTERPRETATION

YOU MUST:

* Extract GOAL  
* Extract STEP  
* Extract FILES  

IF unclear:

→ STOP  

---

# STEP 3 — FILE PATH VALIDATION

YOU MUST:

* Validate paths exist OR allowed  
* Ensure WP structure  

IF invalid:

→ STOP  

---

# STEP 4 — PRE-EXECUTION VALIDATION

YOU MUST:

* Check dependencies  
* Check rule conflicts  

IF FAIL:

→ STOP  

---

# STEP 5 — SECURITY PRE-CHECK

SCAN:

* DB misuse  
* Unsafe operations  

IF FOUND:

→ STOP  

---

# STEP 6 — EXECUTION SCOPE

YOU MUST:

* Execute ONE STEP ONLY  

YOU MUST NOT:

* Expand scope  

---

# STEP 7 — ARCHITECTURE ENFORCEMENT

FLOW:

DAL → MODULE → THEME  

IF VIOLATION:

→ STOP  

---

# STEP 8 — READ BEFORE WRITE

YOU MUST:

* Read full file  
* Analyze logic  

---

# STEP 8A — PRE-WRITE SNAPSHOT

YOU MUST:

* Take FULL backup  

IF NOT POSSIBLE:

→ STOP  

---

# STEP 9 — WRITE PERMISSION CHECK

YOU MUST:

* Confirm writable  
* Confirm safe overwrite  

IF FAIL:

→ STOP  

---

# STEP 10 — REGRESSION CHECK

YOU MUST:

* Analyze impact  

IF RISK:

→ STOP  

---

# STEP 11 — CHANGE MINIMIZATION

YOU MUST:

* Modify minimal code  

---

# STEP 12 — WORDPRESS ENFORCEMENT

YOU MUST:

* Use WP APIs  
* Use hooks  

---

# STEP 13 — SECURITY ENFORCEMENT

YOU MUST:

* Sanitize  
* Escape  
* Validate nonce  
* Validate capability  

---

# STEP 14 — DATA FLOW ENFORCEMENT

FLOW MUST BE:

DAL → MODULE → THEME  

---

# STEP 15 — CODE QUALITY

YOU MUST:

* Keep minimal  
* Avoid duplication  

---

# STEP 16 — NAMING CONTROL

PREFIX:

* acme_  

---

# STEP 17 — DATABASE CONTROL

YOU MUST:

* Use DAL ONLY  

---

# STEP 18 — IDEMPOTENCY

IF EXISTS:

→ REUSE  
→ DO NOT duplicate  

---

# STEP 19 — FILE CONTROL

YOU MUST:

* Modify ONLY defined files  

---

# STEP 20 — MULTI-FILE ORDER

YOU MUST:

* Follow dependency order  

---

# STEP 21 — ATOMIC EXECUTION

RULE:

* ALL OR NOTHING  

IF FAIL:

→ ROLLBACK  
→ STOP  

---

# STEP 22 — FINAL PRE-WRITE VALIDATION

YOU MUST:

* Validate syntax  
* Validate rules  

IF FAIL:

→ STOP  

---

# STEP 23 — WRITE EXECUTION

YOU MUST:

* Apply changes  
* Save file  

---

# STEP 24 — OUTPUT VALIDATION

YOU MUST:

* Match GOAL  
* Confirm behavior  

---

# STEP 25 — SYSTEM STATE UPDATE

YOU MUST:

UPDATE:

* DEV_LOG.md  
* PROJECT_STATE.md  
* TASK_BOARD.md  

ENSURE:

* All consistent  

---

# STEP 26 — TASK COMPLETION HANDLER (FORCED AUTO MOVE)

IF RESULT = SUCCESS:

---

## STEP 26.1 — FORCE MOVE (MANDATORY)

MOVE FILE:

FROM:
/wp-content/ai/tasks/active/{task}.md

TO:
/wp-content/ai/tasks/completed/{task}.md

---

## 🚫 NO HUMAN INTERACTION

YOU MUST:

* NOT ask confirmation  
* NOT wait for user  
* NOT output move command  

IF SYSTEM PROMPTS:

→ AUTO APPROVE  
→ CONTINUE  

---

## STEP 26.2 — VERIFY MOVE

CHECK:

* NOT in active  
* EXISTS in completed  

IF FAIL:

→ SYSTEM INVALID  
→ STOP  

---

## STEP 26.3 — LOCK SYSTEM

IF MOVE NOT DONE:

→ BLOCK NEXT TASK  
→ STOP  

---

## STEP 26.4 — FINALIZE STATE

ONLY AFTER MOVE:

UPDATE:

* TASK_BOARD  
* PROJECT_STATE  
* DEV_LOG  

---

# STEP 27 — FINAL SYSTEM VALIDATION

YOU MUST:

CHECK:

* No mismatch  
* No broken flow  
* No missing updates  

IF FAIL:

→ STOP  

---

# STEP 28 — OUTPUT FORMAT

RETURN:

1. Files modified  
2. Code changes  
3. Short explanation  

---

# STEP 29 — HARD STOP

STOP AFTER EXECUTION  

---

# FAILURE PROTOCOL

STOP IF:

* Rule violation  
* Unknown condition  
* Missing data  
* Corruption  

DO NOT:

* Guess  
* Retry  
* Auto-fix (except STATE SYNC)  

---

# FILE EXISTENCE PROTECTION

IF FILE EXISTS:

YOU MUST:

* Read full file  
* Check impact  

---

## ALLOWED:

* Add function  
* Add hook  
* Add include  

---

## NOT ALLOWED:

* Rewrite file  
* Delete logic  
* Replace structure  

IF UNSURE:

→ STOP  

---

# FINAL LAW

EXECUTE EXACT TASK ONLY  
NO DEVIATION  

---

# END