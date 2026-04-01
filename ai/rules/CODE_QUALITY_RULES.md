# ⚙️ CODE QUALITY RULES — CLEAN ENGINEERING STANDARD (FINAL V5)

SYSTEM TYPE: CODE STANDARDIZATION & SAFETY
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🎯 CODE PURPOSE LAW

EVERY CODE BLOCK MUST:

* Solve EXACT task requirement

YOU MUST NOT:

* Add unnecessary logic
* Add unused code
* Add placeholder code

---

# 🧱 SIMPLICITY LAW (CRITICAL)

YOU MUST:

* Write simplest working solution

YOU MUST NOT:

* Over-engineer
* Add abstraction without need

---

# 🧾 NAMING CONVENTION LAW

YOU MUST:

* Use clear names
* Prefix ALL functions with acme_

YOU MUST NOT:

* Use generic names

---

# 🔁 RETURN TYPE CONSISTENCY (CRITICAL)

YOU MUST:

* Maintain consistent return types

RULE:

* Data fetch → array
* Single item → object/array
* Action → boolean

YOU MUST NOT:

* Return mixed types

---

# 📥 INPUT CONTRACT LAW (CRITICAL)

EVERY FUNCTION MUST:

* Validate input

YOU MUST:

* Check required fields
* Validate types

IF INVALID:

→ RETURN SAFE FAILURE

---

# 🚫 GLOBAL STATE CONTROL

YOU MUST NOT:

* Use global variables unnecessarily

YOU MUST:

* Pass data via parameters

---

# 🧩 FUNCTION DESIGN LAW

YOU MUST:

* One function = one responsibility

LIMIT:

* Max 40–50 lines per function

YOU MUST NOT:

* Create large functions

---

# 🔁 CODE REUSE LAW

YOU MUST:

* Reuse existing functions

YOU MUST NOT:

* Duplicate logic

---

# 📦 FILE SIZE CONTROL

YOU MUST:

* Keep files modular

YOU MUST NOT:

* Create large files

---

# 🧠 READABILITY LAW

CODE MUST:

* Be readable
* Use indentation

---

# 💬 COMMENTING LAW

YOU MUST:

* Comment complex logic

YOU MUST NOT:

* Over-comment

---

# ⚠️ ERROR HANDLING LAW

YOU MUST:

* Handle errors explicitly

YOU MUST NOT:

* Fail silently

---

# 🔐 SECURITY SYNC LAW

YOU MUST:

* Follow SECURITY_RULES

---

# 🧱 STACK COMPLIANCE LAW

YOU MUST:

* Follow STACK_RULES

---

# 🔗 HOOK STANDARD LAW

YOU MUST:

* Use proper naming

FORMAT:

acme_hook_action

YOU MUST:

* Use correct priority

---

# 📁 TEMPLATE LOGIC CONTROL (CRITICAL)

YOU MUST:

* Keep logic OUT of theme templates

YOU MUST:

* Call functions from plugin

YOU MUST NOT:

* Write business logic in template

---

# 📁 FILE STRUCTURE LAW

YOU MUST:

* Place code correctly

---

# 🔄 SIDE EFFECT CONTROL

YOU MUST:

* Avoid breaking other code

---

# 🧪 TESTABILITY LAW

CODE MUST:

* Be predictable

---

# ⚙️ PERFORMANCE LAW

YOU MUST:

* Optimize loops
* Minimize DB calls

---

# 🔄 CONSISTENCY LAW

YOU MUST:

* Follow same style

---

# 🔍 CHANGE TRACEABILITY

YOU MUST:

* Write identifiable changes

YOU MUST NOT:

* Make silent changes

---

# 🧠 DEPENDENCY CONTROL

YOU MUST:

* Avoid unnecessary dependency

---

# 🛑 PARTIAL CODE BLOCK

YOU MUST:

* Complete logic fully

YOU MUST NOT:

* Leave TODO

---

# 🔁 REFACTOR CONTROL

YOU MUST NOT:

* Refactor unrelated code

---

# 📊 OUTPUT CONTROL

YOU MUST:

* Return clean code

---

# 🛑 FAILURE CONDITIONS

STOP IF:

* Code unclear
* Logic incomplete
* Security missing
* Duplicate logic
* Performance issue

---

# 🔐 FAIL-SAFE

IF ANY DOUBT:

→ STOP

---

# 🚨 FINAL LAW

YOU WRITE:

* CLEAN
* MINIMAL
* SAFE
* CONSISTENT CODE

---

# 🔚 END OF CODE QUALITY RULES
