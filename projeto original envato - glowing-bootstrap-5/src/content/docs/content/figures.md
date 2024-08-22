---
layout: docs
title: Figures
description: Documentation and examples for displaying related images and text with the figure component in Bootstrap.
group: content
toc: true
---

Anytime you need to display a piece of content—like an image with an optional caption, consider using a `<figure>`.

Use the included `.figure`, `.figure-img` and `.figure-caption` classes to provide some baseline styles for the HTML5 `<figure>` and `<figcaption>` elements. Images in figures have no explicit size, so be sure to add the `.img-fluid` class to your `<img>` to make it responsive.

{{< docs/example >}}
<figure class="figure">
  {{< docs/placeholder width="400" height="300" class="figure-img img-fluid rounded" >}}
  <figcaption class="figure-caption">A caption for the above image.</figcaption>
</figure>
{{< /docs/example >}}

Aligning the figure's caption is easy with our [text utilities](https://getbootstrap.com/docs/5.3/utilities/text/#text-alignment).

{{< docs/example >}}
<figure class="figure">
  {{< docs/placeholder width="400" height="300" class="figure-img img-fluid rounded" >}}
  <figcaption class="figure-caption text-end">A caption for the above image.</figcaption>
</figure>
{{< /docs/example >}}

## CSS{.doc-toc-heading}

### Sass variables{.doc-toc-heading}

{{< docs/scss-docs name="figure-variables" file="src/assets/scss/_theme-variables.scss" >}}
