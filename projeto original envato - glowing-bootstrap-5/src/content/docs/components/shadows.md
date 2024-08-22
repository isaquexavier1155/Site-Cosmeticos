---
layout: docs
title: Shadows
description: Add or remove shadows to elements with box-shadow utilities.
group: utilities
toc: true
---

## Examples

While shadows on components are disabled by default in Bootstrap and can be enabled via `$enable-shadows`, you can also quickly add or remove a shadow with our `box-shadow` utility classes. Includes support for `.shadow-none` and three default sizes (which have associated variables to match).

{{< docs/example class="overflow-hidden p-8" >}}
<div class="shadow-none p-6 mb-8 bg-body-tertiary rounded">No shadow</div>
<div class="shadow-sm p-6 mb-8 bg-body-tertiary rounded">Small shadow</div>
<div class="shadow p-6 mb-8 bg-body-tertiary rounded">Regular shadow</div>
<div class="shadow-lg p-6 mb-8 bg-body-tertiary rounded">Larger shadow</div>
{{< /docs/example >}}

## Sass{.doc-toc-heading}

### Variables{.doc-toc-heading}

{{< docs/scss-docs name="box-shadow-variables" file="scss/bootstrap/_variables.scss" >}}

### Utilities API{.doc-toc-heading}

Shadow utilities are declared in our utilities API in `scss/_utilities.scss`. [Learn how to use the utilities API.](https://getbootstrap.com/docs/5.3/utilities/api/#using-the-api)

{{< docs/scss-docs name="utils-shadow" file="scss/bootstrap/_utilities.scss" >}}
