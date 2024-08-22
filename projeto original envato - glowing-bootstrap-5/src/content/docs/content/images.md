---
layout: docs
title: Images
description: Documentation and examples for opting images into responsive behavior (so they never become wider than their parent) and add lightweight styles to them—all via classes.
group: content
toc: true
---

## Responsive images{.doc-toc-heading}

Images in Bootstrap are made responsive with `.img-fluid`. This applies `max-width: 100%;` and `height: auto;` to the image so that it scales with the parent width.

{{< docs/example >}}
{{< docs/placeholder width="100%" height="250" class="bd-placeholder-img-lg img-fluid" text="Responsive image" >}}
{{< /docs/example >}}

## Image thumbnails{.doc-toc-heading}

In addition to our [border-radius utilities](https://getbootstrap.com/docs/5.3/utilities/borders/), you can use `.img-thumbnail` to give an image a rounded 1px border appearance.

{{< docs/example >}}
{{< docs/placeholder width="200" height="200" class="img-thumbnail" title="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera" >}}
{{< /docs/example >}}

## Aligning images{.doc-toc-heading}

Align images with the [helper float classes](https://getbootstrap.com/docs/5.3/utilities/float/) or [text alignment classes](https://getbootstrap.com/docs/5.3/utilities/text/#text-alignment). `block`-level images can be centered using [the `.mx-auto` margin utility class](https://getbootstrap.com/docs/5.3/utilities/spacing/#horizontal-centering).

{{< docs/example >}}
{{< docs/placeholder width="200" height="200" class="rounded float-start" >}}
{{< docs/placeholder width="200" height="200" class="rounded float-end" >}}
{{< /docs/example >}}


{{< docs/example >}}
{{< docs/placeholder width="200" height="200" class="rounded mx-auto d-block" >}}
{{< /docs/example >}}

{{< docs/example >}}
<div class="text-center">
  {{< docs/placeholder width="200" height="200" class="rounded" >}}
</div>
{{< /docs/example >}}


## Picture{.doc-toc-heading}

If you are using the `<picture>` element to specify multiple `<source>` elements for a specific `<img>`, make sure to add the `.img-*` classes to the `<img>` and not to the `<picture>` tag.

```html
<picture>
  <source srcset="..." type="image/svg+xml">
  <img src="..." class="img-fluid img-thumbnail" alt="...">
</picture>
```

## Sass{.doc-toc-heading}

### Variables{.doc-toc-heading}

Variables are available for image thumbnails.

{{< docs/scss-docs name="thumbnail-variables" file="src/assets/scss/_theme-variables.scss" >}}
