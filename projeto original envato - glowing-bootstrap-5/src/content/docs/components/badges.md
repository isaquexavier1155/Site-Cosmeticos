---
layout: docs
title: Badges
description: Documentation and examples for badges, our small count and labeling component.
group: components
toc: true
---

## Examples{.doc-toc-heading}

Badges scale to match the size of the immediate parent element by using relative font sizing and `em` units. As of v5, badges no longer have focus or hover styles for links.

### Headings{.doc-toc-heading}

{{< docs/example >}}
<h1>Example heading <span class="badge bg-secondary">New</span></h1>
<h2>Example heading <span class="badge bg-secondary">New</span></h2>
<h3>Example heading <span class="badge bg-secondary">New</span></h3>
<h4>Example heading <span class="badge bg-secondary">New</span></h4>
<h5>Example heading <span class="badge bg-secondary">New</span></h5>
<h6>Example heading <span class="badge bg-secondary">New</span></h6>
{{< /docs/example >}}

### Buttons{.doc-toc-heading}

Badges can be used as part of links or buttons to provide a counter.

{{< docs/example >}}
<button type="button" class="btn btn-primary">
  Notifications <span class="badge text-bg-light ms-4">4</span>
</button>
{{< /docs/example >}}

Note that depending on how they are used, badges may be confusing for users of screen readers and similar assistive technologies. While the styling of badges provides a visual cue as to their purpose, these users will simply be presented with the content of the badge. Depending on the specific situation, these badges may seem like random additional words or numbers at the end of a sentence, link, or button.

Unless the context is clear (as with the "Notifications" example, where it is understood that the "4" is the number of notifications), consider including additional context with a visually hidden piece of additional text.

### Positioned{.doc-toc-heading}

Use utilities to modify a `.badge` and position it in the corner of a link or button.

{{< docs/example >}}
<button type="button" class="btn btn-primary position-relative">
  Inbox
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    99+
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
{{< /docs/example >}}

You can also replace the `.badge` class with a few more utilities without a count for a more generic indicator.

{{< docs/example >}}
<button type="button" class="btn btn-primary position-relative">
  Profile
  <span class="position-absolute top-0 start-100 translate-middle p-4 bg-danger border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span>
</button>
{{< /docs/example >}}

## Background colors{.doc-toc-heading}

{{< docs/added-in "5.2.0" >}}

Set a `background-color` with contrasting foreground `color` with [our `.text-bg-{color}` helpers](https://getbootstrap.com/docs/5.3/helpers/color-background/). Previously it was required to manually pair your choice of [`.text-{color}`](https://getbootstrap.com/docs/5.3/utilities/colors/) and [`.bg-{color}`]({{< docs/ref "/components/background" >}}) utilities for styling, which you still may use if you prefer.


{{< docs/example >}}
{{< badge.inline >}}
{{- range (index $.Site.Data "doc_theme_color") }}
<span class="badge text-bg-{{ .name }}">{{ .name | title }}</span>{{- end -}}
{{< /badge.inline >}}
{{< /docs/example >}}

{{< docs/callout info >}}
{{< docs/partial "docs/callouts/warning-color-assistive-technologies.md" >}}
{{< /docs/callout >}}

## Pill badges{.doc-toc-heading}

Use the `.rounded-pill` utility class to make badges more rounded with a larger `border-radius`.

{{< docs/example >}}
{{< badge.inline >}}
{{- range (index $.Site.Data "doc_theme_color") }}
<span class="badge rounded-pill text-bg-{{ .name }}">{{ .name | title }}</span>{{- end -}}
{{< /badge.inline >}}
{{< /docs/example >}}

## CSS{.doc-toc-heading}

### Variables{.doc-toc-heading}

{{< docs/added-in "5.2.0" >}}

As part of Bootstrap's evolving CSS variables approach, badges now use local CSS variables on `.badge` for enhanced real-time customization. Values for the CSS variables are set via Sass, so Sass customization is still supported, too.

{{< docs/scss-docs name="badge-css-vars" file="scss/bootstrap/_badge.scss" >}}

### Sass variables{.doc-toc-heading}

{{< docs/scss-docs name="badge-variables" file="src/assets/scss/_theme-variables.scss" >}}
