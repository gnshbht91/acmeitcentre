# 📋 TASK RULES — EXECUTION CONTROL SYSTEM (FINAL V6)

SYSTEM TYPE: TASK GOVERNANCE LAYER  
CONTROL LEVEL: HIGH  
DEPENDENCY: MASTER_RULES.md  

---

# 🎯 PURPOSE

Defines:

* Task lifecycle control  
* Task validation rules  
* Execution boundaries  
* State management  

---

# 🧠 TASK SOURCE OF TRUTH

PRIMARY:

* TASK_BOARD.md  

SECONDARY:

* PROJECT_STATE.md (mirror only)

YOU MUST:

* Trust ONLY TASK_BOARD.md  

YOU MUST NOT:

* Infer from PROJECT_STATE  
* Infer from filesystem  
* Execute undefined task  

---

# 📌 TASK STRUCTURE REQUIREMENT

EVERY TASK MUST CONTAIN:

* GOAL  
* STEP  
* FILES  
* EXPECTED_OUTPUT  
* TASK_VALIDATION  
* DUPLICATION_CHECK  
* PRECONDITION_CHECK  
* STRICT_SCOPE  
* CONSTRAINTS  
* SUCCESS_CRITERIA  

IF ANY MISSING:

→ STOP  

---

# 🔍 TASK VALIDATION LAW

BEFORE EXECUTION:

YOU MUST VERIFY:

1. Task exists in `/tasks/active/`  
2. Matches TASK_BOARD  
3. Valid structure  
4. Not duplicate  

IF FAIL:

→ STOP  

---

# 🧱 TASK EXECUTION LAW

YOU MUST:

* Execute ONLY CURRENT TASK  
* Follow STEP strictly  
* Respect STRICT_SCOPE  

YOU MUST NOT:

* Expand scope  
* Modify outside FILES  
* Add extra logic  

---

# 🔄 TASK STATE CONTROL

TASK STATES:

1. ACTIVE  
2. COMPLETED  

---

# 📁 TASK DIRECTORY RULE

ACTIVE:
/wp-content/ai/tasks/active/

COMPLETED:
/wp-content/ai/tasks/completed/

---

# 🔁 TASK LIFECYCLE LAW (FORCED AUTOMATION)

ON TASK SUCCESS:

---

## STEP 1 — FORCE AUTO MOVE (MANDATORY)

MOVE FILE:

FROM:
/wp-content/ai/tasks/active/{task}.md

TO:
/wp-content/ai/tasks/completed/{task}.md

---

## 🚫 NO HUMAN INTERACTION

YOU MUST:

* NOT ask confirmation  
* NOT output move command  
* NOT wait for approval  

IF SYSTEM PROMPTS:

→ AUTO APPROVE  
→ CONTINUE  

---

## STEP 2 — VERIFY MOVE

CHECK:

* File NOT in active  
* File EXISTS in completed  

IF FAIL:

→ SYSTEM INVALID  
→ STOP  

---

## STEP 3 — LIFECYCLE LOCK

IF FILE STILL IN ACTIVE:

→ TASK NOT COMPLETE  
→ BLOCK NEXT TASK  

---

## STEP 4 — UPDATE SYSTEM FILES

UPDATE:

1. TASK_BOARD.md  
   * Mark completed  
   * Set NEXT TASK  

2. PROJECT_STATE.md  
   * Update CURRENT TASK  
   * Add completed entry  

3. DEV_LOG.md  
   * Log execution  
   * Include files  

---

## STEP 5 — STATE CONSISTENCY CHECK

VERIFY:

* TASK_BOARD == PROJECT_STATE  

IF MISMATCH:

→ TRIGGER STATE SYNC MODE  

---

# ❌ TASK FAILURE LAW

IF TASK FAILS:

YOU MUST:

* STOP  
* DO NOT modify system  
* DO NOT move file  

---

# 🔁 DUPLICATION CONTROL

YOU MUST:

* Check completed tasks  

IF EXISTS:

→ STOP  

---

# 🧩 TASK DEPENDENCY CONTROL

YOU MUST:

* Follow order  

YOU MUST NOT:

* Skip tasks  

IF dependency missing:

→ STOP  

---

# 🔐 STRICT SCOPE ENFORCEMENT

YOU MUST:

* Follow STRICT_SCOPE  

YOU MUST NOT:

* Refactor  
* Improve  
* Change architecture  

IF VIOLATION:

→ STOP  

---

# 🧠 TASK FILE IMMUTABILITY

YOU MUST NOT:

* Modify task file  

EXCEPTION:

* State sync metadata  

---

# 📊 TASK BOARD CONTROL LAW

TASK_BOARD MUST:

* Define CURRENT TASK  
* Maintain order  
* Mark completion  

---

# 🔄 STATE SYNC COMPATIBILITY

IF MISMATCH:

YOU MUST:

1. Read TASK_BOARD  
2. Sync PROJECT_STATE  
3. Sync ACTIVE TASK  

YOU MUST NOT:

* Hard stop immediately  

STOP ONLY IF:

* TASK_BOARD invalid  
* Task missing  
* Conflict exists  

---

# 🛑 INVALID TASK CONDITIONS

STOP IF:

* Missing fields  
* Invalid path  
* Scope unclear  
* Duplicate  
* Already completed  

---

# 🧠 BEHAVIOR RULES

YOU MUST:

* Be deterministic  
* Be strict  

YOU MUST NOT:

* Think beyond task  
* Optimize  
* Improve  

---

# 🚨 CRITICAL SAFETY RULE

IF TASK RISKS:

* Stability  
* Security  
* Data  

→ STOP  

---

# 📌 FINAL TASK LAW

TASK = ABSOLUTE EXECUTION UNIT  

EXECUTE:

* EXACTLY  
* FULLY  
* ONCE  

---

# 🔒 COMPLETION DEFINITION (NEW — CRITICAL)

TASK IS COMPLETE ONLY IF:

✔ Code executed  
✔ Files updated  
✔ Task file moved to completed  

IF ANY MISSING:

→ TASK INCOMPLETE  
→ BLOCK SYSTEM  

---

# 🔚 END OF TASK RULES