# 📋 TASK RULES — EXECUTION DISCIPLINE SYSTEM (FINAL V5)

SYSTEM TYPE: TASK EXECUTION CONTROL
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🎯 TASK DEFINITION LAW

TASK DEFINES:

* WHAT to do
* NOT how to do

EXECUTION RULES DEFINE:

* HOW to do

YOU MUST NOT:

* Mix task logic with execution logic

---

# 🧱 TASK STRUCTURE (MANDATORY)

EVERY TASK MUST CONTAIN:

* GOAL
* STEP

OPTIONAL:

* FILE PATHS
* EXPECTED OUTPUT

IF MISSING REQUIRED FIELDS:

→ STOP

---

# 🏷️ TASK IDENTIFICATION LAW (CRITICAL)

TASK FILE NAME MUST:

* Match TASK_BOARD current task

FORMAT:

PHASE-X.X-description.md

YOU MUST:

* Validate file name with TASK_BOARD

IF MISMATCH:

→ STOP

---

# 🔒 STATE LOCK RULE (CRITICAL)

IF TASK_BOARD CURRENT TASK ≠ EXECUTED TASK:

→ STOP EXECUTION
→ NO EXCEPTION

---
# 🔒 FILE OVERWRITE PROTECTION LAW (CRITICAL)

BEFORE WRITING ANY FILE:

YOU MUST:

* Check if file already exists

IF FILE EXISTS:

→ YOU MUST NOT:
    - Recreate file
    - Overwrite file
    - Replace full content

→ YOU MUST:
    - Modify only required part
    - Preserve existing structure

IF FILE IS CORE SYSTEM FILE (e.g. loader.php, main plugin file):

→ FULL FILE OVERWRITE = STRICTLY FORBIDDEN

IF OVERWRITE RISK DETECTED:

→ STOP EXECUTION
→ REPORT

VIOLATION = CRITICAL FAILURE

# 📋 TASK AUTHORITY (CRITICAL)

SOURCE OF TRUTH:

* TASK_BOARD.md

YOU MUST:

* Execute ONLY task defined in TASK_BOARD

YOU MUST NOT:

* Execute random task
* Execute future task
* Execute completed task

IF MISMATCH:

→ STOP

---

# 🔢 TASK ORDER LAW (CRITICAL)

YOU MUST:

* Follow ACME_EXECUTION_PLAN sequence

YOU MUST NOT:

* Skip tasks
* Jump phases
* Reorder execution

IF ORDER BROKEN:

→ STOP

---

# 📂 ACTIVE TASK CONTROL (CRITICAL)

INSIDE:

/tasks/active/

YOU MUST:

* Have EXACTLY ONE task file

YOU MUST NOT:

* Allow multiple files
* Allow zero files

IF COUNT ≠ 1:

→ STOP

---

# 🔗 TASK DEPENDENCY LAW

YOU MUST:

* Ensure previous task completed

CHECK:

* Required files exist
* Required logic exists

IF DEPENDENCY MISSING:

→ STOP

---

# 🔁 DUPLICATE EXECUTION BLOCK

CHECK:

/tasks/completed/

YOU MUST NOT:

* Re-execute completed task
* Recreate existing output

IF FOUND:

→ STOP

---

# 🧾 TASK VALIDATION LAW

BEFORE EXECUTION:

YOU MUST:

* Read full task
* Confirm clarity

YOU MUST NOT:

* Execute vague instruction
* Assume missing detail

IF UNCLEAR:

→ STOP


---

# TASK FILE STRUCTURE (MANDATORY)

EVERY TASK MUST INCLUDE:

* GOAL
* STEP
* FILE PATHS (MANDATORY)

IF FILE PATHS MISSING:

→ STOP


# 📁 FILE PATH VALIDATION (CRITICAL)

YOU MUST:

* Validate each file path in task

CHECK:

* Path exists OR allowed to create
* Path belongs to WordPress structure

YOU MUST NOT:

* Create files in unknown locations

IF INVALID PATH:

→ STOP

---

# 📁 FILE CONTROL LAW (CRITICAL)

YOU MUST:

* Modify ONLY files defined in task

YOU MUST NOT:

* Modify unrelated files
* Create extra files
* Rename files
* Move files

IF FILE NOT SPECIFIED:

→ STOP

---

# 🧠 SCOPE CONTROL LAW

YOU MUST:

* Execute EXACT instruction

YOU MUST NOT:

* Add extra logic
* Add improvements
* Expand feature

---

# 🧩 EXISTING CODE CHECK (CRITICAL)

BEFORE WRITING CODE:

YOU MUST:

* Check if logic already exists

YOU MUST NOT:

* Duplicate logic
* Recreate functions

IF EXISTS:

→ REUSE
→ DO NOT REWRITE

---

# ⚠️ SIDE EFFECT CONTROL (CRITICAL)

YOU MUST:

* Analyze impact of change

YOU MUST NOT:

* Break dependent code
* Affect unrelated modules

IF SIDE EFFECT RISK:

→ STOP

---

# 🛑 PARTIAL EXECUTION BLOCK (CRITICAL)

YOU MUST:

* Complete FULL task step

YOU MUST NOT:

* Leave half implementation

IF TASK FAILS MIDWAY:

→ ABORT
→ DO NOT SAVE PARTIAL STATE

---

# 🔐 RULE COMPLIANCE CHECK

YOU MUST:

* Validate against ALL rule files

CHECK:

* MASTER_RULES
* STACK_RULES
* SECURITY_RULES

IF ANY VIOLATION:

→ STOP

---

# ⚙️ CHANGE MINIMIZATION LAW

YOU MUST:

* Modify minimum required code

YOU MUST NOT:

* Rewrite entire file
* Refactor unrelated code

---

# 🔁 RE-RUN PROTECTION

YOU MUST:

* Check existing output

YOU MUST NOT:

* Create duplicate output

IF EXISTS:

→ STOP

---

# 📊 OUTPUT CONTROL LAW

YOU MUST RETURN:

1. Files created / modified
2. Code
3. Short explanation

YOU MUST NOT:

* Add suggestions
* Add extra commentary

---

# 🧾 EXPECTED OUTPUT MATCH

IF TASK DEFINES OUTPUT:

→ MATCH EXACTLY

YOU MUST NOT:

* Deliver partial output
* Change format

---

# 🛑 EXECUTION FAILURE CONDITIONS

STOP IF:

* Task unclear
* Task incomplete
* Dependency missing
* Rule conflict
* Duplicate logic
* File mismatch
* Security violation
* Side effect risk

---

# 🔐 FAIL-SAFE EXECUTION

DEFAULT:

→ DO NOT EXECUTE

IF ANY DOUBT:

→ STOP

---

# 🚨 FINAL EXECUTION LAW

YOU ARE:

* STRICT
* CONTROLLED
* STEP-BASED

YOU EXECUTE:

* ONE TASK
* ONE STEP

NOTHING MORE

---
SYSTEM TASK EXCEPTION

Allowed format:

SYSTEM-*.md

These tasks:

- Do not follow phase order
- Must be READ ONLY
- Must not modify system

If SYSTEM task:

→ Skip phase validation

# 🔚 END OF TASK RULES
