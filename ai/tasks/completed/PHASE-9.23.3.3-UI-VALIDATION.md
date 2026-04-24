# ============================================
# TASK: PHASE-9.23.3.3-UI-VALIDATION.md
# ============================================

GOAL:
Verify Bulk Status UI and functionality in real browser.

TYPE:
BROWSER VALIDATION TASK

FILES:
- NO CODE MODIFICATION ALLOWED

--------------------------------------------

STRICT RULES

YOU MUST:
✔ ONLY use browser
✔ ONLY observe + interact

YOU MUST NOT:
❌ modify any file
❌ write any code
❌ reload system files manually

--------------------------------------------

TEST ENVIRONMENT

1. Open WordPress Admin Panel
2. Navigate to CRM Page (where leads table exists)

--------------------------------------------

TEST CASE 1 — DROPDOWN VISIBILITY

STEP:

✔ Locate Bulk Delete button

✔ Check BELOW it:

<select id="acme-bulk-status">

EXPECTED:

✔ Dropdown visible
✔ Options:
   - Select Status
   - New
   - Contacted
   - Converted

FAIL IF:

❌ Dropdown missing
❌ Options incorrect

--------------------------------------------

TEST CASE 2 — BUTTON VISIBILITY

STEP:

✔ Locate button:

id="acme-bulk-status-btn"

EXPECTED:

✔ Button visible
✔ Text = "Update Status"

FAIL IF:

❌ Button missing

--------------------------------------------

TEST CASE 3 — EMPTY VALIDATION

STEP:

✔ Click "Update Status" WITHOUT selecting:

- any checkbox
- any status

EXPECTED:

✔ Alert appears:
   "Please select a status"

FAIL IF:

❌ No alert
❌ Wrong alert

--------------------------------------------

TEST CASE 4 — NO CHECKBOX SELECTED

STEP:

✔ Select status
✔ DO NOT select any row
✔ Click button

EXPECTED:

✔ Alert:
   "Select at least one lead"

--------------------------------------------

TEST CASE 5 — SUCCESS FLOW

STEP:

✔ Select 1 or more rows
✔ Select status = "contacted"
✔ Click button

EXPECTED:

✔ Confirmation popup
✔ After confirm → success alert:
   "Status updated"

✔ Checkboxes get unchecked

FAIL IF:

❌ No confirmation
❌ No success alert
❌ Checkboxes remain checked

--------------------------------------------

TEST CASE 6 — CONSOLE CHECK

STEP:

✔ Open browser console (F12)

✔ Perform action again

EXPECTED:

✔ NO red errors
✔ NO JS exceptions

FAIL IF:

❌ Any console error

--------------------------------------------

FINAL RESULT FORMAT

RETURN:

{
  dropdown: PASS / FAIL,
  button: PASS / FAIL,
  validation: PASS / FAIL,
  success_flow: PASS / FAIL,
  console: PASS / FAIL,
  overall: PASS / FAIL
}

--------------------------------------------

SUCCESS CRITERIA

ALL must be PASS

# ============================================