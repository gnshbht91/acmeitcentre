# 🧠 PLUGIN RULES — ACME CORE ARCHITECTURE SYSTEM (FINAL V6)

SYSTEM TYPE: PLUGIN ARCHITECTURE CONTROL
ENFORCEMENT LEVEL: ABSOLUTE
AUTHORITY: BELOW MASTER_RULES.md

---

# 🔒 PLUGIN IDENTITY LOCK

PLUGIN NAME:

* acme-core

YOU MUST NOT:

* Create new plugin
* Rename plugin

ALL LOGIC MUST LIVE IN:

wp-content/plugins/acme-core/

---

# 🎯 PLUGIN RESPONSIBILITY

PLUGIN HANDLES:

* Business logic
* Data handling
* DB access (via DAL)
* AJAX / API
* Form processing

YOU MUST NOT:

* Put logic in theme

---

# 🧱 ARCHITECTURE LAYERING (CRITICAL)

LAYERS:

1. Core (boot + loader)
2. Modules (features)
3. DAL (data layer)
4. Helpers (utilities)

STRICT RULE:

* NO cross-layer violation

---

# 📁 FILE STRUCTURE LAW

acme-core/
│
├── acme-core.php
├── core/
├── modules/
├── dal/
├── helpers/

---

# ⚙️ CORE LOADER SYSTEM (CRITICAL)

acme-core.php MUST:

* Define constants
* Load core loader
* Trigger init

core/loader.php MUST:

* Load modules
* Load DAL
* Load helpers

YOU MUST NOT:

* Load modules randomly

---

# 🧩 MODULE SYSTEM (STRICT)

MODULE FILE FORMAT:

module-{name}.php

YOU MUST:

* Register module via loader

MODULE MUST:

* Register hooks
* Call DAL

YOU MUST NOT:

* Run DB queries

---

# 🔗 MODULE REGISTRATION LAW

ALL MODULES MUST BE:

* Registered in loader

FORMAT:

require_once module file

NO AUTO DISCOVERY

---

# 🗄️ DATA ACCESS LAYER (DAL) LAW

DAL STRUCTURE:

dal/
├── class-{entity}-dal.php

EXAMPLES:

* class-course-dal.php
* class-lead-dal.php

RULES:

* All DB queries here
* Use wpdb + prepare

---

# 🔗 MODULE ↔ DAL RELATION

MODULE:

→ Calls DAL

DAL:

→ Returns data

NO reverse calls

---

# 🧠 HELPER SYSTEM

helpers/

* Generic reusable logic

YOU MUST NOT:

* Put business logic

---

# 🔌 HOOK NAMESPACE LAW

ALL HOOKS MUST USE PREFIX:

acme_

EXAMPLES:

* acme_init
* acme_save_lead

YOU MUST NOT:

* Use generic hook names

---

# 🔄 MODULE DEPENDENCY LAW

YOU MUST:

* Keep modules independent

IF DEPENDENCY EXISTS:

→ Define clearly
→ Load dependency first

YOU MUST NOT:

* Create circular dependency

---

# 🌐 AJAX / API STRUCTURE

AJAX MUST:

* Be defined in module
* Use nonce
* Use permission check

---

# 📥 FORM PROCESSING FLOW

FORM:

→ Module
→ DAL

YOU MUST NOT:

* Process in theme

---

# ⚙️ ACTIVATION / VERSION CONTROL (CRITICAL)

YOU MUST:

* Use register_activation_hook()

ON ACTIVATION:

* Setup DB
* Set version

USE:

* dbDelta()

---

# 🔄 MIGRATION CONTROL

YOU MUST:

* Check DB version
* Run updates safely

---

# 🔁 DUPLICATION CONTROL

YOU MUST:

* Reuse functions

---

# 📁 FILE CONTROL

YOU MUST:

* Modify only required plugin files

---

# 🔄 SIDE EFFECT CONTROL

YOU MUST:

* Avoid breaking modules

---

# 🧪 MODULE ISOLATION

YOU MUST:

* Keep modules independent

---

# 🧱 NAMING CONVENTION

YOU MUST:

* Prefix ALL functions: acme_

FILES:

* lowercase
* hyphen-separated

---

# 🛑 PARTIAL IMPLEMENTATION BLOCK

YOU MUST:

* Complete module

---

# 🔁 REFACTOR CONTROL

YOU MUST NOT:

* Refactor unrelated modules

---

# 🔐 SECURITY ENFORCEMENT

FOLLOW:

SECURITY_RULES

---

# ⚙️ CODE QUALITY ENFORCEMENT

FOLLOW:

CODE_QUALITY_RULES

---

# 🚨 FAILURE CONDITIONS

STOP IF:

* DAL violation
* Module misplacement
* Loader violation
* Hook conflict
* Dependency loop
* Security missing

---

# 🔐 FAIL-SAFE

IF ANY DOUBT:

→ STOP

---

# 🚨 FINAL LAW

PLUGIN = SYSTEM BRAIN

STRUCTURE MUST BE:

* LAYERED
* CONTROLLED
* MODULAR
* SCALABLE

---

# 🔚 END OF PLUGIN RULES
