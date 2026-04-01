GOAL:
Recreate full AI governance structure (folders + empty files only)

STACK:
WordPress (acme-core)

STEP:

Create missing folders and empty files inside /wp-content/ai/ as per ACME system.

---

CREATE (ONLY IF MISSING):

ROOT:

* wp-content/ai/ENTRYPOINT.md

DOCS:

* wp-content/ai/docs/ACME_EXECUTION_PLAN.md
* wp-content/ai/docs/ACME_SYSTEM.md
* wp-content/ai/docs/execution-prompt-temp.md
* wp-content/ai/docs/taskstyle.md

PROMPTS:

* wp-content/ai/prompts/EXECUTION_PROMPT.md

RULES:

* wp-content/ai/rules/MASTER_RULES.md
* wp-content/ai/rules/STACK_RULES.md
* wp-content/ai/rules/THEME_RULES.md
* wp-content/ai/rules/PLUGIN_RULES.md
* wp-content/ai/rules/SECURITY_RULES.md
* wp-content/ai/rules/TASK_RULES.md
* wp-content/ai/rules/CODE_QUALITY_RULES.md

SYSTEM:

* wp-content/ai/system/EXECUTION_STATE.md (ONLY if missing)

TASKS:

* wp-content/ai/tasks/active/
* wp-content/ai/tasks/completed/

---

RULES:

* DO NOT overwrite existing files
* DO NOT modify DEV_LOG.md, PROJECT_STATE.md, TASK_BOARD.md
* DO NOT add any content inside files
* CREATE ONLY missing items

---

EXPECTED OUTPUT:

* Full folder structure recreated
* All required files exist (EMPTY)
* Existing system untouched
