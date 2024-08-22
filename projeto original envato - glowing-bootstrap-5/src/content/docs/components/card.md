---
layout: docs
title: Cards
description: Bootstrap's cards provide a flexible and extensible content container with multiple variants and options.
group: components
toc: true
---

## About{.doc-toc-heading}

A **card** is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If you're familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.

## Example{.doc-toc-heading}

Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no `margin` by default, so use [spacing utilities](https://getbootstrap.com/docs/5.3/utilities/spacing/) as needed.

Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so they'll naturally fill the full width of its parent element. This is easily customized with our various [sizing options](#sizing).

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

## Content types{.doc-toc-heading}

Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what's supported.

### Body{.doc-toc-heading}

The building block of a card is the `.card-body`. Use it whenever you need a padded section within a card.

{{< docs/example >}}
<div class="card">
  <div class="card-body">
    This is some text within a card body.
  </div>
</div>
{{< /docs/example >}}

### Titles, text, and links{.doc-toc-heading}

Card titles are used by adding `.card-title` to a `<h*>` tag. In the same way, links are added and placed next to each other by adding `.card-link` to an `<a>` tag.

Subtitles are used by adding a `.card-subtitle` to a `<h*>` tag. If the `.card-title` and the `.card-subtitle` items are placed in a `.card-body` item, the card title and subtitle are aligned nicely.

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
{{< /docs/example >}}

### Images{.doc-toc-heading}

`.card-img-top` places an image to the top of the card. With `.card-text`, text can be added to the card. Text within `.card-text` can also be styled with the standard HTML tags.

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
  <div class="card-body">
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
{{< /docs/example >}}

### List groups{.doc-toc-heading}

Create lists of content in a card with a flush list group.

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
</div>
{{< /docs/example >}}

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  <div class="card-header">
    Featured
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
</div>
{{< /docs/example >}}

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-footer">
    Card footer
  </div>
</div>
{{< /docs/example >}}

### Kitchen sink{.doc-toc-heading}

Mix and match multiple content types to create the card you need, or throw everything in there. Shown below are image styles, blocks, text styles, and a list group—all wrapped in a fixed-width card.

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-body">
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>
{{< /docs/example >}}

### Header and footer{.doc-toc-heading}

Add an optional header and/or footer within a card.

{{< docs/example >}}
<div class="card">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

Card headers can be styled by adding `.card-header` to `<h*>` elements.

{{< docs/example >}}
<div class="card">
  <h5 class="card-header">Featured</h5>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

{{< docs/example >}}
<div class="card">
  <div class="card-header">
    Quote
  </div>
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>A well-known quote, contained in a blockquote element.</p>
      <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
    </blockquote>
  </div>
</div>
{{< /docs/example >}}

{{< docs/example >}}
<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-body-secondary">
    2 days ago
  </div>
</div>
{{< /docs/example >}}

## Sizing{.doc-toc-heading}

Cards assume no specific `width` to start, so they'll be 100% wide unless otherwise stated. You can change this as needed with custom CSS, grid classes, grid Sass mixins, or utilities.

### Using grid markup{.doc-toc-heading}

Using the grid, wrap cards in columns and rows as needed.

{{< docs/example >}}
<div class="row">
  <div class="col-sm-6 mb-5 mb-sm-0">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

### Using utilities{.doc-toc-heading}

Use our handful of [available sizing utilities](https://getbootstrap.com/docs/5.3/utilities/sizing/) to quickly set a card's width.

{{< docs/example >}}
<div class="card w-75 mb-5">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Button</a>
  </div>
</div>

<div class="card w-50">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Button</a>
  </div>
</div>
{{< /docs/example >}}

### Using custom CSS{.doc-toc-heading}

Use custom CSS in your stylesheets or as inline styles to set a width.

{{< docs/example >}}
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

## Text alignment{.doc-toc-heading}

You can quickly change the text alignment of any card—in its entirety or specific parts—with our [text align classes](https://getbootstrap.com/docs/5.3/utilities/text/#text-alignment).

{{< docs/example >}}
<div class="card mb-5" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card text-center mb-5" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>

<div class="card text-end" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

## Navigation{.doc-toc-heading}

Add some navigation to a card's header (or block) with Bootstrap's [nav components]({{< docs/ref "/components/tabs" >}}).

{{< docs/example >}}
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" aria-current="true" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

{{< docs/example >}}
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link active" href="#">Active</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
{{< /docs/example >}}

## Images{.doc-toc-heading}

Cards include a few options for working with images. Choose from appending "image caps" at either end of a card, overlaying images with card content, or simply embedding the image in a card.

### Image caps{.doc-toc-heading}

Similar to headers and footers, cards can include top and bottom "image caps"—images at the top or bottom of a card.

{{< docs/example >}}
<div class="card mb-5">
  {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
  </div>
</div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
  </div>
  {{< docs/placeholder width="100%" height="180" class="card-img-bottom" text="Image cap" >}}
</div>
{{< /docs/example >}}

### Image overlays{.doc-toc-heading}

Turn an image into a card background and overlay your card's text. Depending on the image, you may or may not need additional styles or utilities.

{{< docs/example >}}
<div class="card text-bg-dark">
  {{< docs/placeholder width="100%" height="270" class="bd-placeholder-img-lg card-img" text="Card image" >}}
  <div class="card-img-overlay">
    <h5 class="card-title color-inherit">Card title</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small>Last updated 3 mins ago</small></p>
  </div>
</div>
{{< /docs/example >}}

{{< docs/callout info >}}
Note that content should not be larger than the height of the image. If content is larger than the image the content will be displayed outside the image.
{{< /docs/callout >}}

## Horizontal{.doc-toc-heading}

Using a combination of grid and utility classes, cards can be made horizontal in a mobile-friendly and responsive way. In the example below, we remove the grid gutters with `.g-0` and use `.col-md-*` classes to make the card horizontal at the `md` breakpoint. Further adjustments may be needed depending on your card content.

{{< docs/example >}}
<div class="card mb-5" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      {{< docs/placeholder width="100%" height="250" text="Image" class="img-fluid rounded-start" >}}
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

## Card styles{.doc-toc-heading}

Cards include various options for customizing their backgrounds, borders, and color.

### Background and color{.doc-toc-heading}

{{< docs/added-in "5.2.0" >}}

Set a `background-color` with contrasting foreground `color` with [our `.text-bg-{color}` helpers](https://getbootstrap.com/docs/5.3/helpers/color-background/). Previously it was required to manually pair your choice of [`.text-{color}`](https://getbootstrap.com/docs/5.3/utilities/colors/) and [`.bg-{color}`]({{< docs/ref "/components/background" >}}) utilities for styling, which you still may use if you prefer.

{{< docs/example >}}
{{< card.inline >}}
{{- range (index $.Site.Data "doc_theme_color") }}
<div class="card text-bg-{{ .name }} mb-5" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body">
    <h5 class="card-title color-inherit">{{ .name | title }} card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
{{- end -}}
{{< /card.inline >}}
{{< /docs/example >}}

{{< docs/callout info >}}
{{< docs/partial "docs/callouts/warning-color-assistive-technologies.md" >}}
{{< /docs/callout >}}

### Border{.doc-toc-heading}

Use [border utilities](https://getbootstrap.com/docs/5.3/utilities/borders/) to change just the `border-color` of a card. Note that you can put `.text-{color}` classes on the parent `.card` or a subset of the card's contents as shown below.

{{< docs/example >}}
{{< card.inline >}}
{{- range (index $.Site.Data "doc_theme_color") }}
<div class="card border-{{ .name }} mb-5" style="max-width: 18rem;">
  <div class="card-header">Header</div>
  <div class="card-body{{ if not .contrast_color }} text-{{ .name }}{{ end }}">
    <h5 class="card-title">{{ .name | title }} card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
</div>
{{- end -}}
{{< /card.inline >}}
{{< /docs/example >}}

### Mixins utilities{.doc-toc-heading}

You can also change the borders on the card header and footer as needed, and even remove their `background-color` with `.bg-transparent`.

{{< docs/example >}}
<div class="card border-success mb-5" style="max-width: 18rem;">
  <div class="card-header bg-transparent border-success">Header</div>
  <div class="card-body text-success">
    <h5 class="card-title color-inherit">Success card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
  </div>
  <div class="card-footer bg-transparent border-success">Footer</div>
</div>
{{< /docs/example >}}

## Card layout{.doc-toc-heading}

In addition to styling the content within cards, Bootstrap includes a few options for laying out series of cards. For the time being, **these layout options are not yet responsive**.

### Card groups{.doc-toc-heading}

Use card groups to render cards as a single, attached element with equal width and height columns. Card groups start off stacked and use `display: flex;` to become attached with uniform dimensions starting at the `sm` breakpoint.

{{< docs/example >}}
<div class="card-group">
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
    </div>
  </div>
</div>
{{< /docs/example >}}

When using card groups with footers, their content will automatically line up.

{{< docs/example >}}
<div class="card-group">
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">Last updated 3 mins ago</small>
    </div>
  </div>
  <div class="card">
    {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">Last updated 3 mins ago</small>
    </div>
  </div>
</div>
{{< /docs/example >}}

### Grid cards{.doc-toc-heading}

Use the Bootstrap grid system and its [`.row-cols` classes](https://getbootstrap.com/docs/5.3/layout/grid/#row-columns) to control how many grid columns (wrapped around your cards) you show per row. For example, here's `.row-cols-1` laying out the cards on one column, and `.row-cols-md-2` splitting four cards to equal width across multiple rows, from the medium breakpoint up.

{{< docs/example >}}
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

Change it to `.row-cols-3` and you'll see the fourth card wrap.

{{< docs/example >}}
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

When you need equal height, add `.h-100` to the cards. If you want equal heights by default, you can set `$card-height: 100%` in Sass.

{{< docs/example >}}
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a short card.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="140" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

Just like with card groups, card footers will automatically line up.

{{< docs/example >}}
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      {{< docs/placeholder width="100%" height="180" class="card-img-top" text="Image cap" >}}
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      </div>
      <div class="card-footer">
        <small class="text-body-secondary">Last updated 3 mins ago</small>
      </div>
    </div>
  </div>
</div>
{{< /docs/example >}}

### Masonry{.doc-toc-heading}

In `v4` we used a CSS-only technique to mimic the behavior of [Masonry](https://masonry.desandro.com/)-like columns, but this technique came with lots of unpleasant [side effects](https://github.com/twbs/bootstrap/pull/28922). If you want to have this type of layout in `v5`, you can just make use of Masonry plugin. **Masonry is not included in Bootstrap**, but we've made a [demo example](https://getbootstrap.com/docs/5.3/examples/masonry/) to help you get started.

## CSS{.doc-toc-heading}

### Variables{.doc-toc-heading}

{{< docs/added-in "5.2.0" >}}

As part of Bootstrap's evolving CSS variables approach, cards now use local CSS variables on `.card` for enhanced real-time customization. Values for the CSS variables are set via Sass, so Sass customization is still supported, too.

{{< docs/scss-docs name="card-css-vars" file="scss/bootstrap/_card.scss" >}}

### Sass variables{.doc-toc-heading}

{{< docs/scss-docs name="card-variables" file="src/assets/scss/_theme-variables.scss" >}}
