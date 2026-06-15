---
name: project-skill-template
description: Template for defining project-specific Cursor skills. Use when creating or refining repeatable agent workflows for this repository.
---

# Project Skill Template

Use this template to define a new Cursor skill for this project.

## Project Rule

- Before committing, always run `npm run prod`.
- Use a desktop-first styling approach by default.
- Keep code clean, simple, and readable.
- Reuse patterns by creating shared components (for example buttons, cards, and layout wrappers) when repetition appears.
- This project is initially built from design references (screenshots and/or MCP tool output), so implementations should closely map to provided visuals while remaining maintainable.
- Templates should be ACF-driven where content is dynamic. Use ACF placeholders/functions in template files instead of hardcoded content where appropriate.
- Prefer reusable ACF field naming conventions and predictable group structure across templates.
- For WordPress-related tasks, always include short handoff steps for non-technical users:
  - If a new page template is created, explain how to assign/enable it in WordPress.
  - If blog-related functionality/templates are created, explain how to enable and use them in WordPress admin.
- When a task includes creating WordPress content (pages/posts), create it directly via WP-CLI whenever technically possible.
- If direct creation is not possible in the current environment, always provide short, clear wp-admin steps for a non-technical teammate.
- If a new dynamic placeholder/field is added in a template, also add/populate the matching value on the created or updated WordPress page/post in the same task.

## Template

Copy this block and replace placeholders:

```markdown
---
name: <skill-name-lowercase-hyphenated>
description: <what this skill does and when to use it>
---

# <Readable Skill Title>

## Purpose
<What problem this skill solves.>

## When to Use
- <Trigger phrase or scenario 1>
- <Trigger phrase or scenario 2>

## Inputs
- <Required input 1>
- <Optional input 2>

## Workflow
1. <Step 1>
2. <Step 2>
3. <Step 3>

## Output Requirements
- <Formatting requirement>
- <Quality requirement>

## Constraints
- <Do not do X>
- <Always do Y>
- Before committing, always run `npm run prod`.
```

## Next Step

Tell me the first skill you want, and I will create it as its own folder under `.cursor/skills/`.
