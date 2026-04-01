# ============================================
# TASK: SYSTEM-GIT_INITIAL_PUSH.md
# ============================================

GOAL:
Project code ko Git repository par safely push karna (with correct .gitignore)

STEP:
Project initialize karke files commit aur remote repository par push karna

FILES:
Project root directory

INPUT:
Git repository URL (provided by user)

EXPECTED_OUTPUT:
- Git initialized
- Files staged and committed
- Remote connected
- Code successfully pushed

PRECHECK_REQUIREMENTS:
- .gitignore present and correct
- Git installed
- No existing conflicting repo

DUPLICATION_CHECK:
- If repo already initialized and pushed → STOP

STRICT_SCOPE:
- Do NOT modify code files
- Do NOT modify .gitignore
- Only Git operations allowed

TASK_VALIDATION:
- Must be system-level task
- If mismatch → STOP

CONSTRAINTS:
- Use main branch
- Do NOT add unwanted files
- Respect .gitignore rules

# ============================================